<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    use HasFactory;

    protected $table = 'cargos';

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function movimientos_empleado()
    {
        return $this->hasMany(MovimientoEmpleado::class, 'cargo_id');
    }

    public function planilla_sueldo()
    {
        return $this->hasMany(PlanillaSueldo::class, 'cargo_id');
    }

    public function totales()
    {
        return $this->hasMany(TotalPlanilla::class, 'cargo_id');
    }
}
