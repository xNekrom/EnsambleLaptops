<?php

namespace App\Http\Controllers;

use App\Models\RamModule;
use Illuminate\Http\Request;

class RamModuleController extends Controller
{
    public function index()
    {
        $ramModules = RamModule::all();
        return view('ram-modules.index', compact('ramModules'));
    }

    public function create()
    {
        return view('ram-modules.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'capacity_gb' => 'required|integer|min:1',
            'speed_mhz' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
        ]);

        RamModule::create($validatedData);

        return redirect()->route('ram-modules.index')->with('success', 'Módulo RAM creado exitosamente.');
    }

    public function edit(RamModule $ramModule)
    {
        return view('ram-modules.edit', compact('ramModule'));
    }

    public function update(Request $request, RamModule $ramModule)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'capacity_gb' => 'required|integer|min:1',
            'speed_mhz' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
        ]);

        $ramModule->update($validatedData);

        return redirect()->route('ram-modules.index')->with('success', 'Módulo RAM actualizado exitosamente.');
    }

    public function destroy(RamModule $ramModule)
    {
        $ramModule->delete();
        return redirect()->route('ram-modules.index')->with('success', 'Módulo RAM eliminado exitosamente.');
    }
}