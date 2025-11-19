<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'Guía Completa de Impermeabilización para Techos en Bogotá',
                'slug' => 'guia-impermeabilizacion-techos-bogota',
                'excerpt' => 'Descubre los mejores productos y técnicas para impermeabilizar techos en Bogotá. Protege tu hogar contra las lluvias constantes de la capital colombiana.',
                'content' => 'Bogotá es una ciudad conocida por sus lluvias constantes durante gran parte del año. Por esta razón, la impermeabilización de techos se convierte en una necesidad fundamental para proteger las estructuras de los hogares y edificios.

En IMPEERCOL, llevamos más de 15 años ofreciendo soluciones de impermeabilización de alta calidad. En este artículo te compartimos una guía completa sobre cómo proteger tu techo de manera efectiva.

## ¿Por qué es importante impermeabilizar tu techo?

Las lluvias constantes en Bogotá pueden causar filtraciones que generan:
- Humedad en las paredes y techos
- Deterioro de la estructura
- Problemas de salud por moho y hongos
- Pérdida de valor de la propiedad

## Productos recomendados

En IMPEERCOL trabajamos con las mejores marcas del mercado:

### Sika
Productos de impermeabilización de alto rendimiento, ideales para techos planos y con pendiente.

### Texsa
Sistemas de impermeabilización con membranas de alta calidad y durabilidad.

### Metic
Soluciones integrales para diferentes tipos de superficies.

## Proceso de impermeabilización

1. **Limpieza de la superficie**: Es fundamental eliminar cualquier residuo o material suelto.
2. **Reparación de grietas**: Sellado de todas las fisuras y grietas existentes.
3. **Aplicación del producto**: Según el tipo de impermeabilizante elegido.
4. **Protección final**: Capa protectora adicional si es necesario.

## Consejos de mantenimiento

- Realiza inspecciones periódicas después de las lluvias fuertes
- Limpia canaletas y desagües regularmente
- Revisa posibles puntos de filtración cada 6 meses

En IMPEERCOL contamos con asesoría técnica especializada para ayudarte a elegir el producto ideal para tu proyecto. ¡Contáctanos y protege tu inversión!',
                'image' => 'assets/img/blog/1.jpg',
                'thumbnail' => null,
                'gallery' => [],
                'tags' => ['impermeabilización', 'techos', 'bogotá', 'sika', 'mantenimiento'],
                'video_url' => null,
                'reading_time' => 8,
                'featured_quote' => 'La impermeabilización adecuada puede extender la vida útil de tu techo hasta 20 años.',
                'tips' => '• Inspecciona tu techo después de cada temporada de lluvias
• Limpia las canaletas al menos dos veces al año
• Aplica productos de calidad para garantizar durabilidad
• Consulta con profesionales antes de iniciar un proyecto grande
• Mantén un registro de las fechas de aplicación y mantenimiento',
                'difficulty' => 'intermedio',
                'estimated_time' => '2-3 días',
                'materials' => '• Impermeabilizante acrílico o asfáltico
• Imprimante compatible
• Sellador de juntas
• Malla de refuerzo (si es necesario)
• Brochas y rodillos profesionales
• Cinta de sellado',
                'tools' => '• Cepillo metálico para limpieza
• Espátulas de diferentes tamaños
• Rodillo de lana para aplicación
• Brocha para detalles
• Pistola de sellado
• Lijadora (si es necesario)',
                'author' => 'Equipo IMPEERCOL',
                'published_at' => now(),
                'is_featured' => true,
                'is_active' => true,
                'order' => 1,
                'views_count' => 0,
                'meta_title' => 'Guía de Impermeabilización para Techos en Bogotá | IMPEERCOL',
                'meta_description' => 'Guía completa sobre impermeabilización de techos en Bogotá. Productos de alta calidad y asesoría técnica especializada.',
            ],
            [
                'title' => 'Tipos de Impermeabilizantes: ¿Cuál Elegir para tu Proyecto?',
                'slug' => 'tipos-impermeabilizantes-elegir-proyecto',
                'excerpt' => 'Conoce los diferentes tipos de impermeabilizantes disponibles en el mercado y aprende a elegir el más adecuado para tu proyecto de construcción.',
                'content' => 'Elegir el impermeabilizante correcto es crucial para garantizar la protección a largo plazo de tu estructura. En IMPEERCOL te ayudamos a entender las opciones disponibles.

## Impermeabilizantes Acrílicos

Ideal para:
- Techos con pendiente
- Terrazas y balcones
- Superficies expuestas al sol

Ventajas:
- Fácil aplicación
- Resistente a los rayos UV
- Elástico y flexible

## Impermeabilizantes Asfálticos

Ideal para:
- Techos planos
- Sótanos
- Fundaciones

Ventajas:
- Alta resistencia al agua
- Durabilidad comprobada
- Costo-efectivo

## Membranas de PVC

Ideal para:
- Proyectos comerciales
- Techos grandes
- Áreas con mucho tráfico

Ventajas:
- Instalación rápida
- Muy resistente
- Larga duración

## Impermeabilizantes de Poliuretano

Ideal para:
- Terrazas transitables
- Estacionamientos
- Áreas deportivas

Ventajas:
- Resistencia excepcional
- Acabado estético
- Múltiples colores disponibles

## ¿Necesitas ayuda?

En IMPEERCOL contamos con asesores técnicos que te ayudarán a elegir el producto perfecto según las características de tu proyecto. Visítanos o contáctanos para más información.',
                'image' => 'assets/img/blog/2.jpg',
                'thumbnail' => null,
                'gallery' => [],
                'tags' => ['impermeabilizantes', 'tipos', 'acrílicos', 'asfálticos', 'membranas'],
                'video_url' => null,
                'reading_time' => 6,
                'featured_quote' => 'El secreto de una buena impermeabilización está en elegir el producto correcto para cada tipo de superficie.',
                'tips' => '• Evalúa el tipo de superficie antes de elegir el producto
• Considera el clima y las condiciones ambientales
• No escatimes en calidad, es una inversión a largo plazo
• Consulta las fichas técnicas de cada producto
• Pide muestras antes de decidir',
                'difficulty' => 'básico',
                'estimated_time' => '1-2 horas (solo evaluación)',
                'materials' => '• Catálogo de productos
• Fichas técnicas
• Muestras de productos (opcional)',
                'tools' => '• Guía de selección
• Calculadora de área
• Medidor de humedad (opcional)',
                'author' => 'Equipo IMPEERCOL',
                'published_at' => now()->subDays(5),
                'is_featured' => false,
                'is_active' => true,
                'order' => 2,
                'views_count' => 0,
                'meta_title' => 'Tipos de Impermeabilizantes: Guía Completa | IMPEERCOL',
                'meta_description' => 'Descubre los diferentes tipos de impermeabilizantes y aprende a elegir el mejor para tu proyecto de construcción.',
            ],
            [
                'title' => 'Mantenimiento Preventivo: Clave para la Durabilidad de tu Impermeabilización',
                'slug' => 'mantenimiento-preventivo-impermeabilizacion',
                'excerpt' => 'Aprende cómo el mantenimiento preventivo puede extender significativamente la vida útil de tu sistema de impermeabilización.',
                'content' => 'Una vez aplicado un sistema de impermeabilización, el mantenimiento preventivo es esencial para garantizar su efectividad a largo plazo.

## Inspecciones Regulares

Realiza inspecciones visuales cada 6 meses, especialmente después de:
- Temporadas de lluvia intensa
- Períodos de mucho sol
- Cambios estacionales extremos

## Señales de Alerta

Presta atención a:
- Grietas o fisuras en la superficie
- Desprendimiento de material
- Manchas de humedad en techos o paredes
- Burbujas o ampollas en el recubrimiento

## Limpieza y Mantenimiento

### Limpieza de Canaletas
Las canaletas obstruidas pueden causar filtraciones. Limpia:
- Hojas y residuos
- Tierra y sedimentos
- Cualquier obstáculo en el flujo de agua

### Revisión de Desagües
Asegúrate de que los desagües estén:
- Libres de obstrucciones
- Correctamente instalados
- Funcionando adecuadamente

## Reparaciones Menores

Si detectas problemas pequeños:
- Sella grietas inmediatamente
- Aplica parches en áreas dañadas
- Consulta con un profesional si el daño es extenso

## Beneficios del Mantenimiento Preventivo

- Extiende la vida útil del sistema
- Previene daños mayores y costosos
- Mantiene la garantía del producto
- Protege tu inversión a largo plazo

En IMPEERCOL ofrecemos servicios de mantenimiento y reparación. Contáctanos para programar una inspección profesional.',
                'image' => 'assets/img/blog/3.jpg',
                'thumbnail' => null,
                'gallery' => [],
                'tags' => ['mantenimiento', 'prevención', 'durabilidad', 'inspección', 'reparación'],
                'video_url' => null,
                'reading_time' => 7,
                'featured_quote' => 'Un mantenimiento preventivo adecuado puede ahorrarte hasta el 80% de los costos de reparación mayor.',
                'tips' => '• Programa inspecciones cada 6 meses
• Documenta cualquier problema encontrado
• Actúa rápidamente ante señales de deterioro
• Mantén un calendario de mantenimiento
• Guarda los recibos y garantías de los productos aplicados',
                'difficulty' => 'básico',
                'estimated_time' => '30 minutos - 2 horas (dependiendo del área)',
                'materials' => '• Sellador de juntas (si es necesario)
• Parches de reparación
• Limpiador de canaletas
• Producto de mantenimiento (si aplica)',
                'tools' => '• Escalera segura
• Guantes y protección personal
• Cepillo para limpieza
• Linterna para inspección
• Cámara para documentar (opcional)',
                'author' => 'Equipo IMPEERCOL',
                'published_at' => now()->subDays(10),
                'is_featured' => false,
                'is_active' => true,
                'order' => 3,
                'views_count' => 0,
                'meta_title' => 'Mantenimiento Preventivo de Impermeabilización | IMPEERCOL',
                'meta_description' => 'Guía sobre mantenimiento preventivo para sistemas de impermeabilización. Extiende la vida útil de tu inversión.',
            ],
            [
                'title' => 'Impermeabilización de Juntas: Técnicas Profesionales',
                'slug' => 'impermeabilizacion-juntas-tecnicas-profesionales',
                'excerpt' => 'Aprende las técnicas profesionales para sellar juntas y evitar filtraciones en tu estructura. Guía paso a paso con productos recomendados.',
                'content' => 'El sellado de juntas es uno de los aspectos más críticos en la impermeabilización. Las juntas mal selladas son la causa principal de filtraciones en techos y estructuras.

## Tipos de Juntas

### Juntas de Construcción
Son las juntas entre diferentes elementos constructivos. Requieren selladores de alta calidad y flexibilidad.

### Juntas de Dilatación
Permiten el movimiento térmico de la estructura. Necesitan selladores elásticos especiales.

### Juntas de Encuentro
Donde se encuentran diferentes materiales o superficies. Requieren atención especial.

## Productos Recomendados

### Selladores de Poliuretano
- Alta elasticidad
- Resistencia a la intemperie
- Durabilidad comprobada

### Selladores de Silicona
- Excelente adherencia
- Resistente a UV
- Ideal para exteriores

### Selladores Acrílicos
- Fácil aplicación
- Económicos
- Para juntas no críticas

## Proceso de Sellado

1. **Limpieza profunda**: Elimina todo residuo, polvo y material suelto
2. **Preparación de la junta**: Asegura que tenga el ancho y profundidad adecuados
3. **Aplicación de imprimante**: Si el fabricante lo recomienda
4. **Aplicación del sellador**: Con pistola o espátula según el caso
5. **Perfilado**: Da forma al sellador para mejor drenaje
6. **Curado**: Respeta los tiempos de secado indicados

## Errores Comunes

- No limpiar adecuadamente la superficie
- Aplicar sobre superficies húmedas
- No respetar los tiempos de curado
- Usar selladores incompatibles con el sustrato

En IMPEERCOL tenemos los mejores selladores del mercado. Visítanos y encuentra el producto perfecto para tu proyecto.',
                'image' => 'assets/img/blog/4.jpg',
                'thumbnail' => null,
                'gallery' => [],
                'tags' => ['juntas', 'selladores', 'poliuretano', 'silicona', 'técnicas'],
                'video_url' => null,
                'reading_time' => 9,
                'featured_quote' => 'El 90% de las filtraciones en techos se originan en juntas mal selladas.',
                'tips' => '• Siempre limpia la junta antes de sellar
• Usa selladores de calidad profesional
• Respeta los tiempos de curado
• Aplica en condiciones climáticas adecuadas
• Verifica la compatibilidad del sellador con el sustrato',
                'difficulty' => 'intermedio',
                'estimated_time' => '2-4 horas (dependiendo de la cantidad de juntas)',
                'materials' => '• Sellador de alta calidad (poliuretano o silicona)
• Imprimante compatible (si es necesario)
• Cinta de respaldo (backer rod)
• Limpiador de superficies
• Trapos limpios',
                'tools' => '• Pistola de sellado
• Espátulas de diferentes tamaños
• Cepillo metálico
• Cuchillo para limpieza
• Guantes y protección personal',
                'author' => 'Equipo IMPEERCOL',
                'published_at' => now()->subDays(15),
                'is_featured' => true,
                'is_active' => true,
                'order' => 4,
                'views_count' => 0,
                'meta_title' => 'Impermeabilización de Juntas: Técnicas Profesionales | IMPEERCOL',
                'meta_description' => 'Aprende técnicas profesionales para sellar juntas y evitar filtraciones. Guía completa con productos recomendados.',
            ],
        ];

        foreach ($blogs as $blogData) {
            // Verificar si el blog ya existe
            $existingBlog = Blog::where('slug', $blogData['slug'])->first();
            
            if (!$existingBlog) {
                Blog::create($blogData);
                $this->command->info("Blog creado: {$blogData['title']}");
            } else {
                // Actualizar el blog existente con los nuevos campos
                $existingBlog->update($blogData);
                $this->command->info("Blog actualizado: {$blogData['title']}");
            }
        }
    }
}
