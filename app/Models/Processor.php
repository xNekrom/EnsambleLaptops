<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Processor extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     * Esta es la "lista VIP" de campos que permitimos guardar.
     */
    protected $fillable = [
        'name',
        'brand',
        'cores',
        'clock_speed_ghz',
        'stock',
    ];
}