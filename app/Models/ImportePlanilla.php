<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportePlanilla extends Model
{
    use HasFactory;

    protected $table = 'importe_planillas';

    public function planillable()
    {
        return $this->morphTo();
    }
}
