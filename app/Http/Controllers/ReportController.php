<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;

class ReportController extends Controller
{
    public function index()
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

        // Productivity trend: completed tasks for last 4 weeks
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

    public function exportPdf()
    {
        $user = auth()->user();

        // Get the same data as index method
        $completed = Task::where('user_id', $user->id)->where('status', 'done')->count();
        $totalTasks = Task::where('user_id', $user->id)->count();
        $overdue = Task::where('user_id', $user->id)
            ->whereDate('deadline', '<', now())
            ->where('status', '!=', 'done')
            ->count();
        $activeProjects = Project::whereHas('members', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->orWhere('user_id', $user->id)->count();
        $efficiency = $totalTasks > 0 ? round(($completed / $totalTasks) * 100) : 0;

        $projectsHealth = Project::whereHas('members', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->orWhere('user_id', $user->id)
            ->orderBy('deadline')
            ->take(6)
            ->get(['id', 'name', 'progress', 'status', 'deadline']);

        $data = [
            'user' => $user,
            'completed' => $completed,
            'efficiency' => $efficiency,
            'activeProjects' => $activeProjects,
            'overdue' => $overdue,
            'projectsHealth' => $projectsHealth,
            'generated_at' => now()->format('d M Y H:i')
        ];

        // For now, return HTML that can be printed as PDF
        // In production, you would use a proper PDF library
        return response()->view('reports-pdf', $data)
            ->header('Content-Type', 'text/html')
            ->header('Content-Disposition', 'attachment; filename="project-analytics-' . now()->format('Y-m-d') . '.html"');
    }
}
