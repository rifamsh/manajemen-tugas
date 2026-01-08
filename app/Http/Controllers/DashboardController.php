<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data project (contoh: 3 project aktif)
        $projects = Project::take(3)->get();

        // Ambil data task (contoh: task milik user)
        $tasks = Task::all();

        // Kirim ke view dashboard
        return view('dashboard', compact('projects', 'tasks'));

class DashboardController extends Controller
{
    // Dashboard utama
    public function index()
    {
        return view('dashboard');
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
        return view('timeline');
    }

    // Reports
    public function reports()
    {
        return view('reports');
    }
}
