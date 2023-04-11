<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanillaMes extends Model
{
    use HasFactory;

    protected $table = 'planilla_mes';

    public function importe()
    {
        return $this->morphOne(ImportePlanilla::class, 'planillable');
    }

    public function planilla()
    {
        return $this->belongsTo(Planilla::class, 'planilla_id');
    }

    public function mes()
    {
        return $this->belongsTo(Mes::class, 'mes_id');
    }

    public function planilla_sueldo()
    {
        return $this->hasMany(PlanillaSueldo::class, 'planilla_mes_id');
    }
}
