<?php

namespace App\Imports;

use App\Models\Cargo;
use App\Models\Empleado;
use App\Models\Planilla;
use App\Models\MovimientoEmpleado;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PlanillasImport implements ToCollection, WithStartRow
{
    private $planilla, $credencial_id, $empresa_id;

    public function __construct(Planilla $planilla, int $credencial_id, int $empresa_id)
    {
        $this->planilla = $planilla;
        $this->credencial_id = $credencial_id;
        $this->empresa_id = $empresa_id;
    }

    public function startRow(): int
    {
        return 9;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        DB::beginTransaction();
        try {
            foreach ($collection as $row)
            {
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








                    
                } else {
                    continue;
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e);
        }
    }
}
