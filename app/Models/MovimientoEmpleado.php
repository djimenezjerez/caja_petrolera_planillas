<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoEmpleado extends Model
{
    use HasFactory;

    protected $table = 'movimiento_empleados';
    protected $fillable = [
        'credencial_id',
        'empleado_id',
        'cargo_id',
        'fecha_ingreso',
        'fecha_retiro',
        'parte_cps_fecha_ingreso',
        'parte_cps_fecha_retiro',
        'presentacion_cps_fecha_ingreso',
        'presentacion_cps_fecha_retiro',
        'contrato_fecha_ingreso',
        'contrato_fecha_retiro',
        'finiquito_fecha_ingreso',
        'finiquito_fecha_retiro',
    ];
    protected $casts = [
        'credencial_id' => 'integer',
        'empleado_id' => 'integer',
        'cargo_id' => 'integer',
        'fecha_ingreso' => 'date',
        'fecha_retiro' => 'date',
        'parte_cps_fecha_ingreso' => 'date',
        'parte_cps_fecha_retiro' => 'date',
        'presentacion_cps_fecha_ingreso' => 'date',
        'presentacion_cps_fecha_retiro' => 'date',
        'contrato_fecha_ingreso' => 'date',
        'contrato_fecha_retiro' => 'date',
        'finiquito_fecha_ingreso' => 'date',
        'finiquito_fecha_retiro' => 'date',
    ];

    public function credencial()
    {
        return $this->belongsTo(Credencial::class, 'credencial_id');
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class, 'cargo_id');
    }
}
