<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gestion extends Model
{
    use HasFactory;

    protected $table = 'gestiones';
    protected $fillable = [
        'anio'
    ];
    protected $casts = [
        'anio' => 'integer'
    ];

    public function planilla()
    {
        return $this->hasMany(Planilla::class, 'gestion_id');
    }
}
