<?php

namespace Database\Seeders;

use App\Models\RegimenTributario;
use Illuminate\Database\Seeder;

class RegimenTributarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            [
                'nombre' => 'RÉGIMEN GENERAL',
                'codigo' => 'RG',
                'orden' => 1,
            ], [
                'nombre' => 'RÉGIMEN TRIBUTARIO SIMPLICADO',
                'codigo' => 'RTS',
                'orden' => 2,
            ], [
                'nombre' => 'SISTEMA TRIBUTARIO INTEGRADO',
                'codigo' => 'STI',
                'orden' => 3,
            ], [
                'nombre' => 'RÉGIMEN AGROPECUARIO UNIFICADO',
                'codigo' => 'RAU',
                'orden' => 4,
            ], [
                'nombre' => 'RÉGIMEN SIETE',
                'codigo' => 'RT-SIETE',
                'orden' => 5,
            ],
        ];

        foreach ($datos as $dato) {
            RegimenTributario::firstOrCreate($dato);
        }
    }
}
