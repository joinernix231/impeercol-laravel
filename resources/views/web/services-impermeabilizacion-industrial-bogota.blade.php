@extends('layouts.main')

@section('title', 'Impermeabilizantes para uso industrial en Bogotá | IMPEERCOL')

@section('description', 'Venta de impermeabilizantes para uso industrial en Bogotá: cubiertas metálicas, tanques, canales y estructuras expuestas. Asesoría técnica para seleccionar el sistema adecuado.')

@section('content')
    {{-- Breadcrumb --}}
    <div class="site-breadcrumb breadcrumb-bg-blog">
        <div class="container">
            <h1 class="breadcrumb-title">Impermeabilización industrial en Bogotá</h1>
            <ul class="breadcrumb-menu clearfix">
                <li><a href="{{ route('web.home') }}">Inicio</a></li>
                <li><a href="{{ route('web.services') }}">Servicios</a></li>
                <li class="active">Impermeabilización industrial en Bogotá</li>
            </ul>
        </div>
    </div>

    {{-- Intro --}}
    <section class="de-padding">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-xl-7">
                    <h2 class="hero-title mb-20">Productos para proteger la operación de tu planta y bodega frente a la humedad</h2>
                    <p class="mb-3">
                        En el sector industrial, una filtración no solo afecta la estructura: puede detener líneas de producción,
                        dañar inventarios, equipos y generar riesgos eléctricos. Por eso ofrecemos <strong>soluciones de
                        productos para impermeabilización industrial en Bogotá</strong>, orientadas a apoyar la continuidad operativa y la seguridad.
                    </p>
                    <p class="mb-3">
                        En <strong>IMPEERCOL</strong> trabajamos con sistemas especializados para <strong>cubiertas metálicas, losas
                        en concreto, tanques de agua, canales, muros de contención y fosos</strong>. Combinamos productos de marcas
                        líderes y te orientamos sobre su uso para que el equipo de mantenimiento o contratistas de tu planta puedan aplicarlos siguiendo las fichas técnicas.
                    </p>
                    <ul class="list-unstyled mb-0">
                        <li><i class="icofont-check-alt"></i> Proyectos en bodegas, plantas de producción y centros logísticos.</li>
                        <li><i class="icofont-check-alt"></i> Asesoría técnica basada en fichas y especificaciones de fabricante.</li>
                        <li><i class="icofont-check-alt"></i> Soluciones compatibles con normativas de seguridad industrial.</li>
                    </ul>
                </div>
                <div class="col-xl-5">
                    <div class="about-left">
                        <div class="about-left-content">
                            <div class="about-photo pos-rel">
                                <span class="about-dotted"></span>
                                <img src="{{ asset('assets/img/gallery/impermeabilizacion-industrial-bogota.webp') }}"
                                     alt="Impermeabilización industrial en Bogotá para bodegas y plantas"
                                     loading="lazy"
                                     decoding="async"
                                     width="500"
                                     height="500">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Áreas de aplicación --}}
    <section class="service-2-area de-padding pt-0">
        <div class="container">
            <div class="row mb-40">
                <div class="col-xl-8">
                    <h2 class="hero-title mb-20">¿Para qué aplicaciones industriales recomendamos nuestros impermeabilizantes?</h2>
                    <p class="mb-0">
                        Revisamos la operación de tu planta y priorizamos, a nivel de recomendación, las zonas que más impacto tienen en seguridad, inventarios
                        y continuidad de procesos. Algunos de los frentes más comunes donde se usan nuestros productos son:
                    </p>
                </div>
            </div>
            <div class="service-2-wpr grid-3">
                <div class="service-2-box">
                    <div class="service-2-icon"><i class="icofont-industries-5"></i></div>
                    <div class="service-2-desc">
                        <h3>Cubiertas y naves industriales</h3>
                        <p>
                            Sellado de fijaciones y cumbreras, corrección de traslapes, refuerzo de canales y bajantes, y aplicación
                            de recubrimientos elásticos de alto desempeño para cubiertas metálicas y de fibrocemento.
                        </p>
                    </div>
                </div>
                <div class="service-2-box">
                    <div class="service-2-icon"><i class="icofont-water-drop"></i></div>
                    <div class="service-2-desc">
                        <h3>Tanques, canales y fosos</h3>
                        <p>
                            Sistemas cementicios y epóxicos para <strong>tanques de agua, canales de conducción, fosos y
                            estructuras en contacto permanente con agua</strong>, cuidando compatibilidad con producto almacenado.
                        </p>
                    </div>
                </div>
                <div class="service-2-box">
                    <div class="service-2-icon"><i class="icofont-building-alt"></i></div>
                    <div class="service-2-desc">
                        <h3>Muros de contención y sótanos</h3>
                        <p>
                            Tratamiento de filtraciones por presión de agua, inyección de grietas, aplicación de recubrimientos
                            impermeables y sellado de puntos de paso de tuberías y estructuras metálicas.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Proceso y beneficios --}}
    <section class="de-padding pt-0">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-6">
                    <h2 class="hero-title mb-20">Proceso de atención y asesoría para proyectos industriales</h2>
                    <ol class="mb-0">
                        <li><strong>Levantamiento de información:</strong> nos compartes fotos, planos o descripciones de cubiertas, tanques o zonas afectadas.</li>
                        <li><strong>Recomendación técnica:</strong> descripción de sistemas, productos sugeridos y consumos por m².</li>
                        <li><strong>Cotización de suministros:</strong> listado de impermeabilizantes, cantidades y valores.</li>
                        <li><strong>Acompañamiento durante la obra:</strong> soporte sobre uso de productos y consultas técnicas.</li>
                        <li><strong>Recomendaciones de mantenimiento:</strong> pautas para que tu equipo realice inspecciones y cuidados periódicos.</li>
                    </ol>
                </div>
                <div class="col-xl-6">
                    <h3 class="heading-4 mb-15">Beneficios para tu empresa</h3>
                    <ul class="list-unstyled">
                        <li><i class="icofont-check"></i> Reducción de paradas no programadas por filtraciones o goteras.</li>
                        <li><i class="icofont-check"></i> Protección de inventarios, maquinaria y sistemas eléctricos.</li>
                        <li><i class="icofont-check"></i> Cumplimiento de estándares internos de HSE y requisitos de aseguradoras.</li>
                        <li><i class="icofont-check"></i> Mayor vida útil de la infraestructura y cubiertas industriales.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="contact-area de-padding">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-xl-8">
                    <h2 class="hero-title mb-20">Agenda una asesoría técnica para tu planta o bodega en Bogotá</h2>
                    <p class="mb-3">
                        Atendemos empresas industriales en zonas como Fontibón, Zona Franca, Puente Aranda, Toberín y otros sectores
                        de Bogotá, brindando asesoría en la selección de impermeabilizantes y cantidades a utilizar.
                    </p>
                    <p class="mb-0">
                        Nuestro equipo de <strong>IMPEERCOL</strong> te acompañará desde la definición del sistema hasta la compra de los productos,
                        proponiendo las soluciones que mejor se ajusten a tu operación y presupuesto para que tu contratista o equipo interno las ejecute.
                    </p>
                </div>
                <div class="col-xl-4">
                    <a href="{{ route('web.contact') }}" class="btn-3 w-100 text-center">
                        Solicitar visita técnica
                        <i class="icofont-long-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="faq-area de-padding pt-0">
        <div class="container">
            <div class="row mb-40">
                <div class="col-xl-8 offset-xl-2 text-center">
                    <h2 class="hero-title mb-20">Preguntas frecuentes sobre impermeabilización industrial</h2>
                    <p class="mb-0">
                        Si estás evaluando una <strong>impermeabilización industrial en Bogotá</strong>, estas respuestas pueden
                        ayudarte a planear mejor tu proyecto.
                    </p>
                </div>
            </div>
            <div class="accordion" id="faqIndustrialBogota">
                <div class="accordion-item">
                    <h3 class="accordion-header" id="faqInd1-heading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqInd1" aria-expanded="true" aria-controls="faqInd1">
                            ¿Es necesario detener la operación para aplicar los sistemas de impermeabilización?
                        </button>
                    </h3>
                    <div id="faqInd1" class="accordion-collapse collapse show" aria-labelledby="faqInd1-heading" data-bs-parent="#faqIndustrialBogota">
                        <div class="accordion-body">
                            Eso depende del plan de trabajo de tu contratista o equipo interno. Lo que sí hacemos en IMPEERCOL es
                            orientarte sobre los sistemas y productos que se adaptan mejor a tus restricciones de operación, para que
                            puedan aplicarse en horarios de baja producción o por etapas.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="faqInd2-heading">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqInd2" aria-expanded="false" aria-controls="faqInd2">
                            ¿Qué vida útil tienen los sistemas de impermeabilización industrial?
                        </button>
                    </h3>
                    <div id="faqInd2" class="accordion-collapse collapse" aria-labelledby="faqInd2-heading" data-bs-parent="#faqIndustrialBogota">
                        <div class="accordion-body">
                            Depende del sistema (acrílico, poliuretano, membranas, cementicios) y de las condiciones de exposición.
                            Sin embargo, con productos adecuados y un <strong>mantenimiento preventivo</strong> correcto, se pueden
                            lograr vidas útiles de 8 a 15 años o más. En IMPEERCOL te indicamos el plan de mantenimiento recomendado.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="faqInd3-heading">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqInd3" aria-expanded="false" aria-controls="faqInd3">
                            ¿Pueden trabajar en alturas y zonas de difícil acceso?
                        </button>
                    </h3>
                    <div id="faqInd3" class="accordion-collapse collapse" aria-labelledby="faqInd3-heading" data-bs-parent="#faqIndustrialBogota">
                        <div class="accordion-body">
                            Podemos recomendarte productos adecuados para cubiertas y zonas de difícil acceso, y sugerir buenas prácticas
                            de seguridad que tu proveedor de servicios o equipo interno debe seguir. La ejecución y cumplimiento de los
                            protocolos de alturas corre a cargo de tu contratista o personal especializado.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="faqInd4-heading">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqInd4" aria-expanded="false" aria-controls="faqInd4">
                            ¿Atienden plantas fuera de Bogotá?
                        </button>
                    </h3>
                    <div id="faqInd4" class="accordion-collapse collapse" aria-labelledby="faqInd4-heading" data-bs-parent="#faqIndustrialBogota">
                        <div class="accordion-body">
                            Nuestro foco principal es Bogotá y municipios cercanos, pero podemos evaluar proyectos industriales en
                            otras ciudades si el alcance lo justifica. Compártenos la ubicación, área aproximada y tipo de industria
                            para valorar la mejor alternativa.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('web.components.contact-info-strip')
@endsection


