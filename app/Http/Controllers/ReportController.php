<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Menampilkan halaman laporan / reports
        return view('reports.index');
    }
}
