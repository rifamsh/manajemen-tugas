<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FileController;

/*
|--------------------------------------------------------------------------
| Root
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('login'));

/*
|--------------------------------------------------------------------------
| Auth
|--------------------------------------------------------------------------
*/
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::get('/register', fn() => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/chat', fn() => view('chat'))->name('chat');

    Route::get('/timeline', [DashboardController::class, 'timeline'])->name('timeline');
    Route::get('/reports', [DashboardController::class, 'reports'])->name('reports');

    // Tasks
    Route::resource('tasks', TaskController::class);

    Route::get('/calendar', fn() => view('tasks.calendar'))->name('calendar');

    // Groups
    Route::get('/groups/create', fn() => view('groups.create'))->name('groups.create');
    Route::get('/groups/{id}', fn($id) => view('groups.show'))->name('groups.show');

    // Files
    Route::get('/files', [FileController::class, 'index'])->name('files');
    Route::post('/files', [FileController::class, 'store'])->name('files.store');
    Route::get('/files/{file}/download', [FileController::class, 'download'])->name('files.download');
    Route::delete('/files/{file}', [FileController::class, 'destroy'])->name('files.destroy');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
