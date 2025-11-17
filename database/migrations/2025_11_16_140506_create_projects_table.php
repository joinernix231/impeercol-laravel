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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Título del proyecto
            $table->string('slug')->unique(); // Slug para URLs amigables
            $table->text('description'); // Descripción del proyecto
            $table->string('image')->nullable(); // Imagen principal
            $table->json('gallery')->nullable(); // Galería de imágenes (array JSON)
            $table->string('client')->nullable(); // Cliente
            $table->string('location')->nullable(); // Ubicación
            $table->string('system')->nullable(); // Sistema utilizado
            $table->date('project_date')->nullable(); // Fecha del proyecto
            $table->boolean('is_featured')->default(false); // Proyecto destacado (para mostrar en home)
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
        Schema::dropIfExists('projects');
    }
};
