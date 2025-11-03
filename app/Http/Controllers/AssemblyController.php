<?php

namespace App\Http\Controllers;

// Importamos todos los modelos y helpers que vamos a necesitar
use App\Models\Assembly;
use App\Models\Motherboard;
use App\Models\Processor;
use App\Models\RamModule;
use App\Models\Ssd;
use App\Models\TestResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Importante para usar transacciones

class AssemblyController extends Controller
{
    /**
     * Crea un nuevo ensamblaje, descuenta el stock, simula las pruebas
     * y guarda todos los resultados.
     */
    // app/Http/Controllers/AssemblyController.php
public function index()
    {
        // Usamos with() para cargar los datos de los componentes relacionados
        // en una sola consulta eficiente (esto se llama "eager loading").
        $assemblies = Assembly::with(['processor', 'motherboard', 'ramModule', 'ssd'])
                                ->latest() // Ordena por los más recientes primero
                                ->paginate(15); // Muestra 15 registros por página

        // Enviamos los datos a la nueva vista que vamos a crear
        return view('assemblies.index', compact('assemblies'));
    }
public function store(Request $request)
{
    // --- NUEVA VERIFICACIÓN PREVIA ---
    // Verificamos si hay al menos un componente de cada tipo con stock
    if (Processor::where('stock', '>', 0)->doesntExist()) {
        return response()->json(['message' => '¡Sin stock! No hay Procesadores disponibles para un nuevo ensamblaje.'], 409); // 409 Conflict
    }
    if (Motherboard::where('stock', '>', 0)->doesntExist()) {
        return response()->json(['message' => '¡Sin stock! No hay Placas Madre disponibles.'], 409);
    }
    if (RamModule::where('stock', '>', 0)->doesntExist()) {
        return response()->json(['message' => '¡Sin stock! No hay módulos de RAM disponibles.'], 409);
    }
    if (Ssd::where('stock', '>', 0)->doesntExist()) {
        return response()->json(['message' => '¡Sin stock! No hay discos SSD disponibles.'], 409);
    }

    try {
        $result = DB::transaction(function () {
            // El resto del código se queda exactamente igual que antes...
            $processor = Processor::where('stock', '>', 0)->inRandomOrder()->firstOrFail();
            $motherboard = Motherboard::where('stock', '>', 0)->inRandomOrder()->firstOrFail();
            $ram = RamModule::where('stock', '>', 0)->inRandomOrder()->firstOrFail();
            $ssd = Ssd::where('stock', '>', 0)->inRandomOrder()->firstOrFail();

            $processor->decrement('stock');
            $motherboard->decrement('stock');
            $ram->decrement('stock');
            $ssd->decrement('stock');

            $assembly = Assembly::create([
                'processor_id' => $processor->id,
                'motherboard_id' => $motherboard->id,
                'ram_module_id' => $ram->id,
                'ssd_id' => $ssd->id,
                'status' => 'En Pruebas',
            ]);

            $testResults = [];
            $allTestsPassed = true;

            $pruebas = [
                ['nombre' => 'Temperatura CPU', 'umbral' => 90, 'unidad' => '°C', 'min' => 60, 'max' => 95, 'comparar' => 'max'],
                ['nombre' => 'Velocidad RAM', 'umbral' => 4800, 'unidad' => 'MHz', 'min' => 4700, 'max' => 5200, 'comparar' => 'min'],
                ['nombre' => 'Escritura SSD', 'umbral' => 1500, 'unidad' => 'MB/s', 'min' => 1200, 'max' => 2000, 'comparar' => 'min'],
                ['nombre' => 'Benchmark General', 'umbral' => 12000, 'unidad' => 'pts', 'min' => 10000, 'max' => 15000, 'comparar' => 'min']
            ];

            foreach ($pruebas as $prueba) {
                $valor = rand($prueba['min'], $prueba['max']);
                $aprobado = ($prueba['comparar'] === 'max' ? $valor <= $prueba['umbral'] : $valor >= $prueba['umbral']);

                if (!$aprobado) {
                    $allTestsPassed = false;
                }

                $testResults[] = TestResult::create([
                    'assembly_id' => $assembly->id,
                    'test_name' => $prueba['nombre'],
                    'result_value' => $valor,
                    'unit' => $prueba['unidad'],
                    'passed' => $aprobado,
                ]);
            }

            $assembly->status = $allTestsPassed ? 'Aprobado' : 'Fallido';
            $assembly->save();

            return [
                'assembly' => $assembly->load(['processor', 'motherboard', 'ramModule', 'ssd']),
                'test_results' => $testResults,
            ];
        });

        return response()->json($result, 201);

    } catch (\Throwable $e) {
        // Este error ahora solo ocurriría por un problema inesperado del servidor.
        return response()->json(['message' => 'Ocurrió un error inesperado en el servidor.'], 500);
    }
}
}