<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEmpresa extends Model
{
    use HasFactory;

    protected $table = 'tipos_empresas';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'codigo',
    ];

    public function empresas()
    {
        return $this->hasMany(Empresa::class, 'tipo_empresa_id');
    }
}
