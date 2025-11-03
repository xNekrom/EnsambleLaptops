<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ssds', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ej: "Samsung 980 Pro 1TB"
            $table->string('interface'); // Ej: "NVMe PCIe 4.0"
            $table->integer('capacity_gb'); // Capacidad en GB
            $table->integer('read_speed_mbps'); // Velocidad de lectura
            $table->integer('write_speed_mbps'); // Velocidad de escritura
            $table->unsignedInteger('stock')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ssds');
    }
};