<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            // Relasi: File milik Task tertentu
            $table->foreignId('task_id')->constrained()->onDelete('cascade');

            // Relasi: File diupload oleh User tertentu
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('file_path'); // Lokasi simpan di storage
            $table->string('file_name'); // Nama asli file (contoh: laporan.pdf)
            $table->string('file_type')->nullable(); // pdf, jpg, png
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('files');
    }
};
