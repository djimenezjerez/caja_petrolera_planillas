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
        Schema::create('planilla_empleados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planilla_id');
            $table->foreign('planilla_id')->references('id')->on('planillas')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('empleado_id');
            $table->foreign('empleado_id')->references('id')->on('empleados')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('cargo_id');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedSmallInteger('orden')->default(0);
            $table->float('total', 12, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planilla_empleados');
    }
};
