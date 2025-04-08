<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('publicaciones', function (Blueprint $table) {
        $table->id();
        $table->string('title'); // Título de la publicación
        $table->text('description'); // Descripción de la publicación
        $table->decimal('price', 10, 2); // Precio de la publicación
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con el usuario
        $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Relación con la categoría
        $table->enum('status', ['activo', 'inactivo', 'pendiente'])->default('activo'); // Estado de la publicación
        $table->string('image')->nullable(); // Imagen de la publicación (si aplica)
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('publicaciones');
    }
};
