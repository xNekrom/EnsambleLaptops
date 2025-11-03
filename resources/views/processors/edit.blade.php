@extends('layouts.app')

@section('content')
<div class="container"> 
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <h1>Editar Procesador</h1>

    <form action="{{ route('processors.update', $processor->id) }}" method="POST" class="styled-form">
        @csrf
        @method('PUT') {{-- Importante para la actualización --}}

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ $processor->name }}">
        </div>
        <div class="form-group">
            <label for="brand">Marca:</label>
            <input type="text" name="brand" id="brand" value="{{ $processor->brand }}">
        </div>
        <div class="form-group">
            <label for="cores">Núcleos:</label>
            <input type="number" name="cores" id="cores" value="{{ $processor->cores }}">
        </div>
        <div class="form-group">
            <label for="clock_speed_ghz">Velocidad (GHz):</label>
            <input type="text" name="clock_speed_ghz" id="clock_speed_ghz" value="{{ $processor->clock_speed_ghz }}">
        </div>
        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" name="stock" id="stock" value="{{ $processor->stock }}">
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn-primary">Actualizar Procesador</button>
            <a href="{{ route('processors.index') }}" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection