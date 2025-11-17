<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Nombre de la marca
            $table->string('slug')->unique()->nullable(); // Slug para URLs amigables
            $table->text('description')->nullable(); // Descripción de la marca
            $table->string('logo')->nullable(); // Logo de la marca
            $table->integer('order')->default(0); // Orden de visualización
            $table->boolean('is_active')->default(true); // Activo/Inactivo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};

