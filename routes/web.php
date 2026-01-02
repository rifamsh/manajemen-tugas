<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController; // PENTING: Panggil Controllernya

/*
|--------------------------------------------------------------------------
| Web Routes (UPDATED)
|--------------------------------------------------------------------------
*/

// --- 1. HALAMAN UTAMA ---
Route::get('/', function () {
    return redirect()->route('login');
});

// --- 2. AUTHENTICATION (GET = Tampil, POST = Proses) ---

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.process'); // INI YANG TADINYA ERROR

// Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- 3. DASHBOARD & MENU LAIN (Hanya bisa diakses kalau sudah Login) ---
// Kita pakai 'middleware' => 'auth' supaya yang belum login tidak bisa tembus lewat URL

Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::get('/tasks', function () {
        return view('tasks.index');
    })->name('tasks.index');

    Route::get('/calendar', function () {
        return view('tasks.calendar');
    })->name('calendar');

    Route::get('/tasks/{id}', function ($id) {
        return view('tasks.show');
    })->name('tasks.show');

    Route::get('/groups/create', function () {
        return view('groups.create');
    })->name('groups.create');

    // Placeholder
    Route::get('/files', function () { return "File Manager"; })->name('files');
    Route::get('/profile', function () { return "Profile"; })->name('profile');
});