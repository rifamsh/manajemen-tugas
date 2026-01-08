<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function timeline()
    {
        // Ambil semua task dari database
        $tasks = Task::orderBy('due_time', 'asc')->get();

        // Kirim ke view timeline
        return view('timeline.index', compact('tasks'));
    }
}
