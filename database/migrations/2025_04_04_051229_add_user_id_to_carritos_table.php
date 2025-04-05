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
        Schema::table('carritos', function (Blueprint $table) {
            // Verificar si la columna 'user_id' no existe antes de agregarla
            if (!Schema::hasColumn('carritos', 'user_id')) {
                // Agregar la columna 'user_id' que hace referencia a la tabla 'users'
                $table->unsignedBigInteger('user_id')->after('id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('carritos', function (Blueprint $table) {
            // Eliminar la relación y la columna en caso de rollback
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
