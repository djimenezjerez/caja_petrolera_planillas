<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudad';
    public $timestamps = false;

    public function empleados()
    {
        $this->hasMany(Empleado::class, 'ciudad_id');
    }
}
