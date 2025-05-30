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
        Schema::create('carritos', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->string('tipo');
            $table->date('fecha_finalizacion')->nullable();
            $table->date('fecha_simulada');
            $table->enum('estado', ['activo', 'finalizado'])->default('activo');

           
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carritos');
    }
};
