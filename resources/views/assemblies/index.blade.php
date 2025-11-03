@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div class="container">
    <h1>Historial de Ensamblajes</h1>

    <div class="styled-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Componentes Utilizados</th>
                    <th>Estado Final</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($assemblies as $assembly)
                <tr>
                    <td><strong>#{{ $assembly->id }}</strong></td>
                    <td>{{ $assembly->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <ul>
                            <li><strong>CPU:</strong> {{ $assembly->processor->name }}</li>
                            <li><strong>Placa:</strong> {{ $assembly->motherboard->name }}</li>
                            <li><strong>RAM:</strong> {{ $assembly->ramModule->name }}</li>
                            <li><strong>SSD:</strong> {{ $assembly->ssd->name }}</li>
                        </ul>
                    </td>
                    <td>
                        @if ($assembly->status == 'Aprobado')
                            <span class="status-aprobado">Aprobado</span>
                        @else
                            <span class="status-fallido">Fallido</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Aún no se ha realizado ningún ensamblaje.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Esto mostrará los enlaces de paginación si hay más de 15 registros --}}
    <div class="pagination-links">
        {{ $assemblies->links() }}
    </div>
</div>
@endsection