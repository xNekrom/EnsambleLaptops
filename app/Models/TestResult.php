<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'assembly_id',
        'test_name',
        'result_value',
        'unit',
        'passed',
    ];

    /**
     * Obtiene el ensamblaje al que pertenece este resultado de prueba.
     */
    public function assembly()
    {
        return $this->belongsTo(Assembly::class);
    }
}