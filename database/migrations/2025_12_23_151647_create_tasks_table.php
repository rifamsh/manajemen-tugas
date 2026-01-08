<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');
            $table->text('description')->nullable();

            // --- PERUBAHAN & TAMBAHAN ---

            // 1. Tambah Priority (Wajib untuk badge warna merah/kuning di dashboard)
            $table->enum('priority', ['High', 'Medium', 'Low'])->default('Medium');

            // 2. Sesuaikan status dengan teks di dashboard ("In Progress" bukan "process")
            $table->enum('status', ['todo', 'in_progress', 'done'])->default('todo');

            // 3. Deadline (Tanggal) & Due Time (Jam - Penting untuk Schedule Widget)
            $table->date('deadline')->nullable();
            $table->time('due_time')->nullable(); // Format: 09:00:00

            // -----------------------------

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
