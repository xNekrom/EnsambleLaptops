<?php

namespace App\Http\Controllers;

use App\Models\Component; // ¡Importante! Usa el modelo que creaste
use Illuminate\Http\Request;

class ComponentController extends Controller
{
    // Esta función se activa con la ruta /api/components
    public function index()
    {
        // 1. Usa el modelo para obtener todos los componentes de la BD
        $components = Component::all();

        // 2. Devuelve los componentes en formato JSON
        return response()->json($components);
    }
}
