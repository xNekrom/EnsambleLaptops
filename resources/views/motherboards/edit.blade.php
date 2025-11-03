@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@section('content')
<div class="container">
    <h1>Editar Placa Madre</h1>
    <form action="{{ route('motherboards.update', $motherboard->id) }}" method="POST" class="styled-form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $motherboard->name }}">
        </div>
        <div class="form-group">
            <label for="form_factor">Factor de Forma:</label>
            <input type="text" name="form_factor" id="form_factor" class="form-control" value="{{ $motherboard->form_factor }}">
        </div>
        <div class="form-group">
            <label for="chipset">Chipset:</label>
            <input type="text" name="chipset" id="chipset" class="form-control" value="{{ $motherboard->chipset }}">
        </div>
        <div class="form-group">
            <label for="stock">Stock:</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ $motherboard->stock }}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('motherboards.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection