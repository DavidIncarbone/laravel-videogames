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
        Schema::create('genre_videogame', function (Blueprint $table) {
            $table->id();
            $table->foreignId('videogame_id')->constrained()->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreignId('genre_id')->constrained()->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre_videogame');
    }
};
