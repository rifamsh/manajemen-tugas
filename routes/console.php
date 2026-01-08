<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

// 1. Command Default
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// 2. Command Khusus Project Kamu
Artisan::command('project:check', function () {
    $this->info("🔍 Memeriksa Status Project Task Manager...");
    
    // Cek Database
    try {
        DB::connection()->getPdo();
        $this->info("✅ Koneksi Database: TERHUBUNG");
    } catch (\Exception $e) {
        $this->error("❌ Koneksi Database: GAGAL (" . $e->getMessage() . ")");
    }

    // Cek Folder Storage
    if (file_exists(storage_path('logs/laravel.log'))) {
        $this->info("✅ Log File: ADA");
    } else {
        $this->warn("⚠️ Log File: BELUM ADA (Aman, nanti dibuat otomatis)");
    }

    $this->comment("\nSemua sistem siap! Semangat ngerjain tugasnya! 🚀");

})->purpose('Cek kesehatan aplikasi Task Manager');