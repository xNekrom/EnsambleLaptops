<?php

namespace App\Http\Controllers;

use App\Models\Processor; // Import the Processor model
use Illuminate\Http\Request;

class ProcessorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $processors = Processor::all();
        return view('processors.index', compact('processors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('processors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    // 1. Valida los datos Y guárdalos en una variable
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'brand' => 'required|string|max:255',
        'cores' => 'required|integer|min:1',
        'clock_speed_ghz' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
    ]);

    // 2. Crea el procesador usando SOLO los datos validados
    Processor::create($validatedData); // <-- SOLUCIÓN: Usa solo lo que necesitas

    return redirect()->route('processors.index')
                     ->with('success', 'Procesador creado exitosamente.');
}

    /**
     * Display the specified resource.
     */
    public function show(Processor $processor)
    {
        // Not used for this CRUD, can be left empty or used for a detail view.
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Processor $processor)
    {
        return view('processors.edit', compact('processor'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, Processor $processor)
{
    // 1. Valida los datos Y guárdalos en una variable
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'brand' => 'required|string|max:255',
        'cores' => 'required|integer|min:1',
        'clock_speed_ghz' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
    ]);

    // 2. Actualiza el procesador usando SOLO los datos validados
    $processor->update($validatedData); // <-- SOLUCIÓN: Usa solo lo que necesitas

    return redirect()->route('processors.index')
                     ->with('success', 'Procesador actualizado exitosamente.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Processor $processor)
    {
        $processor->delete();

        return redirect()->route('processors.index')
                         ->with('success', 'Procesador eliminado exitosamente.');
    }
}