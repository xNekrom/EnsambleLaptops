{{-- 
    1. USAMOS EL COMPONENTE DE LAYOUT DE BREEZE.
       Esto automáticamente añade el <html>, <head>, <body>,
       el CSS de Tailwind, el JS de Alpine, y el navbar 
       (layouts.navigation.blade.php).
--}}
<x-app-layout>

    {{-- 2. PONEMOS EL TÍTULO EN EL "SLOT" DEL HEADER --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- Usamos el <h1> de tu código original como título --}}
            {{ __('Simulador de Ensamblaje y Control de Calidad') }}
        </h2>
    </x-slot>

    {{-- 3. AÑADIMOS TUS ESTILOS Y SCRIPTS PERSONALIZADOS --}}
    {{-- (Los ponemos al inicio, Blade los manejará) --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>


    {{-- 4. TODO TU CONTENIDO VA AQUÍ (el "$slot" principal) --}}
    
    {{-- Quitamos el <h1> que ya pusimos en el header --}}
    {{-- Quitamos el @include('partials.navbar') porque x-app-layout ya lo incluye --}}

    <div class="py-12"> {{-- Añadimos un padding estándar de Breeze --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> {{-- Contenedor estándar de Breeze --}}
            
            {{-- Aquí empieza tu contenido original --}}
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

            <div id="seccion-pruebas" class="mt-8"> {{-- Añadí un margen superior --}}
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
            
        </div>
    </div>


    {{-- 5. TU SCRIPT PERSONALIZADO AL FINAL --}}
    {{-- Lo envolvemos en un slot 'scripts' si tu app.blade.php lo tiene, 
         si no, simplemente lo ponemos al final. --}}
    <script src="{{ asset('js/script.js') }}" defer></script>

</x-app-layout>
