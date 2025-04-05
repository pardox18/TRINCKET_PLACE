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
        Schema::table('carritos', function (Blueprint $table) {
            // Asegurarse de que la columna no existe antes de agregarla
            if (!Schema::hasColumn('carritos', 'user_id')) {
                $table->unsignedBigInteger('user_id')->after('id'); // Agregar columna 'user_id'
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Relacionar con 'users'
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carritos', function (Blueprint $table) {
            // Eliminar la relación y la columna
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
