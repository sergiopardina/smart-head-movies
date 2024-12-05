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
        Schema::create('genre_movie_pivots', function (Blueprint $table) {
            $table->id();
            $table->integer('genre_id')->nullable();
            $table->integer('movie_id')->nullable();

            $table->timestamps();

            $table->foreign('genre_id')
                ->references('id')
                ->on('genres')
                ->onDelete('cascade');
            $table->foreign('movie_id')
                ->references('id')
                ->on('movies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre_movie_pivots');
    }
};
