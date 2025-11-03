import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            // ESTA ES LA LÍNEA QUE ARREGLAMOS:
            // Le decimos que busque los archivos fuente en 'resources/'
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
