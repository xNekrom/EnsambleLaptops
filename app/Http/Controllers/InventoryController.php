<?php

namespace App\Http\Controllers;

// ¡Importa los modelos que acabamos de crear!
use App\Models\Motherboard;
use App\Models\Processor;
use App\Models\RamModule;
use App\Models\Ssd;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Obtiene la suma del stock de cada tabla de componentes
     * y lo devuelve en un solo objeto JSON.
     */
    public function index()
    {
        // Pide a la base de datos que sume la columna 'stock' de cada tabla
        $inventory = [
            'motherboard' => Motherboard::sum('stock'),
            'cpu' => Processor::sum('stock'),
            'ram' => RamModule::sum('stock'),
            'ssd' => Ssd::sum('stock'),
        ];

        // Devuelve el resultado como una respuesta JSON
        return response()->json($inventory);
    }
}