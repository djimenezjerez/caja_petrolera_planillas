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
        Schema::create('planilla_mes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('planilla_id');
            $table->foreign('planilla_id')->references('id')->on('planillas')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('mes_id');
            $table->foreign('mes_id')->references('id')->on('meses')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedTinyInteger('orden')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planilla_mes');
    }
};
