<?php

namespace App\Imports;

use App\Models\Cargo;
use App\Models\Ciudad;
use App\Models\Empleado;
use App\Models\MovimientoEmpleado;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MovimientoEmpleadosImport implements ToCollection, WithStartRow
{
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
            logger($row);

            if ($row[3] != null) {
                $ciudad = Ciudad::where('nombre', 'like', "%{$row[3]}%")->orWhere('codigo', 'like', "%{$row[3]}%")->first();
            } else {
                $ciudad = null;
            }

            DB::beginTransaction();
            try {
                $cargo = Cargo::firstOrCreate([
                    'nombre' => mb_strtoupper(trim($row[7])),
                    'empresa_id' => Session::get('empresa_id'),
                ]);
                $empleado = Empleado::updateOrCreate([
                    'cedula_identidad' => $row[1],
                ], [
                    'complemento_cedula' => $row[2],
                    'ciudad_id' => $ciudad ? $ciudad->id : null,
                    'apellido_paterno' => $row[4],
                    'apellido_materno' => $row[5],
                    'nombre' => $row[6],
                ]);

                $fecha_ingreso = null;
                try {
                    $dato = intval($row[8]);
                    if ($dato > 0) {
                        $fecha_ingreso = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $fecha_retiro = null;
                try {
                    $dato = intval($row[11]);
                    if ($dato > 0) {
                        $fecha_retiro = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $parte_cps_fecha_ingreso = null;
                try {
                    $dato = intval($row[9]);
                    if ($dato > 0) {
                        $parte_cps_fecha_ingreso = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $parte_cps_fecha_retiro = null;
                try {
                    $dato = intval($row[12]);
                    if ($dato > 0) {
                        $parte_cps_fecha_retiro = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $presentacion_cps_fecha_ingreso = null;
                try {
                    $dato = intval($row[10]);
                    if ($dato > 0) {
                        $presentacion_cps_fecha_ingreso = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $presentacion_cps_fecha_retiro = null;
                try {
                    $dato = intval($row[13]);
                    if ($dato > 0) {
                        $presentacion_cps_fecha_retiro = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $contrato_fecha_ingreso = null;
                try {
                    $dato = intval($row[14]);
                    if ($dato > 0) {
                        $contrato_fecha_ingreso = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $contrato_fecha_retiro = null;
                try {
                    $dato = intval($row[15]);
                    if ($dato > 0) {
                        $contrato_fecha_retiro = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $finiquito_fecha_ingreso = null;
                try {
                    $dato = intval($row[16]);
                    if ($dato > 0) {
                        $finiquito_fecha_ingreso = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}
                $finiquito_fecha_retiro = null;
                try {
                    $dato = intval($row[17]);
                    if ($dato > 0) {
                        $finiquito_fecha_retiro = Date::excelToDateTimeObject($dato);
                    }
                } catch (\Exception $e) {}

                MovimientoEmpleado::updateOrCreate([
                    'empresa_id' => Session::get('empresa_id'),
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
