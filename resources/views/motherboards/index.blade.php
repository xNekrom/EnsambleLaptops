@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@section('content')
<div class="container">
    <h1>Gestión de Placas Madre</h1>
    <a href="{{ route('motherboards.create') }}" class="btn btn-primary">Añadir Nueva Placa Madre</a>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Factor de Forma</th>
                <th>Chipset</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($motherboards as $motherboard)
            <tr>
                <td>{{ $motherboard->id }}</td>
                <td>{{ $motherboard->name }}</td>
                <td>{{ $motherboard->form_factor }}</td>
                <td>{{ $motherboard->chipset }}</td>
                <td>{{ $motherboard->stock }}</td>
                <td>
                    <a href="{{ route('motherboards.edit', $motherboard->id) }}" class="btn btn-secondary">Editar</a>
                    <form action="{{ route('motherboards.destroy', $motherboard->id) }}" method="POST" style="display:inline;">
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
@endsection@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Gestión de Placas Madre</h1>
    <a href="{{ route('motherboards.create') }}" class="btn btn-primary">Añadir Nueva Placa Madre</a>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">{{ $message }}</div>
    @endif
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Factor de Forma</th>
                <th>Chipset</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($motherboards as $motherboard)
            <tr>
                <td>{{ $motherboard->id }}</td>
                <td>{{ $motherboard->name }}</td>
                <td>{{ $motherboard->form_factor }}</td>
                <td>{{ $motherboard->chipset }}</td>
                <td>{{ $motherboard->stock }}</td>
                <td>
                    <a href="{{ route('motherboards.edit', $motherboard->id) }}" class="btn btn-secondary">Editar</a>
                    <form action="{{ route('motherboards.destroy', $motherboard->id) }}" method="POST" style="display:inline;">
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