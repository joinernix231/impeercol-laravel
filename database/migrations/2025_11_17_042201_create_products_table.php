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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('name'); // Nombre del producto
            $table->string('slug')->unique(); // Slug para URLs amigables
            $table->text('description'); // Descripción del producto
            $table->string('image')->nullable(); // Imagen principal
            $table->json('gallery')->nullable(); // Galería de imágenes
            $table->string('brand')->nullable(); // Marca del producto
            $table->text('technical_sheet')->nullable(); // Ficha técnica (texto o JSON)
            $table->string('technical_sheet_file')->nullable(); // Archivo PDF de ficha técnica
            $table->integer('order')->default(0); // Orden de visualización
            $table->boolean('is_active')->default(true); // Activo/Inactivo
            $table->boolean('is_featured')->default(false); // Producto destacado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
