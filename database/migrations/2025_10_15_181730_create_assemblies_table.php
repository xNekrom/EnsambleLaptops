<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assemblies', function (Blueprint $table) {
            $table->id();

            // --- NUEVAS COLUMNAS (LLAVES FORÁNEAS) ---
            // Vincula este ensamblaje con un registro específico de cada componente.
            $table->foreignId('processor_id')->constrained('processors');
            $table->foreignId('motherboard_id')->constrained('motherboards');
            $table->foreignId('ram_module_id')->constrained('ram_modules');
            $table->foreignId('ssd_id')->constrained('ssds');

            // --- NUEVA COLUMNA DE ESTADO ---
            // Guarda el resultado final del conjunto de pruebas.
            $table->string('status')->default('Pendiente'); // Ej: Aprobado, Fallido

            $table->timestamps(); // Para saber cuándo se ensambló
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assemblies');
    }
};