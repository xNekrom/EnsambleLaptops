<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ram_modules', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ej: "Corsair Vengeance DDR5 32GB"
            $table->string('type'); // Ej: "DDR5"
            $table->integer('capacity_gb'); // Capacidad en GB
            $table->integer('speed_mhz'); // Velocidad en MHz
            $table->unsignedInteger('stock')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ram_modules');
    }
};
