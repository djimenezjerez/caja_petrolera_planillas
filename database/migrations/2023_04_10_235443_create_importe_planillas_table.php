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
        Schema::create('importe_planillas', function (Blueprint $table) {
            $table->id();
            $table->float('cot_01', 12, 2)->default(0);
            $table->float('liquidacion_cps', 12, 2)->default(0);
            $table->float('afp_1', 12, 2)->default(0);
            $table->float('afp_2', 12, 2)->default(0);
            $table->float('formularios_pagados', 12, 2)->default(0);
            $table->float('aporte_laboral', 12, 2)->default(0);
            $table->float('aguinaldo', 12, 2)->default(0);
            $table->float('ministerio_trabajo', 12, 2)->default(0);
            $table->float('diferencias', 12, 2)->default(0);
            $table->float('total', 12, 2)->default(0);
            $table->boolean('calculado')->default(false);
            $table->morphs('planillable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('importe_planillas');
    }
};
