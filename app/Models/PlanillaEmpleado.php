<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanillaEmpleado extends Model
{
    use HasFactory;

    protected $table = 'planilla_empleados';
    protected $fillable = [
        'planilla_id',
        'empleado_id',
        'cargo_id',
        'orden',
        'total',
    ];
    protected $casts = [
        'planilla_id' => 'integer',
        'empleado_id' => 'integer',
        'cargo_id' => 'integer',
        'orden' => 'integer',
        'total' => 'float',
    ];

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
