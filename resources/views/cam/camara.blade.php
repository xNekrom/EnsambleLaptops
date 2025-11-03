{{-- 1. Hereda la plantilla principal (esto carga el CSS y el Navbar) --}}
@extends('layouts.app')
{{-- 2. Asigna un ID único a la página para estilos específicos --}}
@section('page-id', 'camera-detection-page')

{{-- 3. Define el contenido único de esta página --}}
@section('content')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<div class="container">
    <div class="camera-box">
        <h1>Detección de Componentes</h1>
        <button type="button" id="start-button" onclick="init()">Iniciar Cámara</button>
        <div id="camera-wrapper" class="hidden">
            <div id="webcam-container"></div>
        </div>
        <div id="result-display" class="hidden">
            <h2 id="result-name">Detectando...</h2>
            <div class="confidence-bar">
                <div id="confidence-fill"></div>
            </div>
        </div>
    </div>
</div>

{{-- Los scripts se quedan aquí porque solo se usan en esta página --}}
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@latest/dist/tf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@teachablemachine/image@latest/dist/teachablemachine-image.min.js"></script>

<script type="text/javascript">
    // Tu código JavaScript no necesita cambios
    const URL = "/models/deteccion/";
    let model, webcam;
    let resultName, confidenceFill, cameraWrapper;
    const detectionThreshold = 0.55;

    async function init() {
        document.getElementById('start-button').classList.add('hidden');
        document.getElementById('camera-wrapper').classList.remove('hidden');
        document.getElementById('result-display').classList.remove('hidden');
        resultName = document.getElementById('result-name');
        confidenceFill = document.getElementById('confidence-fill');
        cameraWrapper = document.getElementById('camera-wrapper');
        const modelURL = URL + "model.json";
        const metadataURL = URL + "metadata.json";
        model = await tmImage.load(modelURL, metadataURL);
        const flip = true;
        webcam = new tmImage.Webcam(300, 300, flip);
        await webcam.setup();
        await webcam.play();
        document.getElementById("webcam-container").appendChild(webcam.canvas);
        window.requestAnimationFrame(loop);
    }
    async function loop() {
        webcam.update();
        await predict();
        window.requestAnimationFrame(loop);
    }
    async function predict() {
        const prediction = await model.predict(webcam.canvas);
        const bestPrediction = prediction.reduce((max, current) => current.probability > max.probability ? current : max);
        if (bestPrediction.probability > detectionThreshold) {
            resultName.textContent = bestPrediction.className;
            confidenceFill.style.width = bestPrediction.probability * 100 + '%';
            cameraWrapper.classList.add('success');
        } else {
            resultName.textContent = "Detectando...";
            confidenceFill.style.width = '0%';
            cameraWrapper.classList.remove('success');
        }
    }
</script>
@endsection