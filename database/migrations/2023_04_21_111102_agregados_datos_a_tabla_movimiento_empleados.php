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
        Schema::table('movimiento_empleados', function($table) {
            $table->date('parte_cps_fecha_ingreso');
            $table->date('parte_cps_fecha_retiro')->nullable();
            $table->date('presentacion_cps_fecha_ingreso')->nullable();
            $table->date('presentacion_cps_fecha_retiro')->nullable();
            $table->date('contrato_fecha_ingreso')->nullable();
            $table->date('contrato_fecha_retiro')->nullable();
            $table->date('finiquito_fecha_ingreso')->nullable();
            $table->date('finiquito_fecha_retiro')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movimiento_empleados', function($table) {
            $table->dropColumn([ 'parte_cps_fecha_ingreso', 'parte_cps_fecha_retiro', 'presentacion_cps_fecha_ingreso', 'presentacion_cps_fecha_retiro', 'contrato_fecha_ingreso', 'contrato_fecha_retiro', 'finiquito_fecha_ingreso', 'finiquito_fecha_retiro']);
        });
    }
};
