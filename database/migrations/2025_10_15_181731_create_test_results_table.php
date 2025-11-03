<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('test_results', function (Blueprint $table) {
        $table->id();
        $table->foreignId('assembly_id')->constrained()->onDelete('cascade'); // La conexión clave
        $table->string('test_name');
        $table->string('result_value');
        $table->string('unit')->nullable();
        $table->boolean('passed');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('test_results');
    }
};