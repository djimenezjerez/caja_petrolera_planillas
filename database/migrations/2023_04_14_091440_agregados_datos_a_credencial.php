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
        Schema::table('credenciales', function (Blueprint $table) {
            $table->string('cite');
            $table->date('fecha_inicio_fizcalizacion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('credenciales', function (Blueprint $table) {
            $table->dropColumn(['cite', 'fecha_inicio_fizcalizacion']);
        });
    }
};
