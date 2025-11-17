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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre de la categoría
            $table->string('slug')->unique(); // Slug para URLs amigables
            $table->text('description')->nullable(); // Descripción opcional
            $table->string('image')->nullable(); // Imagen de la categoría
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
        Schema::dropIfExists('categories');
    }
};
