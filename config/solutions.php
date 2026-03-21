<?php

/**
 * Contenido y SEO para /soluciones/{tipo} (techos, terrazas, muros).
 * Las páginas legacy /impermeabilizacion-*-bogota pueden fusionar datos vía PageController.
 */
return [
    'types' => [
        'techos' => [
            'meta_title' => 'Productos para impermeabilización de techos | IMPEERCOL',
            'meta_description' => 'Encuentra productos y sistemas para impermeabilizar techos: acrílicos, mantos y membranas de marcas como Sika y Texsa. Asesoría para elegir según tu tipo de cubierta y filtración.',
            'h1' => 'Productos para impermeabilización de techos',
            'breadcrumb_label' => 'Impermeabilización de techos',
            'hero_subtitle' => 'Elige el sistema adecuado según tu cubierta y el problema que quieres resolver',
            'image' => 'impermeabilizacion-techos-bogota.webp',
            'image_alt' => 'Productos y sistemas para impermeabilización de techos',
            'whatsapp_message' => 'Hola, quiero asesoría para elegir productos de impermeabilización para techos.',
            'product_terms' => ['techo', 'cubierta', 'manto', 'acrílic', 'acrílico', 'acril', 'membrana', 'asfált', 'asfalt', 'impermeab'],
            'benefits' => [
                'Catálogo con marcas líderes (Sika, Texsa, Metic y otras) con fichas técnicas.',
                'Te orientamos en consumo por m² y compatibilidad con tu tipo de techo.',
                'Materiales pensados para lluvia, sol y movimiento de la losa.',
                'Acompañamiento para que la aplicación respete lo que indica el fabricante.',
            ],
            'problem_matrix' => [
                [
                    'title' => 'Goteras o manchas en el cielo raso',
                    'body' => 'Suele haber fisuras o puntos de penetración en la cubierta. Suelen recomendarse sistemas que sellen y creen una lámina continua (membranas líquidas o acrílicos reforzados), según pendiente y sustrato.',
                    'hint' => 'Membranas líquidas, acrílicos elastoméricos, refuerzos.',
                ],
                [
                    'title' => 'Techo plano con charcos y envejecimiento',
                    'body' => 'En losas poco pendientes conviene evaluar drenaje y un sistema de mayor masa impermeable, como mantos asfálticos o soluciones compatibles con tránsito ligero si aplica.',
                    'hint' => 'Mantos asfálticos, sistemas multi-capa, detalles en sumideros.',
                ],
                [
                    'title' => 'Teja, zinc o fibrocemento con corrosión o grietas',
                    'body' => 'El enfoque combina sellado de fijaciones, cumbreras y recubrimientos elásticos que sigan el movimiento del material sin despegarse.',
                    'hint' => 'Selladores, bandas, recubrimientos acrílicos o poliuretánicos según caso.',
                ],
            ],
            'solution_cards' => [
                [
                    'icon' => 'icofont-paint',
                    'title' => 'Sistemas acrílicos y recubrimientos elastoméricos',
                    'body' => 'Buena opción en muchas losas y cubiertas expuestas al sol cuando se busca una capa continua y flexible. Se complementan con mallas de refuerzo según el sistema.',
                ],
                [
                    'icon' => 'icofont-building-alt',
                    'title' => 'Mantos y membranas asfálticas',
                    'body' => 'Alta durabilidad en techos planos o de baja pendiente cuando el proyecto lo permite. Exigen detalle en solapes y encuentros con muros.',
                ],
                [
                    'icon' => 'icofont-industries-5',
                    'title' => 'Detalle en cubiertas metálicas y tejas',
                    'body' => 'Trabajo sobre uniones, tornillería y puntos críticos, eligiendo productos compatibles con el sustrato para evitar filtraciones localizadas.',
                ],
            ],
            'process' => [
                'title' => 'Cómo te ayudamos a elegir productos para tu techo',
                'intro' => 'Partimos del problema visible y del tipo de cubierta. Con esa información sugerimos referencias concretas y cantidades orientativas para que tu instalador ejecute según ficha técnica.',
            ],
            'faqs' => [
                [
                    'q' => '¿Venden solo el material o también instalan?',
                    'a' => 'En IMPEERCOL nos enfocamos en el suministro de productos y en la asesoría técnica para elegirlos y calcularlos. La aplicación la realiza tu cuadrilla o contratista de confianza siguiendo las recomendaciones del fabricante.',
                ],
                [
                    'q' => '¿Cómo sé cuánto producto compro?',
                    'a' => 'Con el área aproximada, el tipo de sistema y el rendimiento indicado en la ficha técnica estimamos el consumo por m². Si nos envías fotos o planos, afinamos mejor la cantidad.',
                ],
                [
                    'q' => '¿Trabajan con marcas como Sika o Texsa?',
                    'a' => 'Sí. Distribuimos referencias de fabricantes reconocidos; el catálogo exacto depende de disponibilidad. Te mostramos alternativas equivalentes cuando haga falta.',
                ],
                [
                    'q' => '¿Hacen envíos fuera de Bogotá?',
                    'a' => 'Atendemos con envíos a nivel nacional según volumen y transportadora. Coordina con nosotros destino y tiempos.',
                ],
            ],
        ],
        'terrazas' => [
            'meta_title' => 'Productos para impermeabilización de terrazas | IMPEERCOL',
            'meta_description' => 'Productos para impermeabilizar terrazas transitables o no transitables: cementicios, poliuretano, acrílicos y mantos. Asesoría según acabado, pendientes y puntos críticos.',
            'h1' => 'Productos para impermeabilización de terrazas',
            'breadcrumb_label' => 'Impermeabilización de terrazas',
            'hero_subtitle' => 'Protege la losa antes de instalar cerámica, deck o zonas húmedas',
            'image' => 'impermeabilizacion-terrazas-bogota.webp',
            'image_alt' => 'Productos para impermeabilización de terrazas y zonas expuestas',
            'whatsapp_message' => 'Hola, quiero asesoría para productos de impermeabilización en terrazas.',
            'product_terms' => ['terraza', 'transitable', 'loseta', 'poliuret', 'cement', 'manto', 'impermeab', 'deck'],
            'benefits' => [
                'Sistemas para terrazas con y sin tránsito peatonal.',
                'Enfoque en sumideros, parapetos y juntas, donde suele fallar la impermeabilización.',
                'Compatibilidad con cerámicas, morteros y acabados según especificación.',
                'Marcas con trayectoria en obra civil y residencial.',
            ],
            'problem_matrix' => [
                [
                    'title' => 'Filtraciones hacia el piso inferior',
                    'body' => 'Revisa sumideros y encuentros con muros. Suele requerirse un sistema continuo bajo el acabado y buenos detalles en juntas de movimiento.',
                    'hint' => 'Impermeabilizantes cementicios flexibles, poliuretánicos o mantos según diseño.',
                ],
                [
                    'title' => 'Terraza transitable con cerámica levantada',
                    'body' => 'Necesitas un sistema que resista carga, punzonamiento y ciclos húmedo-seco sin perder adherencia al soporte.',
                    'hint' => 'Capas multi-componente, geotextiles o sistemas certificados para transitabilidad.',
                ],
                [
                    'title' => 'Humedad sin filtración clara',
                    'body' => 'Puede ser capilaridad o vapor. La solución combina barrera impermeable adecuada y, a veces, mejoras en drenaje o ventilación del espacio.',
                    'hint' => 'Diagnóstico con fotos; productos de barrera y sellado perimetral.',
                ],
            ],
            'solution_cards' => [
                [
                    'icon' => 'icofont-paint',
                    'title' => 'Sistemas cementicios y flexibles',
                    'body' => 'Muy usados bajo cerámica en terrazas y balcones cuando se busca una capa impermeable adherida al concreto.',
                ],
                [
                    'icon' => 'icofont-ui-settings',
                    'title' => 'Poliuretánicos y soluciones de alta elasticidad',
                    'body' => 'Útiles cuando hay movimiento estructural moderado o geometrías complejas, siempre según compatibilidad con el resto del sistema.',
                ],
                [
                    'icon' => 'icofont-building-alt',
                    'title' => 'Mantos asfálticos y protección mecánica',
                    'body' => 'Para ciertos diseños de losa y pendientes, con capas de protección antes del acabado final.',
                ],
            ],
            'process' => [
                'title' => 'Selección de productos para tu terraza',
                'intro' => 'Nos cuentas si habrá tránsito, qué acabado llevará y si ya hay humedad. Con eso proponemos referencias y cantidades para cotizar con claridad.',
            ],
            'faqs' => [
                [
                    'q' => '¿Puedo impermeabilizar encima de la cerámica antigua?',
                    'a' => 'Depende del estado de la losa y del sistema. A veces conviene retirar acabados; otras, sistemas específicos sobre existente. Envíanos contexto y fotos para orientarte.',
                ],
                [
                    'q' => '¿Qué diferencia hay entre terraza transitable y no transitable?',
                    'a' => 'La transitable exige resistencia mecánica y protección frente a uso peatonal; la no transitable suele ir bajo protección o en zonas sin pisar. El producto y el espesor cambian.',
                ],
                [
                    'q' => '¿Dan garantía los productos?',
                    'a' => 'Las garantías de desempeño las define cada fabricante según sistema aplicado y condiciones. Nosotros te entregamos la información técnica para cumplir sus requisitos.',
                ],
                [
                    'q' => '¿Cómo pido asesoría?',
                    'a' => 'Escríbenos por WhatsApp o usa el formulario de contacto con medidas aproximadas y fotos de sumideros y encuentros con muro.',
                ],
            ],
        ],
        'muros' => [
            'meta_title' => 'Productos para impermeabilización de muros y fachadas | IMPEERCOL',
            'meta_description' => 'Productos para muros húmedos, fachadas y paramentos: barreras, selladores y recubrimientos. Asesoría según filtración, capilaridad y tipo de revoque.',
            'h1' => 'Productos para impermeabilización de muros',
            'breadcrumb_label' => 'Impermeabilización de muros',
            'hero_subtitle' => 'Atacar la humedad desde la causa: sellado, barrera y compatibilidad con pintura o revoque',
            'image' => 'impermeabilizacion-industrial-bogota.webp',
            'image_alt' => 'Tratamiento de humedades e impermeabilización en muros y fachadas',
            'whatsapp_message' => 'Hola, quiero asesoría para productos de impermeabilización en muros o fachadas.',
            'product_terms' => ['muro', 'fachada', 'humedad', 'sellar', 'revoque', 'paramento', 'impermeab', 'capilar'],
            'benefits' => [
                'Productos para filtraciones, salitre y humedad por capilaridad (según diagnóstico).',
                'Selladores y barreras compatibles con acabados de fachada.',
                'Asesoría para no mezclar sistemas incompatibles.',
                'Enfoque en durabilidad y mantenimiento posterior.',
            ],
            'problem_matrix' => [
                [
                    'title' => 'Manchas y pintura burbujeando',
                    'body' => 'Suele indicar humedad migrando desde el exterior o tuberías empotradas. Hay que identificar origen y elegir barrera o sellado que respire o bloquee según el caso.',
                    'hint' => 'Selladores, impermeabilizantes de frente, sistemas cementicios de contacto.',
                ],
                [
                    'title' => 'Salitre y polvo en revoque',
                    'body' => 'Las sales migran con el agua. Además de impermeabilizar, a veces se requiere tratamiento del soporte antes de revestir.',
                    'hint' => 'Productos antisalitre, barreras y revocos de reparación compatibles.',
                ],
                [
                    'title' => 'Juntas entre elementos o fisuras en fachada',
                    'body' => 'El detalle constructivo se sella con masas elásticas o bandas según movimiento esperado, evitando rigidez excesiva.',
                    'hint' => 'Selladores elásticos, bandas, reparación estructural ligera si aplica.',
                ],
            ],
            'solution_cards' => [
                [
                    'icon' => 'icofont-building-alt',
                    'title' => 'Barreras y recubrimientos de frente',
                    'body' => 'Para cortar filtraciones o lluvia de viento en paramentos expuestos, eligiendo producto según porosidad del soporte.',
                ],
                [
                    'icon' => 'icofont-tools-alt-2',
                    'title' => 'Tratamiento de juntas y grietas',
                    'body' => 'Materiales elásticos que absorben movimiento sin romper la continuidad impermeable.',
                ],
                [
                    'icon' => 'icofont-repair',
                    'title' => 'Sistemas cementicios y reparación',
                    'body' => 'Morteros impermeables y de regularización cuando el muro requiere recuperar planimetría antes del acabado final.',
                ],
            ],
            'process' => [
                'title' => 'Cómo elegimos productos para muros',
                'intro' => 'Diferenciamos humedad por filtración, capilaridad o condensación. Con fotos y zona afectada sugerimos referencias y orden de intervención.',
            ],
            'faqs' => [
                [
                    'q' => '¿Con producto basta o hay que romper el revoque?',
                    'a' => 'Si el soporte está degradado o hay sales acumuladas, a menudo conviene llegar hasta material sano antes de impermeabilizar. Te indicamos cuándo es imprescindible.',
                ],
                [
                    'q' => '¿Sirve cualquier pintura impermeable?',
                    'a' => 'No todas las pinturas son barrera frente a presión de agua o sales. Elegimos según el origen de la humedad y la ficha del fabricante.',
                ],
                [
                    'q' => '¿Atienden obra nueva y reparación?',
                    'a' => 'Sí. En obra nueva priorizamos prevención; en reparación, diagnóstico y compatibilidad con lo existente.',
                ],
                [
                    'q' => '¿Puedo cotizar varias referencias?',
                    'a' => 'Sí. Te armamos opciones por rango de sistema para que compares con tu maestro de obra.',
                ],
            ],
        ],
    ],
];
