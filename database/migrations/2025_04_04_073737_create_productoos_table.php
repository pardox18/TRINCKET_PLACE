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
    Schema::create('productoos', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->decimal('precio', 8, 2);
        $table->text('descripcion');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('productoos');
}

};
