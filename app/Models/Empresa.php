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
        'nit',
        'regimen',
        'numero_empleador',
        'fecha_afiliacion',
        'actividad',
        'tipo_empresa',
        'fundempresa',
        'roe',
        'telefonos',
        'ciudad_id',
        'domicilio',
        'empleado_id',
        'domicilio_representante',
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

    public function representante_legal()
    {
        return $this->belongsTo(Empleado::class, 'empleado_id');
    }

    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }
}
