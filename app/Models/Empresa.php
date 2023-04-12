<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';

    protected $fillable = [
        'nombre',
    ];

    public function cargos()
    {
        return $this->hasMany(Cargo::class, 'empresa_id');
    }

    public function movimientos_empleado()
    {
        return $this->hasMany(MovimientoEmpleado::class, 'empresa_id');
    }

    public function credencial()
    {
        return $this->hasMany(Credencial::class, 'empresa_id');
    }
}
