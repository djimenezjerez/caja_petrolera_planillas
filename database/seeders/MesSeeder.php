<?php

namespace Database\Seeders;

use App\Models\Mes;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            [
                'nombre' => 'ENERO',
                'orden' => 1,
            ], [
                'nombre' => 'FEBRERO',
                'orden' => 2,
            ], [
                'nombre' => 'MARZO',
                'orden' => 3,
            ], [
                'nombre' => 'ABRIL',
                'orden' => 4,
            ], [
                'nombre' => 'MAYO',
                'orden' => 5,
            ], [
                'nombre' => 'JUNIO',
                'orden' => 6,
            ], [
                'nombre' => 'JULIO',
                'orden' => 7,
            ], [
                'nombre' => 'AGOSTO',
                'orden' => 8,
            ], [
                'nombre' => 'SEPTIEMBRE',
                'orden' => 9,
            ], [
                'nombre' => 'OCTUBRE',
                'orden' => 10,
            ], [
                'nombre' => 'NOVIEMBRE',
                'orden' => 11,
            ], [
                'nombre' => 'DICIEMBRE',
                'orden' => 12,
            ], [
                'nombre' => 'REINTEGRO',
                'orden' => 13,
            ],
        ];

        foreach ($datos as $dato) {
            Mes::firstOrCreate($dato);
        }
    }
}
