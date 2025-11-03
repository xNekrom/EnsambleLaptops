<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assembly extends Model
{
    use HasFactory;

    /**
     * Los atributos que se pueden asignar masivamente.
     * Le decimos a Laravel que estas columnas son seguras.
     */
    protected $fillable = [
        'processor_id',
        'motherboard_id',
        'ram_module_id',
        'ssd_id',
        'status',
    ];

    /**
     * Define la relación: Un ensamblaje pertenece a un Procesador.
     */
    public function processor()
    {
        return $this->belongsTo(Processor::class);
    }

    /**
     * Define la relación: Un ensamblaje pertenece a una Placa Madre.
     */
    public function motherboard()
    {
        return $this->belongsTo(Motherboard::class);
    }

    /**
     * Define la relación: Un ensamblaje pertenece a un Módulo RAM.
     */
    public function ramModule()
    {
        return $this->belongsTo(RamModule::class);
    }

    /**
     * Define la relación: Un ensamblaje pertenece a un SSD.
     */
    public function ssd()
    {
        return $this->belongsTo(Ssd::class);
    }
}
