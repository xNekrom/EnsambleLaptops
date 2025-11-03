@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div class="container">
    <h1>Editar Módulo RAM</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Ups! Hubo problemas con tu entrada.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ram-modules.update', $ramModule->id) }}" method="POST" class="styled-form">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ $ramModule->name }}">
        </div>

        <div class="form-group">
            <label for="type">Tipo (ej: DDR4, DDR5):</label>
            <input type="text" name="type" id="type" value="{{ $ramModule->type }}">
        </div>

        <div class="form-group">
            <label for="capacity_gb">Capacidad (GB):</label>
            <input type="number" name="capacity_gb" id="capacity_gb" value="{{ $ramModule->capacity_gb }}">
        </div>
        
        <div class="form-group">
            <label for="speed_mhz">Velocidad (MHz):</label>
            <input type="number" name="speed_mhz" id="speed_mhz" value="{{ $ramModule->speed_mhz }}">
        </div>

        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" name="stock" id="stock" value="{{ $ramModule->stock }}">
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Actualizar Módulo RAM</button>
            <a href="{{ route('ram-modules.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection