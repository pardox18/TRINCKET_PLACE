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
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // Creación del ID principal para cada comentario
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Relación con el producto (clave foránea)
            $table->text('comment'); // Comentario de texto
            $table->timestamps(); // Timestamps para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments'); // Eliminar la tabla de comentarios si existe
    }
};
