<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('motherboards', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Ej: "ASUS ROG Strix Z690-E"
            $table->string('form_factor'); // Ej: "ATX"
            $table->string('chipset'); // Ej: "Intel Z690"
            $table->unsignedInteger('stock')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('motherboards');
    }
};