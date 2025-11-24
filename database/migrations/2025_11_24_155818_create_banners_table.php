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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Título del banner
            $table->string('subtitle')->nullable(); // Subtítulo del banner
            $table->string('image')->nullable(); // Ruta de la imagen de fondo
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
        Schema::dropIfExists('banners');
    }
};
