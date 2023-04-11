<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';

    public function cargos()
    {
        return $this->hasMany(Cargo::class, 'empresa_id');
    }

    public function movimientos_empleado()
    {
        return $this->hasMany(MovimientoEmpleado::class, 'empresa_id');
    }

    public function planilla()
    {
        return $this->hasMany(Empresa::class, 'empresa_id');
    }
}
