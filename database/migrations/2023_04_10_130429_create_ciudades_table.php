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
        Schema::create('ciudades', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('nombre');
            $table->string('codigo', 2);
            $table->unsignedTinyInteger('orden')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciudades');
    }
};
