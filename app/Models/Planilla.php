<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planilla extends Model
{
    use HasFactory;

    protected $table = 'planillas';

    public function gestion()
    {
        return $this->belongsTo(Gestion::class, 'gestion_id');
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    public function meses()
    {
        return $this->hasMany(PlanillaMes::class, 'planilla_id');
    }

    public function totales()
    {
        return $this->hasMany(TotalPlanilla::class, 'planilla_id');
    }
}
