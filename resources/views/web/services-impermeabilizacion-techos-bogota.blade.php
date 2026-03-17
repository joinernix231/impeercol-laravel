@extends('layouts.main')

@section('title', 'Impermeabilizantes para techos en Bogotá | IMPEERCOL')

@section('description', 'Venta de impermeabilizantes para techos en Bogotá. Asesoría técnica para elegir sistemas acrílicos, mantos y membranas que ayuden a detener filtraciones y proteger tu cubierta.')

@section('content')
    {{-- Breadcrumb --}}
    <div class="site-breadcrumb breadcrumb-bg-blog">
        <div class="container">
            <h1 class="breadcrumb-title">Impermeabilización de techos en Bogotá</h1>
            <ul class="breadcrumb-menu clearfix">
                <li><a href="{{ route('web.home') }}">Inicio</a></li>
                <li><a href="{{ route('web.services') }}">Servicios</a></li>
                <li class="active">Impermeabilización de techos en Bogotá</li>
            </ul>
        </div>
    </div>

    {{-- Intro + beneficios --}}
    <section class="de-padding">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-xl-7">
                    <h2 class="hero-title mb-20">Productos para proteger tus techos de la lluvia y la humedad en Bogotá</h2>
                    <p class="mb-3">
                        En <strong>IMPEERCOL</strong> somos especialistas en <strong>productos para impermeabilización de techos en Bogotá</strong>.
                        Conocemos el clima de la ciudad, las lluvias constantes y cómo afectan cubiertas en concreto, tejas de barro,
                        tejas de fibrocemento y cubiertas metálicas. Diseñamos sistemas de impermeabilización que detienen filtraciones,
                        evitan humedades internas y alargan la vida útil de tu inmueble.
                    </p>
                    <p class="mb-3">
                        Trabajamos con <strong>marcas reconocidas como Sika, Texsa y Metic</strong>, seleccionando productos de alto
                        desempeño según el tipo de techo y el uso del espacio. Nuestro objetivo es ayudarte a elegir el sistema adecuado
                        para que, con una correcta aplicación, tengas un techo más protegido y listo para soportar la temporada de lluvias en Bogotá.
                    </p>
                    <ul class="list-unstyled mb-3">
                        <li><i class="icofont-check-alt"></i> Sistemas acrílicos, mantos asfálticos y membranas líquidas.</li>
                        <li><i class="icofont-check-alt"></i> Recomendaciones para techos residenciales, comerciales e industriales.</li>
                        <li><i class="icofont-check-alt"></i> Asesoría técnica sobre selección de productos y consumo por m².</li>
                        <li><i class="icofont-check-alt"></i> Productos con respaldo de fábrica y garantías del fabricante.</li>
                    </ul>
                </div>
                <div class="col-xl-5">
                    <div class="about-left">
                        <div class="about-left-content">
                            <div class="about-photo pos-rel">
                                <span class="about-dotted"></span>
                                <img src="{{ asset('assets/img/gallery/impermeabilizacion-techos-bogota.webp') }}"
                                     alt="Servicio de impermeabilización de techos en Bogotá"
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

    {{-- Tipos de soluciones H2 --}}
    <section class="service-2-area de-padding pt-0">
        <div class="container">
            <div class="row mb-40">
                <div class="col-xl-8">
                    <h2 class="hero-title mb-20">Tipos de impermeabilizantes para techos en Bogotá</h2>
                    <p class="mb-0">
                        No todos los techos se impermeabilizan igual. Analizamos el tipo de superficie, la pendiente, el estado actual
                        y el uso del espacio para recomendar el <strong>sistema de impermeabilización de techos</strong> más adecuado
                        y los productos más convenientes para tu proyecto en Bogotá.
                    </p>
                </div>
            </div>
            <div class="service-2-wpr grid-3">
                <div class="service-2-box">
                    <div class="service-2-icon"><i class="icofont-paint"></i></div>
                    <div class="service-2-desc">
                        <h3>Impermeabilizantes acrílicos para techos</h3>
                        <p>
                            Revestimientos acrílicos reforzados con malla, ideales para techos de placa en concreto y cubiertas
                            con ligeras pendientes. Ofrecen buena reflectancia solar y ayudan a reducir la temperatura interior.
                        </p>
                    </div>
                </div>
                <div class="service-2-box">
                    <div class="service-2-icon"><i class="icofont-building-alt"></i></div>
                    <div class="service-2-desc">
                        <h3>Mantos y membranas asfálticas</h3>
                        <p>
                            Sistemas de <strong>manto asfáltico</strong> para techos planos, terrazas y cubiertas de gran área.
                            Son una solución robusta para proyectos residenciales y comerciales que requieren alta durabilidad.
                        </p>
                    </div>
                </div>
                <div class="service-2-box">
                    <div class="service-2-icon"><i class="icofont-industries-5"></i></div>
                    <div class="service-2-desc">
                        <h3>Impermeabilización en teja y cubiertas metálicas</h3>
                        <p>
                            Sellado de uniones, fijaciones y cumbreras, aplicación de recubrimientos elásticos y corrección de
                            puntos críticos donde se originan filtraciones en naves industriales y cubiertas livianas en Bogotá.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Proceso de asesoría H2 --}}
    <section class="step-area de-pt hero-bg step-area-bg step-area--techo-proceso">
        <div class="container">
            <div class="step-wpr grid-2">
                <div class="step-left d-flex align-items-center">
                    <div class="step-left-content">
                        <h2 class="hero-title mb-20">Cómo te asesoramos en la impermeabilización de techos</h2>
                        <p class="mb-30">
                            Un proyecto de <strong>impermeabilización profesional</strong> empieza con un buen diagnóstico.
                            Nuestro equipo te orienta sobre el tipo de sistema y los productos apropiados para que tu instalador
                            o contratista de confianza pueda ejecutar el trabajo de forma correcta.
                        </p>
                        <div class="button-container-2">
                            <span class="mas">Solicitar asesoría</span>
                            <a href="{{ route('web.contact') }}" class="site-btn-2">Quiero asesoría y cotización de productos</a>
                        </div>
                    </div>
                </div>
                <div class="step-right">
                    <div class="step-box-wpr grid-2">
                        <div class="step-box">
                            <span class="step-number">01</span>
                            <h3 class="heading-6">Entendemos tu proyecto</h3>
                            <p>Nos cuentas el tipo de techo, área aproximada, ubicación en Bogotá y problemas de filtraciones que has detectado.</p>
                        </div>
                        <div class="step-box">
                            <span class="step-number">02</span>
                            <h3 class="heading-6">Recomendación de sistema</h3>
                            <p>Te sugerimos el sistema de impermeabilización, consumo por m² y productos específicos de nuestro portafolio.</p>
                        </div>
                        <div class="step-box">
                            <span class="step-number">03</span>
                            <h3 class="heading-6">Guía para la aplicación</h3>
                            <p>Te explicamos las recomendaciones generales de aplicación para que tu maestro o contratista las siga según las fichas técnicas.</p>
                        </div>
                        <div class="step-box">
                            <span class="step-number">04</span>
                            <h3 class="heading-6">Seguimiento y soporte</h3>
                            <p>Te acompañamos con soporte sobre productos, rendimientos y dudas técnicas durante el proceso de obra.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA principal --}}
    <section class="contact-area de-padding">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-xl-7">
                    <h2 class="hero-title mb-20">¿Necesitas productos para impermeabilizar el techo de tu casa, edificio o empresa en Bogotá?</h2>
                    <p class="mb-3">
                        Cuéntanos el tipo de techo, el área aproximada y en qué zona de Bogotá se encuentra. Nuestro equipo de
                        <strong>IMPEERCOL</strong> te orientará sobre el sistema adecuado, las referencias de producto y cantidades de material que necesitas.
                    </p>
                    <ul class="list-unstyled mb-0">
                        <li><i class="icofont-check"></i> Atención a conjuntos residenciales, bodegas, locales y viviendas unifamiliares.</li>
                        <li><i class="icofont-check"></i> Asesoría técnica en selección de productos y cálculo de consumo.</li>
                        <li><i class="icofont-check"></i> Suministro de materiales para que tu equipo de obra los aplique.</li>
                    </ul>
                </div>
                <div class="col-xl-5">
                    <div class="contact-right contact-bg-animated">
                        <h3 class="mb-3">Solicita tu cotización de impermeabilizantes para techos</h3>
                        <p class="mb-3">Déjanos tus datos y un asesor de IMPEERCOL te contactará para recomendarte productos y cantidades.</p>
                        <a href="{{ route('web.contact') }}" class="btn-3 w-100 text-center">
                            Ir al formulario de contacto
                            <i class="icofont-long-arrow-right"></i>
                        </a>
                        <p class="mt-3 mb-0">
                            También puedes escribirnos por WhatsApp o llamarnos directamente a los números publicados en la sección
                            de contacto. Atendemos principalmente en Bogotá y hacemos envíos de producto a nivel nacional según disponibilidad.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="faq-area de-padding pt-0">
        <div class="container">
            <div class="row mb-40">
                <div class="col-xl-8 offset-xl-2 text-center">
                    <h2 class="hero-title mb-20">Preguntas frecuentes sobre impermeabilización de techos en Bogotá</h2>
                    <p class="mb-0">
                        Respondemos las dudas más comunes de propietarios, administradores de edificios y empresas que buscan
                        <strong>impermeabilización profesional en Bogotá</strong>.
                    </p>
                </div>
            </div>
            <div class="accordion" id="faqTechosBogota">
                <div class="accordion-item">
                    <h3 class="accordion-header" id="faq1-heading">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="true" aria-controls="faq1">
                            ¿Cada cuánto se debe impermeabilizar un techo en Bogotá?
                        </button>
                    </h3>
                    <div id="faq1" class="accordion-collapse collapse show" aria-labelledby="faq1-heading" data-bs-parent="#faqTechosBogota">
                        <div class="accordion-body">
                            Depende del sistema utilizado y de la exposición del techo, pero en promedio se recomienda
                            <strong>revisar e intervenir cada 5 a 8 años</strong>. En techos muy expuestos al sol y lluvia, es clave
                            hacer inspecciones visuales anuales para detectar fisuras, desprendimientos o charcos que indiquen falla
                            en la impermeabilización.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="faq2-heading">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">
                            ¿Cuánto cuesta impermeabilizar un techo en Bogotá?
                        </button>
                    </h3>
                    <div id="faq2" class="accordion-collapse collapse" aria-labelledby="faq2-heading" data-bs-parent="#faqTechosBogota">
                        <div class="accordion-body">
                            El costo por metro cuadrado varía según el sistema (acrílico, manto, membrana líquida), el estado actual
                            del techo y la altura o accesibilidad del área. Para tener una referencia detallada puedes leer nuestro
                            artículo <a href="{{ route('web.blog.show', 'cuanto-cuesta-impermeabilizar-una-terraza-en-bogota') }}">¿Cuánto cuesta impermeabilizar una terraza en Bogotá?</a>
                            o solicitar una cotización personalizada con nuestro equipo.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="faq3-heading">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">
                            ¿Trabajan solo en Bogotá o también en municipios cercanos?
                        </button>
                    </h3>
                    <div id="faq3" class="accordion-collapse collapse" aria-labelledby="faq3-heading" data-bs-parent="#faqTechosBogota">
                        <div class="accordion-body">
                            Nuestra operación principal está en <strong>Bogotá</strong>, pero podemos atender proyectos en municipios
                            cercanos como Soacha, Chía, Cota, Funza o Mosquera, previa coordinación logística. Cuéntanos la ubicación
                            exacta y el tipo de proyecto para evaluar la mejor forma de ayudarte.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="faq4-heading">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">
                            ¿Ofrecen garantía sobre la impermeabilización de techos?
                        </button>
                    </h3>
                    <div id="faq4" class="accordion-collapse collapse" aria-labelledby="faq4-heading" data-bs-parent="#faqTechosBogota">
                        <div class="accordion-body">
                            Sí. Los trabajos de <strong>impermeabilización profesional</strong> se entregan con garantía por escrito,
                            cuyo tiempo depende del sistema y las condiciones del proyecto. Además, seguimos las recomendaciones de los
                            fabricantes para asegurar durabilidad y respaldo técnico.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Información de contacto local / Schema ya se incluye en home --}}
    @include('web.components.contact-info-strip')
@endsection


