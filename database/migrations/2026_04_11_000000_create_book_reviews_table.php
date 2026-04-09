<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book_reviews', function (Blueprint $table) {
            $table->id();

            // Relación con libros
            $table->foreignId('book_id')
                  ->constrained('books')
                  ->cascadeOnDelete();

            // Relación con miembros
            $table->foreignId('member_id')
                  ->constrained('members')
                  ->cascadeOnDelete();

            // Calificación (1-5)
            $table->unsignedTinyInteger('rating');

            // Comentario opcional
            $table->text('comment')->nullable();

            // Restricción: un miembro solo puede dejar una reseña por libro
            $table->unique(['book_id', 'member_id']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book_reviews');
    }
};
