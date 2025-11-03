@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div class="container">
    <h1>Editar Disco SSD</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif
    <form action="{{ route('ssd.update', $ssd->id) }}" method="POST" class="styled-form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Nombre:</label>
            <input type="text" name="name" class="form-control" value="{{ $ssd->name }}">
        </div>
        <div class="form-group">
            <label>Interfaz:</label>
            <input type="text" name="interface" class="form-control" value="{{ $ssd->interface }}">
        </div>
        <div class="form-group">
            <label>Capacidad (GB):</label>
            <input type="number" name="capacity_gb" class="form-control" value="{{ $ssd->capacity_gb }}">
        </div>
        <div class="form-group">
            <label>Velocidad de Lectura (MB/s):</label>
            <input type="number" name="read_speed_mbps" class="form-control" value="{{ $ssd->read_speed_mbps }}">
        </div>
        <div class="form-group">
            <label>Velocidad de Escritura (MB/s):</label>
            <input type="number" name="write_speed_mbps" class="form-control" value="{{ $ssd->write_speed_mbps }}">
        </div>
        <div class="form-group">
            <label>Stock:</label>
            <input type="number" name="stock" class="form-control" value="{{ $ssd->stock }}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('ssd.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection