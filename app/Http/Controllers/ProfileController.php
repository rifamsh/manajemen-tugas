<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        // Menampilkan halaman profile user
        return view('profile.index');
    }
}
