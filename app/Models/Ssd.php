<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ssd extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'interface', 'capacity_gb', 'read_speed_mbps', 'write_speed_mbps', 'stock'
    ];
}