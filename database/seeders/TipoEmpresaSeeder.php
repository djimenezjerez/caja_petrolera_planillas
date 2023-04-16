<?php

namespace Database\Seeders;

use App\Models\TipoEmpresa;
use Illuminate\Database\Seeder;

class TipoEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $datos = [
            [
                'nombre' => 'SOCIEDAD DE RESPONSABILIDAD LIMITADA',
                'codigo' => 'S.R.L.',
                'orden' => 1,
            ], [
                'nombre' => 'SOCIEDAD COLECTIVA',
                'codigo' => 'S.C.',
                'orden' => 2,
            ], [
                'nombre' => 'SOCIEDAD EN COMANDITA SIMPLE',
                'codigo' => 'S.C.S.',
                'orden' => 3,
            ], [
                'nombre' => 'SOCIEDAD ANÓNIMA',
                'codigo' => 'S.A.',
                'orden' => 4,
            ], [
                'nombre' => 'SOCIEDAD EN COMANDITA POR ACCIONES',
                'codigo' => 'S.C.A.',
                'orden' => 5,
            ], [
                'nombre' => 'ASOCIACIÓN ACCIDENTAL O DE CUENTAS EN PARTICIPACIÓN',
                'codigo' => 'A.A.C.P.',
                'orden' => 6,
            ], [
                'nombre' => 'SOCIEDAD DE ECONOMÍA MIXTA',
                'codigo' => 'S.E.M.',
                'orden' => 7,
            ], [
                'nombre' => 'SUCURSAL',
                'codigo' => 'SS.',
                'orden' => 8,
            ],
        ];

        foreach ($datos as $dato) {
            TipoEmpresa::firstOrCreate($dato);
        }
    }
}
