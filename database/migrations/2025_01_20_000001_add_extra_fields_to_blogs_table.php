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
        Schema::table('blogs', function (Blueprint $table) {
            // Tags para categorizar el artículo
            $table->json('tags')->nullable()->after('gallery');
            
            // Video (URL de YouTube, Vimeo, etc.)
            $table->string('video_url')->nullable()->after('tags');
            
            // Tiempo de lectura estimado (en minutos)
            $table->integer('reading_time')->nullable()->after('video_url');
            
            // Cita destacada o frase importante
            $table->text('featured_quote')->nullable()->after('reading_time');
            
            // Tips o consejos prácticos
            $table->text('tips')->nullable()->after('featured_quote');
            
            // Dificultad del proyecto (básico, intermedio, avanzado)
            $table->enum('difficulty', ['básico', 'intermedio', 'avanzado'])->nullable()->after('tips');
            
            // Tiempo estimado del proyecto (ej: "2-3 horas", "1 día")
            $table->string('estimated_time')->nullable()->after('difficulty');
            
            // Materiales necesarios
            $table->text('materials')->nullable()->after('estimated_time');
            
            // Herramientas necesarias
            $table->text('tools')->nullable()->after('materials');
            
            // Vista previa/thumbnail (diferente de la imagen principal)
            $table->string('thumbnail')->nullable()->after('image');
            
            // Número de vistas
            $table->integer('views_count')->default(0)->after('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn([
                'tags',
                'video_url',
                'reading_time',
                'featured_quote',
                'tips',
                'difficulty',
                'estimated_time',
                'materials',
                'tools',
                'thumbnail',
                'views_count',
            ]);
        });
    }
};





