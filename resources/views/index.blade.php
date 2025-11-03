<!DOCTYPE html>
<html lang="es">
    @section('page-id', 'simulator-page')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de Ensamblaje de Laptops</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    @extends('layouts.app')
    <h1>Simulador de Ensamblaje y Control de Calidad</h1>

    <div class="main-container">
        <div class="panel-izquierdo">
            <h2>Inventario de Componentes</h2>
            <div id="inventario-display">
                <p>Placas Madre: <span id="stock-motherboard"></span></p>
                <p>Procesadores (CPU): <span id="stock-cpu"></span></p>
                <p>Memorias RAM: <span id="stock-ram"></span></p>
                <p>Discos SSD: <span id="stock-ssd"></span></p>
            </div>
            <button id="iniciar-simulacion">Iniciar Nuevo Ensamblaje</button>
        </div>

        <div class="panel-derecho">
            <h2>Línea de Ensamblaje</h2>
            <div id="banda-transportadora">
                <div id="laptop-chasis"></div>
                <div class="estacion" style="left: 20%;">CPU</div>
                <div class="estacion" style="left: 45%;">RAM</div>
                <div class="estacion" style="left: 70%;">SSD</div>
            </div>
            <div id="log-simulacion">
                <h3>Registro de Eventos:</h3>
                <div id="log-box"></div>
            </div>
        </div>
    </div>

   <div id="seccion-pruebas">
        <h2>Resultados de Control de Calidad</h2>
        <div class="pruebas-container">
            
            <div id="resultados-pruebas">
                </div>
            <div class="grafica-container">
                <canvas id="grafica-resultados"></canvas>
            </div>

         <div class="grafica-container">
    <h3>Estado General de Lotes</h3>
    
    <div class="chart-wrapper"> 
        <canvas id="grafica-estado-general"></canvas>
    </div>

</div>

        </div>
        <p><i>*Los datos se actualizan con cada nuevo ensamblaje.</i></p>
    </div>

    

    <script src="{{ asset('js/script.js') }}"></script>
</body>

@endsection
</html>