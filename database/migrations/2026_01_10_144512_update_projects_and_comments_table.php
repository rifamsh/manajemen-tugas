<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Update ENUM status di tabel projects agar ada 'on_hold'
        Schema::table('projects', function (Blueprint $table) {
            $table->enum('status', ['active', 'completed', 'archived', 'on_hold'])
                ->default('active')
                ->change();
        });

        // 2. Pastikan task_id di tabel comments bisa kosong (nullable)
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('task_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
