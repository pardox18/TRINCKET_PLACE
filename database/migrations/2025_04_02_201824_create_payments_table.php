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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Asegura que sea unsigned para coincidir con la clave primaria de orders
            $table->string('payment_method'); // Método de pago (por ejemplo: tarjeta, PayPal, etc.)
            $table->decimal('amount', 10, 2); // Monto del pago
            $table->string('status')->default('pending'); // Estado del pago (pending, completed, etc.)
            $table->timestamps(); // Timestamps para created_at y updated_at

            // Clave foránea para relación con orders
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
