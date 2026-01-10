<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::orderBy('due_time')->get()->groupBy('status');
        $projects = Project::all();
        return view('tasks.index', compact('tasks', 'projects'));
    }

    public function create(Request $request)
    {
        $projects = Project::all();
        $selectedProject = null;

        if ($request->has('project_id')) {
            $selectedProject = Project::find($request->project_id);
        }

        return view('tasks.create', compact('projects', 'selectedProject'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'nullable|exists:projects,id',
            'priority' => 'required|in:High,Medium,Low',
            'status' => 'required|in:todo,in_progress,done',
            'deadline' => 'nullable|date',
            'due_time' => 'nullable',
        ]);

        $data['user_id'] = Auth::id() ?: 1;

        // If no project_id provided, attach to an existing project or create a minimal one
        if (empty($data['project_id'])) {
            $project = Project::first();
            if (! $project) {
                $project = Project::create([
                    'user_id' => $data['user_id'],
                    'name' => 'Default Project',
                    'description' => 'Auto-created project for tasks',
                    'category' => 'General',
                    'deadline' => now()->addMonth()->toDateString(),
                    'progress' => 0,
                    'status' => 'active',
                ]);
            }
            $data['project_id'] = $project->id;
        }

        Task::create($data);

        // Redirect based on where the task was created from
        if ($request->has('project_id') && $request->project_id) {
            return redirect()->route('groups.show', $request->project_id)->with('success', 'Task created successfully!');
        }

        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }

    public function edit(Task $task)
    {
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'projects'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'project_id' => 'nullable|exists:projects,id',
            'priority' => 'required|in:High,Medium,Low',
            'status' => 'required|in:todo,in_progress,done',
            'deadline' => 'nullable|date',
            'due_time' => 'nullable',
        ]);

        // If no project_id provided, ensure task has a project
        if (empty($data['project_id'])) {
            $project = Project::first();
            if (! $project) {
                $project = Project::create([
                    'user_id' => Auth::id() ?: 1,
                    'name' => 'Default Project',
                    'description' => 'Auto-created project for tasks',
                    'category' => 'General',
                    'deadline' => now()->addMonth()->toDateString(),
                    'progress' => 0,
                    'status' => 'active',
                ]);
            }
            $data['project_id'] = $project->id;
        }

        $task->update($data);
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted');
    }

    public function calendar()
    {
        $tasks = Task::where('user_id', auth()->id())
            ->whereNotNull('deadline')
            ->orderBy('deadline')
            ->get();

        return view('tasks.calendar', compact('tasks'));
    }
}
