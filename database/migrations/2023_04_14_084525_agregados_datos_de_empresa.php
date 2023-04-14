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
        Schema::table('empresas', function (Blueprint $table) {
            $table->unsignedBigInteger('nit')->nullable();
            $table->string('regimen')->nullable();
            $table->string('numero_empleador')->nullable();
            $table->date('fecha_afiliacion')->nullable();
            $table->text('actividad')->nullable();
            $table->string('tipo_empresa')->nullable();
            $table->string('fundempresa')->nullable();
            $table->string('roe')->nullable();
            $table->text('telefonos')->nullable();
            $table->unsignedTinyInteger('ciudad_id')->nullable();
            $table->foreign('ciudad_id')->references('id')->on('ciudades')->onUpdate('cascade')->onDelete('cascade');
            $table->text('domicilio')->nullable();
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->foreign('empleado_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
            $table->text('domicilio_representante')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn(['nit', 'regimen', 'numero_empleador', 'fecha_afiliacion', 'actividad', 'tipo_empresa', 'fundempresa', 'roe', 'telefonos', 'ciudad_id', 'domicilio', 'empleado_id', 'domicilio_representante']);
        });
    }
};
