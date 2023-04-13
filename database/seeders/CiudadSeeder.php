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
                'nombre' => 'La Paz',
                'codigo' => 'LP',
            ], [
                'nombre' => 'Santa Cruz',
                'codigo' => 'SC',
            ], [
                'nombre' => 'Cochabamba',
                'codigo' => 'CB',
            ], [
                'nombre' => 'Sucre',
                'codigo' => 'SC',
            ], [
                'nombre' => 'Oruro',
                'codigo' => 'OR',
            ], [
                'nombre' => 'Potosí',
                'codigo' => 'PT',
            ], [
                'nombre' => 'Tarija',
                'codigo' => 'TJ',
            ], [
                'nombre' => 'Beni',
                'codigo' => 'BN',
            ], [
                'nombre' => 'Pando',
                'codigo' => 'PD',
            ],
        ];

        foreach ($datos as $dato) {
            Ciudad::firstOrCreate($dato);
        }
    }
}
