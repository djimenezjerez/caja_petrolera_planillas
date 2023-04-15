<?php

namespace Database\Seeders;

use App\Models\Ciudad;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CiudadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            [
                'nombre' => 'LA PAZ',
                'codigo' => 'LP',
                'orden' => 1,
            ], [
                'nombre' => 'SANTA CRUZ',
                'codigo' => 'SC',
                'orden' => 2,
            ], [
                'nombre' => 'COCHABAMBA',
                'codigo' => 'CB',
                'orden' => 3,
            ], [
                'nombre' => 'SUCRE',
                'codigo' => 'SC',
                'orden' => 4,
            ], [
                'nombre' => 'ORURO',
                'codigo' => 'OR',
                'orden' => 5,
            ], [
                'nombre' => 'POTOSÍ',
                'codigo' => 'PT',
                'orden' => 6,
            ], [
                'nombre' => 'TARIJA',
                'codigo' => 'TJ',
                'orden' => 7,
            ], [
                'nombre' => 'BENI',
                'codigo' => 'BN',
                'orden' => 8,
            ], [
                'nombre' => 'PANDO',
                'codigo' => 'PD',
                'orden' => 9,
            ],
        ];

        foreach ($datos as $dato) {
            Ciudad::firstOrCreate($dato);
        }
    }
}
