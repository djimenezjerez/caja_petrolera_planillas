<?php

namespace App\Imports;

use App\Models\Cargo;
use App\Models\Empleado;
use App\Models\MovimientoEmpleado;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MovimientoEmpleadosImport implements ToCollection, WithStartRow
{
    private $empresa_id, $credencial_id;

    public function __construct(int $empresa_id, int $credencial_id)
    {
        $this->empresa_id = $empresa_id;
        $this->credencial_id = $credencial_id;
    }

    public function startRow(): int
    {
        return 3;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row)
        {
            DB::beginTransaction();
            try {
                $cargo = Cargo::firstOrCreate([
                    'nombre' => mb_strtoupper(trim($row[5])),
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
                    $dato = intval(trim($row[6]));
                    if ($dato > 0) {
                        $fecha_ingreso = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $fecha_retiro = null;
                try {
                    $dato = intval(trim($row[9]));
                    if ($dato > 0) {
                        $fecha_retiro = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $parte_cps_fecha_ingreso = null;
                try {
                    $dato = intval(trim($row[7]));
                    if ($dato > 0) {
                        $parte_cps_fecha_ingreso = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $parte_cps_fecha_retiro = null;
                try {
                    $dato = intval(trim($row[10]));
                    if ($dato > 0) {
                        $parte_cps_fecha_retiro = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $presentacion_cps_fecha_ingreso = null;
                try {
                    $dato = intval(trim($row[8]));
                    if ($dato > 0) {
                        $presentacion_cps_fecha_ingreso = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $presentacion_cps_fecha_retiro = null;
                try {
                    $dato = intval(trim($row[11]));
                    if ($dato > 0) {
                        $presentacion_cps_fecha_retiro = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $contrato_fecha_ingreso = null;
                try {
                    $dato = intval(trim($row[12]));
                    if ($dato > 0) {
                        $contrato_fecha_ingreso = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $contrato_fecha_retiro = null;
                try {
                    $dato = intval(trim($row[13]));
                    if ($dato > 0) {
                        $contrato_fecha_retiro = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $finiquito_fecha_ingreso = null;
                try {
                    $dato = intval(trim($row[14]));
                    if ($dato > 0) {
                        $finiquito_fecha_ingreso = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $finiquito_fecha_retiro = null;
                try {
                    $dato = intval(trim($row[15]));
                    if ($dato > 0) {
                        $finiquito_fecha_retiro = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}

                MovimientoEmpleado::updateOrCreate([
                    'credencial_id' => $this->credencial_id,
                    'empleado_id' => $empleado->id,
                    'cargo_id' => $cargo->id,
                    'fecha_ingreso' => $fecha_ingreso,
                ], [
                    'fecha_retiro' => $fecha_retiro,
                    'parte_cps_fecha_ingreso' => $parte_cps_fecha_ingreso,
                    'parte_cps_fecha_retiro' => $parte_cps_fecha_retiro,
                    'presentacion_cps_fecha_ingreso' => $presentacion_cps_fecha_ingreso,
                    'presentacion_cps_fecha_retiro' => $presentacion_cps_fecha_retiro,
                    'contrato_fecha_ingreso' => $contrato_fecha_ingreso,
                    'contrato_fecha_retiro' => $contrato_fecha_retiro,
                    'finiquito_fecha_ingreso' => $finiquito_fecha_ingreso,
                    'finiquito_fecha_retiro' => $finiquito_fecha_retiro,
                ]);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw new \Exception($e);
            }
        }
    }
}
