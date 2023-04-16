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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->unsignedBigInteger('nit')->nullable();
            $table->unsignedTinyInteger('regimen_tributario_id')->nullable();
            $table->foreign('regimen_tributario_id')->references('id')->on('regimenes_tributarios')->onUpdate('cascade')->onDelete('cascade');
            $table->string('numero_empleador')->nullable();
            $table->date('fecha_afiliacion')->nullable();
            $table->string('actividad')->nullable();
            $table->unsignedTinyInteger('tipo_empresa_id')->nullable();
            $table->foreign('tipo_empresa_id')->references('id')->on('tipos_empresas')->onUpdate('cascade')->onDelete('cascade');
            $table->string('fundempresa')->nullable();
            $table->string('roe')->nullable();
            $table->string('telefonos')->nullable();
            $table->unsignedTinyInteger('ciudad_id')->nullable();
            $table->foreign('ciudad_id')->references('id')->on('ciudades')->onUpdate('cascade')->onDelete('cascade');
            $table->string('domicilio')->nullable();
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
            $table->string('domicilio_representante')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
