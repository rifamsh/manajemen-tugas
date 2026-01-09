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

    public function create()
    {
        $projects = Project::all();
        return view('tasks.create', compact('projects'));
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
        return redirect()->route('tasks')->with('success', 'Task created');
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
        return redirect()->route('tasks')->with('success', 'Task updated');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks')->with('success', 'Task deleted');
    }
}
