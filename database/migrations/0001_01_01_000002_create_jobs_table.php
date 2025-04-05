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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('queue')->index(); // Índice en la cola
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');
            $table->timestamp('reserved_at')->nullable(); // Cambiado a timestamp
            $table->timestamp('available_at'); // Cambiado a timestamp
            $table->timestamp('created_at'); // Cambiado a timestamp
            $table->timestamps(); // Incluye los timestamps de Laravel
        });

        Schema::create('job_batches', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->timestamp('cancelled_at')->nullable(); // Cambiado a timestamp
            $table->timestamp('created_at'); // Cambiado a timestamp
            $table->timestamp('finished_at')->nullable(); // Cambiado a timestamp
        });

        Schema::create('failed_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent(); // Asegura que tenga la fecha actual
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('failed_jobs');
    }
};
