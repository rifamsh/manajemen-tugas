<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
    // Dashboard utama
    public function index()
    {
        $user = auth()->user();

        // Projects where the user is a member or leader (limit 3 for the summary cards)
        $projects = Project::whereHas('members', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->orWhere('user_id', $user->id)
            ->with('members')
            ->take(3)
            ->get();

        // User tasks grouped by status
        $tasks_todo = Task::with(['assignee', 'files'])->where('user_id', $user->id)->where('status', 'todo')->get();
        $tasks_in_progress = Task::with(['assignee', 'files'])->where('user_id', $user->id)->where('status', 'in_progress')->get();
        $tasks_done = Task::with(['assignee', 'files'])->where('user_id', $user->id)->where('status', 'done')->get();

        return view('dashboard.index', compact('projects', 'tasks_todo', 'tasks_in_progress', 'tasks_done'));
    }

    // Halaman Chat
    public function chat()
    {
        return view('chat');
    }

    // Task Board / Kanban
    public function taskBoard()
    {
        return view('tasks');
    }

    // Timeline
    public function timeline()
    {
        $tasks = Task::all();
        return view('timeline', compact('tasks'));
    }

    // Reports
    public function reports()
    {
        $user = auth()->user();

        // Counts
        $completed = Task::where('user_id', $user->id)->where('status', 'done')->count();
        $totalTasks = Task::where('user_id', $user->id)->count();
        $overdue = Task::where('user_id', $user->id)
            ->whereDate('deadline', '<', now())
            ->where('status', '!=', 'done')
            ->count();

        // Active projects (member or leader)
        $activeProjects = Project::whereHas('members', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->orWhere('user_id', $user->id)->count();

        // Efficiency rate: completed / total * 100 (avoid division by zero)
        $efficiency = $totalTasks > 0 ? round(($completed / $totalTasks) * 100) : 0;

        // Productivity trend: completed tasks for last 4 weeks (Week labels)
        $trendLabels = [];
        $trendData = [];
        for ($i = 3; $i >= 0; $i--) {
            $start = now()->subWeeks($i)->startOfWeek();
            $end = now()->subWeeks($i)->endOfWeek();
            $label = $start->format('M j');
            $count = Task::where('user_id', $user->id)
                ->where('status', 'done')
                ->whereBetween('deadline', [$start->toDateString(), $end->toDateString()])
                ->count();
            $trendLabels[] = $label;
            $trendData[] = $count;
        }

        // Status breakdown
        $countDone = Task::where('user_id', $user->id)->where('status', 'done')->count();
        $countInProgress = Task::where('user_id', $user->id)->where('status', 'in_progress')->count();
        $countTodo = Task::where('user_id', $user->id)->where('status', 'todo')->count();
        $totalStatus = $countDone + $countInProgress + $countTodo ?: 1;
        $pctDone = round(($countDone / $totalStatus) * 100);
        $pctInProgress = round(($countInProgress / $totalStatus) * 100);

        // Projects health: latest 6 projects with progress, status, deadline
        $projectsHealth = Project::whereHas('members', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->orWhere('user_id', $user->id)
            ->orderBy('deadline')
            ->take(6)
            ->get(['id', 'name', 'progress', 'status', 'deadline']);

        return view('reports', compact(
            'completed',
            'efficiency',
            'activeProjects',
            'overdue',
            'trendLabels',
            'trendData',
            'pctDone',
            'pctInProgress',
            'projectsHealth'
        ));
    }
}
