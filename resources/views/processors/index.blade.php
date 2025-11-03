@extends('layouts.app')

@section('content')
{{-- 1. Añade este div para centrar y limitar el ancho de todo el contenido --}}
<div class="container"> 
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <h1>Gestión de Procesadores</h1>

    <a href="{{ route('processors.create') }}" class="btn btn-primary">Añadir Nuevo Procesador</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif

    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Núcleos</th>
                <th>Velocidad (GHz)</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($processors as $processor)
            <tr>
                <td>{{ $processor->id }}</td>
                <td>{{ $processor->name }}</td>
                <td>{{ $processor->brand }}</td>
                <td>{{ $processor->cores }}</td>
                <td>{{ $processor->clock_speed_ghz }}</td>
                <td>{{ $processor->stock }}</td>
                <td>
                    <a href="{{ route('processors.edit', $processor->id) }}" class="btn btn-secondary">Editar</a>
                    <form action="{{ route('processors.destroy', $processor->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Borrar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div> {{-- 2. Cierra el div contenedor --}}
@endsection