<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';

    public function movimientos_empleado()
    {
        return $this->hasMany(MovimientoEmpleado::class, 'empleado_id');
    }

    public function planilla_sueldo()
    {
        return $this->hasMany(PlanillaSueldo::class, 'empleado_id');
    }

    public function totales()
    {
        return $this->hasMany(TotalPlanilla::class, 'empleado_id');
    }

    public function ciudad()
    {
        $this->belongsTo(Ciudad::class, 'ciudad_id');
    }
}
