@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@section('content')
<div class="container">
    <h1>Gestión de Memorias RAM</h1>
    <a href="{{ route('ram-modules.create') }}" class="btn btn-primary">Añadir Nuevo Módulo RAM</a>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Capacidad (GB)</th>
                <th>Velocidad (MHz)</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ramModules as $ram)
            <tr>
                <td>{{ $ram->id }}</td>
                <td>{{ $ram->name }}</td>
                <td>{{ $ram->type }}</td>
                <td>{{ $ram->capacity_gb }}</td>
                <td>{{ $ram->speed_mhz }}</td>
                <td>{{ $ram->stock }}</td>
                <td>
                    <a href="{{ route('ram-modules.edit', $ram->id) }}" class="btn btn-secondary">Editar</a>
                    <form action="{{ route('ram-modules.destroy', $ram->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Borrar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection