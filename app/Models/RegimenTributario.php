<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegimenTributario extends Model
{
    use HasFactory;

    protected $table = 'regimenes_tributarios';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'codigo',
    ];

    public function empresas()
    {
        return $this->hasMany(Empresa::class, 'regimen_tributario_id');
    }
}
