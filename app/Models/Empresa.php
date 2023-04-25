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
        'regimen_tributario_id',
        'numero_empleador',
        'fecha_afiliacion',
        'actividad',
        'tipo_empresa_id',
        'fundempresa',
        'roe',
        'telefonos',
        'ciudad_id',
        'domicilio',
        'empleado_id',
        'domicilio_representante',
    ];
    protected $casts = [
        'nombre' => 'string',
        'nit' => 'integer',
        'regimen_tributario_id' => 'integer',
        'numero_empleador' => 'string',
        'fecha_afiliacion' => 'date',
        'actividad' => 'string',
        'tipo_empresa_id' => 'integer',
        'fundempresa' => 'string',
        'roe' => 'string',
        'telefonos' => 'string',
        'ciudad_id' => 'integer',
        'domicilio' => 'string',
        'empleado_id' => 'integer',
        'domicilio_representante' => 'string',
    ];

    public function regimen_tributario()
    {
        return $this->belongsTo(RegimenTributario::class, 'regimen_tributario_id');
    }

    public function tipo_empresa()
    {
        return $this->belongsTo(TipoEmpresa::class, 'tipo_empresa_id');
    }

    public function cargos()
    {
        return $this->hasMany(Cargo::class, 'empresa_id');
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
