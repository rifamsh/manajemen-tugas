<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            // Relasi: Komentar ada di Task mana
            $table->foreignId('task_id')->constrained()->onDelete('cascade');

            // Relasi: Siapa yang berkomentar
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->text('comment_text'); // Isi komentar
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
