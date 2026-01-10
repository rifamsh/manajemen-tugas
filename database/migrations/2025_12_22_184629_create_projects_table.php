<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            // Pembuat Project (Leader)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('name');              // "Website Redesign"
            $table->text('description')->nullable();

            // --- TAMBAHAN UNTUK DASHBOARD ---

            // 1. Kategori (Untuk Badge: "Design", "Dev", "Marketing")
            $table->string('category');

            // 2. Deadline (Untuk teks "Deadline: 20 March")
            $table->date('deadline')->nullable();

            // 3. Progress Bar (Untuk grafik batang persen: 30%, 45%)
            $table->integer('progress')->default(0);

            // 4. Status (Penting untuk filter judul widget "Active Groups")
            $table->enum('status', ['active', 'completed', 'archived'])->default('active');

            // --------------------------------

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
