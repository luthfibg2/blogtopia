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
        Schema::create('shorts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('read_in_minutes');
            // $table->enum('genre', ['fabel', 'anak-anak', 'remaja', 'romansa', 'aksi', 'sci-fi', 'fantasi', 'unspecified'])->default('unspecified');
            $table->foreignId('author_id')->constrained(
                table: 'users',
                indexName: 'shorts_author_id'
            );
            $table->foreignId('genre_id')->constrained(
                table: 'genres',
                indexName: 'genre_id'
            );
            $table->text('content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shorts');
    }
};
