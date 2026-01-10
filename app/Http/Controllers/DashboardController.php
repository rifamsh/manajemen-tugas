<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
    // Dashboard utama
    public function index()
    {
        $user = Auth::user();

        // Projects where the user is a member or leader (limit 3 for the summary cards)
        $projects = Project::whereHas('members', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->orWhere('user_id', $user->id)
            ->with('members')
            ->orderBy('created_at', 'desc')
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
        return app(ReportController::class)->index();
    }
}
