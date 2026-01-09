<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/chat', [DashboardController::class, 'chat'])->name('chat');
Route::get('/tasks', [DashboardController::class, 'taskBoard'])->name('tasks.board');
Route::get('/timeline', [DashboardController::class, 'timeline'])->name('timeline');
Route::get('/reports', [DashboardController::class, 'reports'])->name('reports');

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ================= AUTH =================

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

// Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

// ================= PROTECTED ROUTES =================
//
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    Route::get('/tasks/{id}', function ($id) {
        return view('tasks.show', compact('id'));
    })->name('tasks.show');

    Route::get('/calendar', function () {
        return view('tasks.calendar');
    })->name('calendar');

    Route::get('/groups/create', function () {
        return view('groups.create');
    })->name('groups.create');

    // File manager CRUD
    Route::get('/files', [App\Http\Controllers\FileController::class, 'index'])->name('files');
    Route::post('/files', [App\Http\Controllers\FileController::class, 'store'])->name('files.store');
    Route::get('/files/{file}/download', [App\Http\Controllers\FileController::class, 'download'])->name('files.download');
    Route::delete('/files/{file}', [App\Http\Controllers\FileController::class, 'destroy'])->name('files.destroy');
    Route::get('/profile', fn() => 'Profile')->name('profile');

    Route::get('/chat', function () {
        return view('chat'); // File: resources/views/chat.blade.php
    })->name('chat');

    Route::get('/timeline', [DashboardController::class, 'timeline'])->name('timeline');

    Route::get('/reports', [DashboardController::class, 'reports'])->name('reports');

    // Group Detail
    Route::get('/groups/{id}', function ($id) {
        return view('groups.show'); // File: resources/views/groups/show.blade.php
    })->name('groups.show');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // File Manager
    Route::get('/files', function () {
        return view('files'); // File: resources/views/files.blade.php
    })->name('files');
});
