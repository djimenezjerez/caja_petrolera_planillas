<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mes extends Model
{
    use HasFactory;

    protected $table = 'meses';
    protected $fillable = [
        'nombre',
        'orden',
    ];
    protected $casts = [
        'nombre' => 'string',
        'orden' => 'integer',
    ];

    public function planillas()
    {
        return $this->hasMany(PlanillaMes::class, 'mes_id');
    }
}
