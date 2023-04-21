<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    use HasFactory;

    protected $table = 'planillas';
    protected $fillable = [
        'gestion_id',
        'credencial_id',
    ];
    protected $casts = [
        'gestion_id' => 'integer',
        'credencial_id' => 'integer',
    ];

    public function gestion()
    {
        return $this->belongsTo(Gestion::class, 'gestion_id');
    }

    public function credencial()
    {
        return $this->belongsTo(Credencial::class, 'credencial_id');
    }

    public function meses()
    {
        return $this->hasMany(PlanillaMes::class, 'planilla_id');
    }

    public function empleados()
    {
        return $this->hasMany(PlanillaEmpleado::class, 'planilla_id');
    }
}
