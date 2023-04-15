<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanillaEmpleado extends Model
{
    use HasFactory;

    protected $table = 'planilla_empleados';

    public function importe()
    {
        return $this->morphOne(ImportePlanilla::class, 'planillable');
    }

    public function planilla()
    {
        return $this->belongsTo(Planilla::class, 'planilla_id');
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
