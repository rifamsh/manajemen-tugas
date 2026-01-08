<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index()
    {
        // Menampilkan halaman daftar file / assets
        return view('files.index');
    }
}
