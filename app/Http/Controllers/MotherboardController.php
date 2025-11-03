<?php

namespace App\Http\Controllers;

use App\Models\Motherboard;
use Illuminate\Http\Request;

class MotherboardController extends Controller
{
    public function index()
    {
        $motherboards = Motherboard::all();
        return view('motherboards.index', compact('motherboards'));
    }

    public function create()
    {
        return view('motherboards.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'form_factor' => 'required|string|max:255',
            'chipset' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
        ]);

        Motherboard::create($validatedData);

        return redirect()->route('motherboards.index')->with('success', 'Placa Madre creada exitosamente.');
    }

    public function edit(Motherboard $motherboard)
    {
        return view('motherboards.edit', compact('motherboard'));
    }

    public function update(Request $request, Motherboard $motherboard)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'form_factor' => 'required|string|max:255',
            'chipset' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
        ]);

        $motherboard->update($validatedData);

        return redirect()->route('motherboards.index')->with('success', 'Placa Madre actualizada exitosamente.');
    }

    public function destroy(Motherboard $motherboard)
    {
        $motherboard->delete();
        return redirect()->route('motherboards.index')->with('success', 'Placa Madre eliminada exitosamente.');
    }
}