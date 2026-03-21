@extends('layouts.main')

@section('title', $page['meta_title'])

@section('description', $page['meta_description'])

@section('styles')
<link href="{{ asset('assets/css/product-details.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="site-breadcrumb breadcrumb-bg-impeercol">
        <div class="container">
            <h1 class="breadcrumb-title">{{ $page['h1'] }}</h1>
            <ul class="breadcrumb-menu clearfix">
                <li><a href="{{ route('web.home') }}">Inicio</a></li>
                <li class="active">{{ $page['breadcrumb_label'] }}</li>
            </ul>
        </div>
    </div>

    <section class="de-padding">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-xl-7">
                    <p class="text-uppercase text-muted small mb-2">Venta de productos · Asesoría técnica</p>
                    <h2 class="hero-title mb-20">{{ $page['hero_subtitle'] }}</h2>
                    <p class="mb-3">
                        En <strong>IMPEERCOL</strong> te ayudamos a pasar del <strong>problema</strong> (filtración, humedad, fisuras)
                        al <strong>producto y sistema</strong> que mejor encaja con tu cubierta o paramento, siempre con respaldo
                        de fichas técnicas y marcas reconocidas.
                    </p>
                    <p class="mb-3">
                        Distribuimos referencias de fabricantes como <strong>Sika, Texsa y Metic</strong>, entre otras, y te orientamos
                        en cantidades orientativas para cotizar con claridad. La aplicación en obra la realiza tu instalador siguiendo al fabricante.
                    </p>
                    <ul class="list-unstyled mb-4">
                        @foreach($page['benefits'] ?? [] as $benefit)
                            <li class="mb-2"><i class="icofont-check-alt"></i> {{ $benefit }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ $whatsappAdvisoryUrl }}" class="btn-whatsapp-primary" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                        <span>Solicitar asesoría por WhatsApp</span>
                    </a>
                </div>
                <div class="col-xl-5 d-flex align-items-center justify-content-center">
                    @if(($page['key'] ?? '') === 'techos')
                        @include('web.components.impeercol-techos-dual-photo', [
                            'alt' => $page['image_alt'] ?? 'Productos y sistemas para impermeabilización de techos',
                        ])
                    @else
                        <div class="about-left" style="width:100%;">
                            <div class="about-left-content">
                                <div class="about-photo pos-rel">
                                    <span class="about-dotted"></span>
                                    <img src="{{ asset('assets/img/gallery/'.$page['image']) }}"
                                         alt="{{ $page['image_alt'] }}"
                                         loading="lazy"
                                         decoding="async"
                                         width="500"
                                         height="500">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    @include('web.solutions.partials.problem-matrix', ['matrix' => $page['problem_matrix'] ?? []])

    @include('web.solutions.partials.related-products')

    @include('web.solutions.partials.whatsapp-cta')

    <section class="service-2-area de-padding pt-0">
        <div class="container">
            <div class="row mb-40">
                <div class="col-xl-8">
                    <h2 class="hero-title mb-20">Tipos de sistemas que solemos recomendar</h2>
                    <p class="mb-0">
                        La elección final depende del soporte, pendiente, uso y estado actual. Estas categorías te sirven como mapa
                        para la conversación con nuestro equipo.
                    </p>
                </div>
            </div>
            <div class="service-2-wpr grid-3">
                @foreach($page['solution_cards'] ?? [] as $card)
                    <div class="service-2-box">
                        <div class="service-2-icon"><i class="{{ $card['icon'] }}"></i></div>
                        <div class="service-2-desc">
                            <h3>{{ $card['title'] }}</h3>
                            <p>{{ $card['body'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="step-area de-pt hero-bg step-area-bg step-area--techo-proceso">
        <div class="container">
            <div class="step-wpr grid-2">
                <div class="step-left d-flex align-items-center">
                    <div class="step-left-content">
                        <h2 class="hero-title mb-20">{{ $page['process']['title'] ?? 'Cómo trabajamos contigo' }}</h2>
                        <p class="mb-30">
                            {{ $page['process']['intro'] ?? '' }}
                        </p>
                        <div class="button-container-2">
                            <span class="mas">WhatsApp</span>
                            <a href="{{ $whatsappAdvisoryUrl }}" class="site-btn-2" target="_blank" rel="noopener noreferrer">Solicitar asesoría por WhatsApp</a>
                        </div>
                    </div>
                </div>
                <div class="step-right">
                    <div class="step-box-wpr grid-2">
                        <div class="step-box">
                            <span class="step-number">01</span>
                            <h3 class="heading-6">Nos describes el problema</h3>
                            <p>Tipo de superficie, fotos, zona afectada y si ya hubo intentos de reparación.</p>
                        </div>
                        <div class="step-box">
                            <span class="step-number">02</span>
                            <h3 class="heading-6">Propuesta de productos</h3>
                            <p>Te sugerimos referencias del catálogo y consumo por m² según la ficha técnica.</p>
                        </div>
                        <div class="step-box">
                            <span class="step-number">03</span>
                            <h3 class="heading-6">Cotización y logística</h3>
                            <p>Confirmamos disponibilidad, entrega o recogida y opciones de pago.</p>
                        </div>
                        <div class="step-box">
                            <span class="step-number">04</span>
                            <h3 class="heading-6">Soporte durante la obra</h3>
                            <p>Dudas sobre mezcla, condiciones de aplicación o compatibilidad entre capas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-area de-padding">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-xl-7">
                    <h2 class="hero-title mb-20">¿Necesitas una segunda opinión antes de comprar?</h2>
                    <p class="mb-3">
                        Muchas filtraciones se repiten por mezclar sistemas incompatibles o por bajo espesor de producto.
                        Te ayudamos a evitar esos errores con una lista clara de materiales.
                    </p>
                    <ul class="list-unstyled mb-0">
                        <li><i class="icofont-check"></i> Enfoque en producto y cantidad, no en “mano de obra incluida”.</li>
                        <li><i class="icofont-check"></i> Referencias de marcas con trayectoria en impermeabilización.</li>
                        <li><i class="icofont-check"></i> También puedes completar el formulario en <a href="{{ route('web.contact') }}">contacto</a>.</li>
                    </ul>
                </div>
                <div class="col-xl-5">
                    <div class="contact-right contact-bg-animated">
                        <h3 class="mb-3">Escribir por WhatsApp</h3>
                        <p class="mb-3">Respuesta ágil para cotizaciones y dudas técnicas sobre productos.</p>
                        <a href="{{ $whatsappAdvisoryUrl }}" class="btn-whatsapp-primary w-100 justify-content-center" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-whatsapp" aria-hidden="true"></i>
                            <span>Solicitar asesoría por WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('web.solutions.partials.faq', [
        'faqs' => $page['faqs'] ?? [],
        'faqParentId' => 'faq_'.$page['key'],
    ])

    @include('web.components.contact-info-strip')
@endsection
