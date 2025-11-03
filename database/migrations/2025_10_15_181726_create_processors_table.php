<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('processors', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ej: "Intel Core i7-12700K"
            $table->string('brand'); // Ej: "Intel"
            $table->integer('cores'); // Número de núcleos
            $table->decimal('clock_speed_ghz', 4, 2); // Velocidad en GHz, ej: 3.60
            $table->unsignedInteger('stock')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('processors');
    }
};
