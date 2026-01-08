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
