<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RamModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type', 'capacity_gb', 'speed_mhz', 'stock'
    ];
}