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
    }
}
