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
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            
            // Relación con la tabla ventas
            $table->unsignedBigInteger('venta_id');
            $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('cascade');

            // Campos adicionales
            $table->decimal('costo', 10, 2)->nullable(); // Campo nullable para costo
            $table->date('fecha_entrega')->nullable(); // Fecha de entrega nullable
            $table->string('status'); // Status de la entrega
            
            // Relación con usuarios
            $table->unsignedBigInteger('aprobado_por')->nullable(); // Usuario que aprobó
            $table->foreign('aprobado_por')->references('id')->on('users')->onDelete('set null');
            
            $table->unsignedBigInteger('user_id'); // Usuario relacionado con la entrega
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->timestamps(); // Timestamps (created_at, updated_at)
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entregas');
    }
};
