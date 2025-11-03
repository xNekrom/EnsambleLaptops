document.addEventListener('DOMContentLoaded', () => {
    // Referencias a los elementos del DOM
    const iniciarBtn = document.getElementById('iniciar-simulacion');
    const logBox = document.getElementById('log-box');
    const resultadosPruebas = document.getElementById('resultados-pruebas');
    const ctxResultados = document.getElementById('grafica-resultados').getContext('2d');
    const ctxEstadoGeneral = document.getElementById('grafica-estado-general').getContext('2d');

    let miGraficaResultados;
    let miGraficaEstado;
    let laptopChasis = document.getElementById('laptop-chasis');

    // --- FUNCIONES PARA ACTUALIZAR LA PANTALLA ---

    function log(mensaje) {
        logBox.innerHTML += `<p>${new Date().toLocaleTimeString()}: ${mensaje}</p>`;
        logBox.scrollTop = logBox.scrollHeight;
    }

    function actualizarInventarioDisplay(inventario) {
        document.getElementById('stock-motherboard').textContent = inventario.motherboard || 0;
        document.getElementById('stock-cpu').textContent = inventario.cpu || 0;
        document.getElementById('stock-ram').textContent = inventario.ram || 0;
        document.getElementById('stock-ssd').textContent = inventario.ssd || 0;
    }

    function crearOActualizarGraficaResultados(testResults) {
        if (miGraficaResultados) miGraficaResultados.destroy();
        
        const labels = testResults.map(d => d.test_name);
        const valores = testResults.map(d => d.result_value);
        const colores = testResults.map(d => d.passed ? 'rgba(75, 192, 192, 0.6)' : 'rgba(255, 99, 132, 0.6)');

        miGraficaResultados = new Chart(ctxResultados, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{ label: 'Resultado de Pruebas', data: valores, backgroundColor: colores }]
            },
            options: {
                scales: { y: { beginAtZero: true } },
                plugins: { legend: { display: false } },
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    function crearOActualizarGraficaEstado(stats) {
        if (miGraficaEstado) miGraficaEstado.destroy();

        miGraficaEstado = new Chart(ctxEstadoGeneral, {
            type: 'doughnut',
            data: {
                labels: ['Aprobadas', 'Con Fallos'],
                datasets: [{
                    label: 'Estado General',
                    data: [stats.aprobadas, stats.fallidas],
                    backgroundColor: ['rgba(40, 167, 69, 0.7)', 'rgba(220, 53, 69, 0.7)'],
                    borderColor: ['rgba(40, 167, 69, 1)', 'rgba(220, 53, 69, 1)'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top' } }
            }
        });
    }

    // --- FUNCIONES PARA HABLAR CON LA API DE LARAVEL ---

    async function fetchInventory() {
        try {
            const response = await fetch('/api/inventory');
            const inventario = await response.json();
            actualizarInventarioDisplay(inventario);
        } catch (error) {
            console.error('Error al cargar inventario:', error);
            log('❌ No se pudo conectar con el servidor para obtener el inventario.');
        }
    }

    async function fetchStats() {
        try {
            const response = await fetch('/api/stats');
            const stats = await response.json();
            crearOActualizarGraficaEstado(stats);
        } catch (error) {
            console.error('Error al cargar estadísticas:', error);
        }
    }

    // --- EVENTO PRINCIPAL DEL BOTÓN (MODIFICADO CON TIMERS) ---

    iniciarBtn.addEventListener('click', async () => {
        iniciarBtn.disabled = true;
        iniciarBtn.textContent = 'Ensamblando...';
        logBox.innerHTML = '';
        resultadosPruebas.innerHTML = '';
        if (miGraficaResultados) miGraficaResultados.destroy();
        
        log("▶️  Iniciando ensamblaje y enviando petición al servidor...");

        // Inicia la animación visual del chasis
        const chasisClonado = laptopChasis.cloneNode(true);
        chasisClonado.innerHTML = 'Placa Base<br>'; // Componente base
        chasisClonado.classList.remove('en-movimiento');
        laptopChasis.parentNode.replaceChild(chasisClonado, laptopChasis);
        laptopChasis = chasisClonado;
        setTimeout(() => laptopChasis.classList.add('en-movimiento'), 50);

        try {
            // Llamamos a la API. El backend hace todo al instante.
            const response = await fetch('/api/assemblies', { method: 'POST' });

            if (!response.ok) {
                const errorData = await response.json();
                throw new Error(errorData.message || 'Error desconocido del servidor.');
            }

            const data = await response.json(); // Obtenemos la respuesta completa del servidor

            // --- AQUÍ EMPIEZA LA MAGIA DE LOS TIMERS ---

            // 1. Añadir CPU después de 1700ms
            setTimeout(() => {
                log(`✔️ Componente [CPU] agregado: ${data.assembly.processor.name}`);
                laptopChasis.innerHTML += '+ CPU<br>';
            }, 1700);

            // 2. Añadir RAM después de 2000ms + 1600ms = 3600ms
            setTimeout(() => {
                log(`✔️ Componente [RAM] agregado: ${data.assembly.ram_module.name}`);
                laptopChasis.innerHTML += '+ RAM<br>';
            }, 3600);

            // 3. Añadir SSD después de 3900ms + 1600ms = 5500ms
            setTimeout(() => {
                log(`✔️ Componente [SSD] agregado: ${data.assembly.ssd.name}`);
                laptopChasis.innerHTML += '+ SSD<br>';
            }, 5500);

            // 4. Mostrar resultados finales después de que todo se haya "ensamblado"
            setTimeout(() => {
                log(`💻 Ensamblaje #${data.assembly.id} completado. Iniciando pruebas...`);
                log(`Resultado final: ${data.assembly.status}`);

                data.test_results.forEach(test => {
                    const resultadoDiv = document.createElement('div');
                    resultadoDiv.classList.add('resultado', test.passed ? 'aprobado' : 'no-aprobado');
                    resultadoDiv.innerHTML = `<strong>${test.test_name}:</strong> ${test.result_value} ${test.unit} - <strong>${test.passed ? 'APROBADO' : 'NO APROBADO'}</strong>`;
                    resultadosPruebas.appendChild(resultadoDiv);
                });
                
                crearOActualizarGraficaResultados(data.test_results);
                fetchInventory(); // Actualizamos el stock visible
                fetchStats();     // Actualizamos las estadísticas generales
                
                iniciarBtn.disabled = false;
                iniciarBtn.textContent = 'Iniciar Nuevo Ensamblaje';
            }, 6800); // Un segundo después del último componente

        } catch (error) {
            console.error('Falló el ensamblaje:', error);
            log(`❌ Error: ${error.message}`);
            laptopChasis.classList.remove('en-movimiento');
            iniciarBtn.disabled = false;
            iniciarBtn.textContent = 'Iniciar Nuevo Ensamblaje';
        }
    });

    // --- CARGA INICIAL ---
    log("Cargando estado inicial desde el servidor...");
    fetchInventory();
    fetchStats();
});