@extends('layouts.app') {{-- Hereda el Navbar y la estructura principal --}}

@section('content') {{-- Define el contenido único de esta página --}}
<div class="container"> 
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<h1>Añadir Nuevo Procesador</h1>


    <form action="{{ route('processors.store') }}" method="POST" class="styled-form">
        @csrf
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" placeholder="Ej: Core i5-13600K" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="brand">Marca:</label>
            <input type="text" name="brand" id="brand" placeholder="Ej: Intel" value="{{ old('brand') }}">
        </div>
        <div class="form-group">
            <label for="cores">Núcleos:</label>
            <input type="number" name="cores" id="cores" placeholder="Ej: 14" value="{{ old('cores') }}">
        </div>
        <div class="form-group">
            <label for="clock_speed_ghz">Velocidad (GHz):</label>
            <input type="text" name="clock_speed_ghz" id="clock_speed_ghz" placeholder="Ej: 3.50" value="{{ old('clock_speed_ghz') }}">
        </div>
        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" name="stock" id="stock" placeholder="Ej: 50" value="{{ old('stock') }}">
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn-primary">Guardar Procesador</button>
            <a href="{{ route('processors.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection