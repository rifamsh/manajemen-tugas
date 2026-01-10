<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ChatController;

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
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Tasks
    Route::resource('tasks', TaskController::class);
    Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
    Route::get('/calendar', [TaskController::class, 'calendar'])->name('calendar');

    // Projects
    Route::resource('projects', ProjectController::class);
    Route::post('/groups/{id}/add-member', [ProjectController::class, 'addMember'])->name('groups.add-member');
    Route::get('/groups/create', [ProjectController::class, 'create'])->name('groups.create');
    Route::get('/groups/{id}', [ProjectController::class, 'show'])->name('groups.show');

    // Files
    Route::resource('files', FileController::class)->except(['create', 'edit', 'update']);
    Route::get('/files/{file}/download', [FileController::class, 'download'])->name('files.download');

    // Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat');

    // Timeline
    Route::get('/timeline', [DashboardController::class, 'timeline'])->name('timeline');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');
    Route::get('/reports/export-pdf', [ReportController::class, 'exportPdf'])->name('reports.export-pdf');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
