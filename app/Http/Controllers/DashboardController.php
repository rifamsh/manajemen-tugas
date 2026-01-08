<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('chat.index');
    }

    // Task Board / Kanban
    public function taskBoard()
    {
        return view('tasks.board');
    }

    // Timeline
    public function timeline()
    {
        return view('timeline.index');
    }

    // Reports
    public function reports()
    {
        return view('reports.index');
    }
}
