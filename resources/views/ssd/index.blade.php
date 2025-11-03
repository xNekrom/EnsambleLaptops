@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div class="container">
    <h1>Gestión de Discos SSD</h1>
    <a href="{{ route('ssd.create') }}" class="btn btn-primary">Añadir Nuevo SSD</a>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Interfaz</th>
                <th>Capacidad (GB)</th>
                <th>Lectura (MB/s)</th>
                <th>Escritura (MB/s)</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ssds as $ssd)
            <tr>
                <td>{{ $ssd->id }}</td>
                <td>{{ $ssd->name }}</td>
                <td>{{ $ssd->interface }}</td>
                <td>{{ $ssd->capacity_gb }}</td>
                <td>{{ $ssd->read_speed_mbps }}</td>
                <td>{{ $ssd->write_speed_mbps }}</td>
                <td>{{ $ssd->stock }}</td>
                <td>
                    <a href="{{ route('ssd.edit', $ssd->id) }}" class="btn btn-secondary">Editar</a>
                    <form action="{{ route('ssd.destroy', $ssd->id) }}" method="POST" style="display:inline;">
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