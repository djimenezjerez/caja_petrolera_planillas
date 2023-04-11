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
                'nombre' => 'enero',
                'orden' => 1,
            ], [
                'nombre' => 'febrero',
                'orden' => 2,
            ], [
                'nombre' => 'marzo',
                'orden' => 3,
            ], [
                'nombre' => 'abril',
                'orden' => 4,
            ], [
                'nombre' => 'mayo',
                'orden' => 5,
            ], [
                'nombre' => 'junio',
                'orden' => 6,
            ], [
                'nombre' => 'julio',
                'orden' => 7,
            ], [
                'nombre' => 'agosto',
                'orden' => 8,
            ], [
                'nombre' => 'septiembre',
                'orden' => 9,
            ], [
                'nombre' => 'octubre',
                'orden' => 10,
            ], [
                'nombre' => 'noviembre',
                'orden' => 11,
            ], [
                'nombre' => 'diciembre',
                'orden' => 12,
            ], [
                'nombre' => 'reintegro',
                'orden' => 13,
            ],
        ];

        foreach ($datos as $dato) {
            Mes::firstOrCreate($dato);
        }
    }
}
