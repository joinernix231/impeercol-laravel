@extends('layouts.main')

@section('title', 'Impermeabilizantes para terrazas en Bogotá | IMPEERCOL')

@section('description', 'Venta de impermeabilizantes para terrazas en Bogotá. Asesoría técnica para elegir sistemas transitables o no transitables y calcular el consumo de materiales en tu proyecto.')

@section('content')
    {{-- Breadcrumb --}}
    <div class="site-breadcrumb breadcrumb-bg-blog">
        <div class="container">
            <h1 class="breadcrumb-title">Impermeabilización de terrazas en Bogotá</h1>
            <ul class="breadcrumb-menu clearfix">
                <li><a href="{{ route('web.home') }}">Inicio</a></li>
                <li><a href="{{ route('web.services') }}">Servicios</a></li>
                <li class="active">Impermeabilización de terrazas en Bogotá</li>
            </ul>
        </div>
    </div>

    {{-- Intro --}}
    <section class="de-padding">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-xl-7">
                    <h2 class="hero-title mb-20">Convierte tu terraza en un espacio más seguro y libre de filtraciones</h2>
                    <p class="mb-3">
                        Las terrazas en Bogotá están expuestas a lluvias constantes, rayos UV y cambios bruscos de temperatura.
                        Sin una <strong>impermeabilización adecuada</strong>, aparecen filtraciones en los pisos inferiores,
                        desprendimiento de recubrimientos y humedad en muros y cielos rasos.
                    </p>
                    <p class="mb-3">
                        En <strong>IMPEERCOL</strong> te ayudamos a elegir sistemas específicos de <strong>impermeabilización de terrazas</strong>
                        según si serán transitables, tienen cerámica, concreto a la vista o acabados decorativos. Combinamos productos
                        acrílicos, cementicios, poliuretánicos o mantos asfálticos según el uso del espacio y el presupuesto disponible,
                        para que tu contratista o maestro de obra pueda ejecutarlos correctamente.
                    </p>
                    <ul class="list-unstyled mb-0">
                        <li><i class="icofont-check-alt"></i> Soluciones para terrazas residenciales, de edificios y zonas comunes.</li>
                        <li><i class="icofont-check-alt"></i> Tratamiento de puntos críticos: sumideros, encuentros con muros y juntas.</li>
                        <li><i class="icofont-check-alt"></i> Sistemas transitables y no transitables según tu proyecto.</li>
                    </ul>
                </div>
                <div class="col-xl-5">
                    <div class="about-left">
                        <div class="about-left-content">
                            <div class="about-photo pos-rel">
                                <span class="about-dotted"></span>
                                <img src="{{ asset('assets/img/gallery/impermeabilizacion-terrazas-bogota.webp') }}"
                                     alt="Servicio de impermeabilización de terrazas en Bogotá"
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

    {{-- Sistemas para terrazas --}}
    <section class="service-2-area de-padding pt-0">
        <div class="container">
            <div class="row mb-40">
                <div class="col-xl-8">
                    <h2 class="hero-title mb-20">Sistemas y productos para impermeabilización de terrazas en Bogotá</h2>
                    <p class="mb-0">
                        Antes de recomendar un sistema, evaluamos contigo cómo usas la terraza: si es zona social, área técnica, cubierta verde o solo
                        acceso de mantenimiento. A partir de esto definimos qué tipo de productos necesitas y sus rendimientos aproximados.
                    </p>
                </div>
            </div>
            <div class="service-2-wpr grid-3">
                <div class="service-2-box">
                    <div class="service-2-icon"><i class="icofont-ui-home"></i></div>
                    <div class="service-2-desc">
                        <h3>Terrazas transitables</h3>
                        <p>
                            Sistemas multicapa que combinan impermeabilización, morteros de pendiente y acabados
                            como cerámica o acabados decorativos. Ideales para zonas sociales y terrazas de apartamentos.
                        </p>
                    </div>
                </div>
                <div class="service-2-box">
                    <div class="service-2-icon"><i class="icofont-layers"></i></div>
                    <div class="service-2-desc">
                        <h3>Terrazas con cerámica existente</h3>
                        <p>
                            Soluciones que permiten <strong>impermeabilizar sobre enchape existente</strong>, sellar juntas,
                            corregir piezas sueltas y reforzar zonas de acumulación de agua, reduciendo demoliciones.
                        </p>
                    </div>
                </div>
                <div class="service-2-box">
                    <div class="service-2-icon"><i class="icofont-water-drop"></i></div>
                    <div class="service-2-desc">
                        <h3>Terrazas técnicas y cubiertas verdes</h3>
                        <p>
                            Sistemas de alta resistencia para soportar equipos de aire acondicionado, tanques, paneles solares
                            o jardines sobre cubierta, manteniendo el control de filtraciones hacia los pisos inferiores.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Beneficios específicos --}}
    <section class="de-padding pt-0">
        <div class="container">
            <div class="row g-4">
                <div class="col-xl-6">
                    <h2 class="hero-title mb-20">Beneficios de comprar tus impermeabilizantes para terraza en IMPEERCOL</h2>
                    <ul class="list-unstyled">
                        <li><i class="icofont-check"></i> Eliminación de filtraciones hacia apartamentos y locales inferiores.</li>
                        <li><i class="icofont-check"></i> Mayor confort en zonas sociales, libres de humedad y malos olores.</li>
                        <li><i class="icofont-check"></i> Protección de la estructura frente a carbonatación y deterioro del concreto.</li>
                        <li><i class="icofont-check"></i> Incremento del valor de tu inmueble gracias a una terraza funcional y segura.</li>
                    </ul>
                </div>
                <div class="col-xl-6">
                    <h3 class="heading-4 mb-15">Asesoría pensada para Bogotá</h3>
                    <p class="mb-3">
                        Diseñamos las soluciones según las <strong>condiciones climáticas de Bogotá</strong> y la normativa local
                        aplicable. Tomamos en cuenta pendientes mínimas, puntos de desagüe y juntas de dilatación para evitar
                        acumulación de agua que pueda generar goteras.
                    </p>
                    <p class="mb-0">
                        Si estás en zonas como Chapinero, Teusaquillo, Usaquén, Suba o el Centro de Bogotá, podemos orientarte sobre
                        qué sistema y productos son más convenientes para tu terraza y acompañarte con soporte técnico durante la compra.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section class="contact-area de-padding">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-xl-8">
                    <h2 class="hero-title mb-20">Solicita una cotización de impermeabilizantes para tu terraza en Bogotá</h2>
                    <p class="mb-3">
                        Dinos el área aproximada, el tipo de acabado actual (cerámica, concreto, pintura, etc.) y si la terraza
                        es transitable. Con esa información podemos darte un rango de consumo de materiales, sugerirte sistemas
                        y ayudarte a armar una lista de productos para tu obra.
                    </p>
                    <p class="mb-0">
                        También podemos suministrar únicamente los materiales si cuentas con tu propio equipo de aplicación,
                        ya sea un maestro de obra, contratista o empresa de impermeabilización.
                    </p>
                </div>
                <div class="col-xl-4">
                    <a href="{{ route('web.contact') }}" class="btn-3 w-100 text-center">
                        Quiero impermeabilizar mi terraza
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
                    <h2 class="hero-title mb-20">Preguntas frecuentes sobre impermeabilización de terrazas</h2>
                    <p class="mb-0">
                        Estas son algunas dudas que recibimos a diario de administradores de propiedad horizontal y propietarios
                        que quieren impermeabilizar sus terrazas en Bogotá.
                    </p>
                </div>
            </div>
            <div class="accordion" id="faqTerrazasBogota">
                <div class="accordion-item">
                    <h3 class="accordion-header" id="faqTerraza1-heading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqTerraza1" aria-expanded="true" aria-controls="faqTerraza1">
                            ¿Debo demoler la cerámica existente para impermeabilizar mi terraza?
                        </button>
                    </h3>
                    <div id="faqTerraza1" class="accordion-collapse collapse show" aria-labelledby="faqTerraza1-heading" data-bs-parent="#faqTerrazasBogota">
                        <div class="accordion-body">
                            No siempre es necesario. En muchos casos podemos <strong>impermeabilizar sobre el acabado existente</strong>,
                            corrigiendo piezas sueltas, sellando juntas y aplicando sistemas compatibles. Todo depende del estado
                            actual de la superficie, por eso es importante una visita técnica previa.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="faqTerraza2-heading">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqTerraza2" aria-expanded="false" aria-controls="faqTerraza2">
                            ¿Cuánto se demora un trabajo de impermeabilización de terraza?
                        </button>
                    </h3>
                    <div id="faqTerraza2" class="accordion-collapse collapse" aria-labelledby="faqTerraza2-heading" data-bs-parent="#faqTerrazasBogota">
                        <div class="accordion-body">
                            Un proyecto típico de <strong>impermeabilización de terraza en Bogotá</strong> puede tardar entre 2 y 5 días,
                            dependiendo del área, el sistema elegido y las condiciones climáticas. En la visita técnica te entregamos
                            un cronograma estimado de actividades.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="faqTerraza3-heading">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqTerraza3" aria-expanded="false" aria-controls="faqTerraza3">
                            ¿Puedo seguir usando la terraza después de impermeabilizar?
                        </button>
                    </h3>
                    <div id="faqTerraza3" class="accordion-collapse collapse" aria-labelledby="faqTerraza3-heading" data-bs-parent="#faqTerrazasBogota">
                        <div class="accordion-body">
                            Sí, pero el uso dependerá del sistema instalado. Hay soluciones <strong>no transitables</strong> solo
                            para mantenimiento ocasional, y sistemas <strong>transitables</strong> diseñados para zonas sociales.
                            Nuestro equipo te indicará tiempos de curado y recomendaciones para volver a usar la terraza con seguridad.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="faqTerraza4-heading">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqTerraza4" aria-expanded="false" aria-controls="faqTerraza4">
                            ¿Pueden ayudarme solo con los materiales para impermeabilizar?
                        </button>
                    </h3>
                    <div id="faqTerraza4" class="accordion-collapse collapse" aria-labelledby="faqTerraza4-heading" data-bs-parent="#faqTerrazasBogota">
                        <div class="accordion-body">
                            Claro. En IMPEERCOL también somos <strong>distribuidores de impermeabilizantes</strong>. Podemos recomendarte
                            el sistema ideal, calcular cantidades y suministrarte todos los materiales si cuentas con un contratista
                            o maestro de obra de confianza.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('web.components.contact-info-strip')
@endsection


