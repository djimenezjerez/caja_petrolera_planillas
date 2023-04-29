<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanillaSueldo extends Model
{
    use HasFactory;

    protected $table = 'planilla_sueldos';
    protected $fillable = [
        'planilla_mes_id',
        'empleado_id',
        'cargo_id',
        'sueldo',
    ];
    protected $casts = [
        'planilla_mes_id' => 'integer',
        'empleado_id' => 'integer',
        'cargo_id' => 'integer',
        'sueldo' => 'float',
    ];

    public function planilla_mes()
    {
        return $this->belongsTo(PlanillaMes::class, 'planilla_mes_id');
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
