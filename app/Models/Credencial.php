<?php

namespace App\Models;

use Kirschbaum\PowerJoins\PowerJoins;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Credencial extends Model
{
    use HasFactory, PowerJoins;

    protected $table = 'credenciales';
    protected $fillable = [
        'empresa_id',
        'user_id',
        'cite',
        'inicio_fizcalizacion',
    ];
    protected $casts = [
        'empresa_id' => 'integer',
        'user_id' => 'integer',
        'cite' => 'string',
        'inicio_fizcalizacion' => 'date',
    ];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function planillas()
    {
        return $this->hasMany(Planilla::class, 'credencial_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getGestionesAttribute()
    {
        return $this->planillas()->with(['gestion' => function($query) {
            return $query->orderBy('anio');
        }])->get()->pluck('gestion');
    }

    public function movimientos_empleado()
    {
        return $this->hasMany(MovimientoEmpleado::class, 'empresa_id');
    }
}
