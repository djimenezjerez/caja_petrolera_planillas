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
        Schema::create('movimiento_empleados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('credencial_id');
            $table->foreign('credencial_id')->references('id')->on('credenciales')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('cargo_id');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onUpdate('cascade')->onDelete('cascade');
            $table->date('fecha_ingreso');
            $table->date('fecha_retiro')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimiento_empleados');
    }
};
