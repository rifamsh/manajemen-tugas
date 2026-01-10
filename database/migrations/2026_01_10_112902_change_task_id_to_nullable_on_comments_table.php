<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            // Mengubah task_id agar boleh kosong (nullable)
            $table->foreignId('task_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->foreignId('task_id')->nullable(false)->change();
        });
    }
};
