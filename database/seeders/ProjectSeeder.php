<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Instalación de Manto Texsa',
                'slug' => 'instalacion-manto-texsa',
                'description' => 'Este proyecto consistió en la instalación de manto Texsa de 3mm en la Estación de Policía Barrios Unidos. El sistema de impermeabilización con manto Texsa proporciona una protección integral de alta calidad, garantizando la durabilidad y resistencia necesarias para proteger la estructura contra filtraciones y humedades.

El manto Texsa de 3mm ofrece una barrera impermeable de excelente rendimiento, con características de alta adherencia, resistencia a la intemperie y capacidad de adaptación a diferentes superficies. Este sistema asegura una protección efectiva y de larga duración para la infraestructura de la estación de policía.',
                'image' => 'assets/img/gallery/barriou1-convertido-de-jpeg.webp',
                'gallery' => [
                    'assets/img/gallery/barriou1-convertido-de-jpeg.webp',
                    'assets/img/gallery/barriou2-convertido-de-jpeg.webp',
                    'assets/img/gallery/barriou3-convertido-de-jpeg.webp',
                ],
                'client' => 'VARLEX SAS',
                'location' => 'Estación de Policía Barrios Unidos',
                'system' => 'Instalación de Manto Texsa 3MM',
                'project_date' => '2025-09-20',
                'is_featured' => true,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Sellado de Juntas y Grietas',
                'slug' => 'sellado-juntas-grietas',
                'description' => 'Este proyecto de sellado de juntas y grietas utiliza sistema Broncoelástico, con una duración garantizada de 10 años. El sistema Bronco proporciona una solución de alta elasticidad diseñada para controlar movimientos y dilataciones en estructuras de concreto y mampostería, garantizando una protección efectiva contra filtraciones y el deterioro causado por la expansión y contracción térmica.

El sistema Bronco ofrece resistencia superior a la intemperie, adherencia excepcional y capacidad de movimiento que permite adaptarse a los cambios dimensionales de la estructura sin perder su eficacia sellante durante toda su vida útil de 10 años.',
                'image' => 'assets/img/gallery/img1-convertido-de-jpg.webp',
                'gallery' => [
                    'assets/img/gallery/img1-convertido-de-jpg.webp',
                    'assets/img/gallery/valle-convertido-de-jpeg.webp',
                    'assets/img/gallery/img3-convertido-de-jpg.webp',
                    'assets/img/gallery/valle3-convertido-de-jpeg.webp',
                    'assets/img/gallery/valle6-convertido-de-jpeg.webp',
                ],
                'client' => 'Conjunto Valle y Luna',
                'location' => 'Chía, Colombia',
                'system' => 'Sistema Bronco Elástico',
                'project_date' => null,
                'is_featured' => true,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Impermeabilización de Tanques',
                'slug' => 'impermeabilizacion-tanques',
                'description' => 'Este es un sistema de impermeabilización de tanques de agua potable con sistema Planiseal 68 y sello de grietas con Broncoplug cementos hidráulico. Este proyecto garantiza la protección integral de los tanques de almacenamiento de agua, asegurando la calidad del agua potable y previniendo filtraciones que puedan comprometer la estructura.

El sistema Planiseal 68 proporciona una barrera impermeable de alta resistencia, mientras que el Broncoplug asegura el sellado efectivo de grietas y juntas, garantizando la durabilidad y el rendimiento del sistema de impermeabilización a largo plazo.',
                'image' => 'assets/img/gallery/pro5-convertido-de-jpg.webp',
                'gallery' => [
                    'assets/img/gallery/pro5-convertido-de-jpg.webp',
                    'assets/img/gallery/pro2-convertido-de-jpg.webp',
                    'assets/img/gallery/pro3-convertido-de-jpg.webp',
                    'assets/img/gallery/pro4-convertido-de-jpg.webp',
                    'assets/img/gallery/pro1-convertido-de-jpg.webp',
                ],
                'client' => 'Soluciones integrales Tecnibombas S.A.S',
                'location' => 'CR 1 N 6 80, Madrid - Colombia',
                'system' => 'Planiseal 68 + Broncoplug',
                'project_date' => null,
                'is_featured' => true,
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($projects as $projectData) {
            // Actualizar o crear el proyecto basado en el slug
            Project::updateOrCreate(
                ['slug' => $projectData['slug']],
                $projectData
            );
        }
    }
}

