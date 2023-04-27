<?php

namespace App\Imports;

use App\Models\Mes;
use App\Models\Cargo;
use App\Models\Empleado;
use App\Models\Planilla;
use App\Models\PlanillaMes;
use App\Models\PlanillaSueldo;
use App\Models\PlanillaEmpleado;
use App\Models\MovimientoEmpleado;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class PlanillasImport implements ToCollection, WithStartRow, WithCalculatedFormulas
{
    private $fila, $planilla, $credencial_id, $empresa_id;

    public function __construct(int $fila, Planilla $planilla, int $credencial_id, int $empresa_id)
    {
        $this->fila = $fila;
        $this->planilla = $planilla;
        $this->credencial_id = $credencial_id;
        $this->empresa_id = $empresa_id;
    }

    public function startRow(): int
    {
        return $this->fila - 2;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        DB::beginTransaction();
        try {
            $meses = [];
            $columna_total = 0;
            $fila_importes = 0;
            foreach ($collection as $i => $row)
            {
                if ($i == 0) {
                    for ($j = 7; $j <= 20; $j++) {
                        if (mb_strtolower(trim($row[$j])) == 'total') {
                            $columna_total = $j;
                            break;
                        }
                    }
                    if ($columna_total == 0) {
                        throw new \Exception('La cabecera debe contener la columna TOTAL');
                        break;
                    }
                    for ($j = 7; $j < $columna_total; $j++) {
                        $cabecera = trim($row[$j]);
                        $mes = Mes::where('nombre', 'like', $cabecera)->first();
                        if (!$mes) {
                            $mes = Mes::where('nombre', 'like', 'REINTEGRO')->first();
                        }
                        $mes = PlanillaMes::updateOrCreate([
                            'planilla_id' => $this->planilla->id,
                            'mes_id' => $mes->id,
                        ], [
                            'orden' => $j - 6,
                        ]);
                        $meses[] = $mes;
                    }
                } elseif ($i == 1) {
                    continue;
                } else {
                    if (intval(trim($row[0])) != 0) {
                        $cargo = Cargo::firstOrCreate([
                            'nombre' => mb_strtoupper(trim($row[6])),
                            'empresa_id' => $this->empresa_id,
                        ]);
                        $carnet = separar_carnet($row[1]);
                        $empleado = Empleado::updateOrCreate([
                            'cedula_identidad' => $carnet[0],
                        ], [
                            'complemento_cedula' => $carnet[1],
                            'ciudad_id' => $carnet[2] ? $carnet[2]->id : null,
                            'apellido_paterno' => trim($row[2]),
                            'apellido_materno' => trim($row[3]),
                            'nombre' => trim($row[4]),
                        ]);

                        $fecha_ingreso = null;
                        try {
                            $dato = intval(trim($row[5]));
                            if ($dato > 0) {
                                $fecha_ingreso = Date::excelToDateTimeObject($dato);
                            }
                        } catch (\Exception $e) {}
                        if (!MovimientoEmpleado::where('empleado_id', $empleado->id)->where('cargo_id', $cargo->id)->where('credencial_id', $this->credencial_id)->whereDate('fecha_ingreso', $fecha_ingreso)->exists()) {
                            MovimientoEmpleado::create([
                                'credencial_id' => $this->credencial_id,
                                'empleado_id' => $empleado->id,
                                'cargo_id' => $cargo->id,
                                'fecha_ingreso' => $fecha_ingreso,
                            ]);
                        }

                        foreach ($meses as $j => $mes) {
                            PlanillaSueldo::updateOrCreate([
                                'planilla_mes_id' => $mes->id,
                                'empleado_id' => $empleado->id,
                                'cargo_id' => $cargo->id,
                            ], [
                                'sueldo' => $row[$j + 7],
                            ]);

                            $mes->importes()->delete();
                            $mes->importes()->create();
                        }
                        PlanillaEmpleado::updateOrCreate([
                            'planilla_id' => $this->planilla->id,
                            'empleado_id' => $empleado->id,
                            'cargo_id' => $cargo->id,
                        ], [
                            'orden' => $i - 1,
                            'total' => $row[$columna_total],
                        ]);
                        $this->planilla->importes()->delete();
                        $this->planilla->importes()->create([]);
                    } else {
                        $fila_importes = $i;
                        break;
                    }
                }
            }

            $datos = [
                'cot_01',
                'liquidacion_cps',
                'afp_1',
                'afp_2',
                'formularios_pagados',
                'aporte_laboral',
                'aguinaldo',
                'ministerio_trabajo',
                'diferencias',
            ];

            foreach ($collection as $i => $row)
            {
                if ($i < $fila_importes) {
                    continue;
                } else {
                    foreach ($meses as $j => $mes) {
                        $mes->importes()->update([
                            "{$datos[$i - $fila_importes]}" => $row[$j + 7],
                        ]);
                    }
                    $this->planilla->importes()->update([
                        "{$datos[$i - $fila_importes]}" => $row[$columna_total],
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
