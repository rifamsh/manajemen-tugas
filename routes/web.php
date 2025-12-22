<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return redirect('/projects');
});

Route::middleware('auth')->group(function () {
    Route::resource('projects', ProjectController::class);
});

require __DIR__ . '/auth.php';
