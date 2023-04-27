<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportePlanilla extends Model
{
    use HasFactory;

    protected $table = 'importe_planillas';
    protected $fillable = [
        'cot_01',
        'liquidacion_cps',
        'afp_1',
        'afp_2',
        'formularios_pagados',
        'aporte_laboral',
        'aguinaldo',
        'ministerio_trabajo',
        'diferencias',
        'calculado',
    ];
    protected $casts = [
        'cot_01' => 'float',
        'liquidacion_cps' => 'float',
        'afp_1' => 'float',
        'afp_2' => 'float',
        'formularios_pagados' => 'float',
        'aporte_laboral' => 'float',
        'aguinaldo' => 'float',
        'ministerio_trabajo' => 'float',
        'diferencias' => 'float',
        'calculado' => 'boolean',
    ];

    public function planillable()
    {
        return $this->morphTo();
    }
}
