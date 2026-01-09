<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



class ChatController extends Controller
{
    public function index()
    {
        // Untuk tahap awal, hanya menampilkan halaman chat
        return view('chat.index');
    }
}
