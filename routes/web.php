<?php

use Illuminate\Support\Facades\Route;


// --- 1. HALAMAN UTAMA (ROOT) ---
// Saat aplikasi pertama dibuka, arahkan user ke halaman Login
Route::get('/', function () {
    return redirect()->route('login');
});

// --- 2. AUTHENTICATION (Login & Register) ---
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// --- 3. DASHBOARD ---
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');


// --- MENU LAIN (Tetap dikunci) ---
Route::middleware(['auth'])->group(function () {
    
    // Route::get('/dashboard'...)  <-- HAPUS YANG DI DALAM SINI
    
    Route::get('/tasks', function () {
        return view('tasks.index');
    })->name('tasks.index');

    // ... sisa route lainnya biarkan di sini
});

// --- 4. TASK MANAGEMENT ---
// Halaman Kanban Board
Route::get('/tasks', function () {
    return view('tasks.index');
})->name('tasks.index');

// Halaman Calendar View
// (PENTING: Letakkan route ini SEBELUM route detail /{id} agar tidak tertukar)
Route::get('/calendar', function () {
    return view('tasks.calendar');
})->name('calendar');

// Halaman Detail Task (Contoh ID sembarang)
// Kita pakai parameter {id} agar terlihat dinamis, meski view-nya masih statis
Route::get('/tasks/{id}', function ($id) {
    return view('tasks.show');
})->name('tasks.show');

// --- 5. GROUP MANAGEMENT ---
Route::get('/groups/create', function () {
    return view('groups.create');
})->name('groups.create');

// --- 6. PLACEHOLDER (Menu Lain) ---
// Route sementara untuk menu yang ada di Sidebar tapi belum kita buat view-nya
// Supaya tidak error 404 saat diklik.

Route::get('/files', function () {
    return "<center><h1>Halaman File Manager</h1><p>Sedang dalam pengembangan (Tim View)</p><a href='/dashboard'>Kembali</a></center>";
})->name('files');

Route::get('/profile', function () {
    return "<center><h1>Halaman User Profile</h1><p>Sedang dalam pengembangan (Tim View)</p><a href='/dashboard'>Kembali</a></center>";
})->name('profile');