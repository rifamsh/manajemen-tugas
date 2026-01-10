<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectTeam;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::where('user_id', auth()->id())
            ->orWhereHas('members', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->with('members')
            ->get();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'deadline' => 'nullable|date',
        ]);

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'deadline' => $request->deadline,
            'user_id' => auth()->id(),
            'status' => 'active', // LANGSUNG ISI NILAI: 'active'
            'progress' => 0,
        ]);

        return redirect()->route('projects.show', $project->id)
            ->with('success', 'Project created successfully!');
    }
    public function show($id)
    {
        $project = Project::with(['user', 'members', 'tasks.assignee', 'files.user'])->findOrFail($id);

        // Check if user is member or owner
        if ($project->user_id !== auth()->id() && !$project->members->contains('id', auth()->id())) {
            abort(403);
        }

        // Get task statistics
        $totalTasks = $project->tasks->count();
        $completedTasks = $project->tasks->where('status', 'done')->count();
        $inProgressTasks = $project->tasks->where('status', 'in_progress')->count();
        $overdueTasks = $project->tasks->where('deadline', '<', now())->where('status', '!=', 'done')->count();

        // Get recent activities (mock data for now)
        $recentActivities = collect([
            ['user' => 'John Doe', 'action' => 'completed task "Design Homepage"', 'time' => '2 hours ago'],
            ['user' => 'Jane Smith', 'action' => 'added new task "Fix Login Bug"', 'time' => '4 hours ago'],
            ['user' => 'Mike Johnson', 'action' => 'uploaded file "design_mockup.png"', 'time' => '1 day ago'],
        ]);

        return view('groups.show', compact('project', 'totalTasks', 'completedTasks', 'inProgressTasks', 'overdueTasks', 'recentActivities'));
    }

    public function addMember(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        // Check if user is already a member
        if ($project->members()->where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', 'User is already a member of this project.');
        }

        $project->members()->attach($user->id, ['role' => 'member']);

        return redirect()->back()->with('success', 'Member added successfully!');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);

        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'nullable|date',
            'status' => 'required|in:active,completed,on_hold',
            'progress' => 'required|integer|min:0|max:100',
        ]);

        $project->update($request->only(['name', 'description', 'deadline', 'status', 'progress']));

        return redirect()->route('projects.show', $project)->with('success', 'Project updated successfully!');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        if ($project->user_id !== auth()->id()) {
            abort(403);
        }

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully!');
    }
}
