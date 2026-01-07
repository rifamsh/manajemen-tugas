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
