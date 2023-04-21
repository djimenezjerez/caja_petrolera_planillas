<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudades';
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'codigo',
    ];
    protected $casts = [
        'nombre' =>'string',
        'codigo' =>'string',
    ];

    public function empleados()
    {
        $this->hasMany(Empleado::class, 'ciudad_id');
    }
}
