<?php

namespace App\Http\Controllers;

use App\Models\Assembly;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index()
    {
        // Contamos cuántos registros hay en la tabla 'assemblies' para cada estado.
        $stats = [
            'aprobadas' => Assembly::where('status', 'Aprobado')->count(),
            'fallidas' => Assembly::where('status', 'Fallido')->count(),
        ];

        return response()->json($stats);
    }
}