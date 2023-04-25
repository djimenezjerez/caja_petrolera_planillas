<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    protected $fillable = [
        'apellido_paterno',
        'apellido_materno',
        'nombre',
        'cedula_identidad',
        'complemento_cedula',
        'ciudad_id',
    ];
    protected $casts = [
        'apellido_paterno' => 'string',
        'apellido_materno' => 'string',
        'nombre' => 'string',
        'cedula_identidad' => 'integer',
        'complemento_cedula' => 'string',
        'ciudad_id' => 'integer',
    ];

    public function movimientos_empleado()
    {
        return $this->hasMany(MovimientoEmpleado::class, 'empleado_id');
    }

    public function sueldos()
    {
        return $this->hasMany(PlanillaSueldo::class, 'empleado_id');
    }

    public function planillas()
    {
        return $this->hasMany(PlanillaEmpleado::class, 'empleado_id');
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }

    public function representaciones_legales()
    {
        return $this->hasMany(Empresa::class, 'empleado_id');
    }

    public function getCedulaCompletaAttribute()
    {
        return implode(' ', array_filter([$this->cedula_identidad, $this->complemento_cedula, $this->ciudad ? $this->ciudad->codigo : null]));
    }

    public function getNombreCompletoAttribute()
    {
        return implode(' ', array_filter([$this->apellido_paterno, $this->apellido_materno, $this->nombre]));
    }
}
