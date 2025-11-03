<?php

namespace App\Http\Controllers;

use App\Models\Ssd;
use Illuminate\Http\Request;

class SsdController extends Controller
{
    public function index()
    {
        $ssds = Ssd::all();
        return view('ssd.index', compact('ssds'));
    }

    public function create()
    {
        return view('ssd.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'interface' => 'required|string|max:255',
            'capacity_gb' => 'required|integer|min:1',
            'read_speed_mbps' => 'required|integer|min:1',
            'write_speed_mbps' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
        ]);

        Ssd::create($validatedData);

        return redirect()->route('ssd.index')->with('success', 'Disco SSD creado exitosamente.');
    }

    public function edit(Ssd $ssd)
    {
        return view('ssd.edit', compact('ssd'));
    }

    public function update(Request $request, Ssd $ssd)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'interface' => 'required|string|max:255',
            'capacity_gb' => 'required|integer|min:1',
            'read_speed_mbps' => 'required|integer|min:1',
            'write_speed_mbps' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
        ]);

        $ssd->update($validatedData);

        return redirect()->route('ssd.index')->with('success', 'Disco SSD actualizado exitosamente.');
    }

    public function destroy(Ssd $ssd)
    {
        $ssd->delete();
        return redirect()->route('ssd.index')->with('success', 'Disco SSD eliminado exitosamente.');
    }
}