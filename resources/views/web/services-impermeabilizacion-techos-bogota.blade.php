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
                    <p class="text-uppercase text-muted small mb-2">Productos · Bogotá y alrededores</p>
                    <h2 class="hero-title mb-20">{{ $page['hero_subtitle'] }}</h2>
                    <p class="mb-3">
                        En <strong>IMPEERCOL</strong> vendemos <strong>productos para impermeabilización de techos en Bogotá</strong>:
                        sistemas acrílicos, mantos asfálticos, membranas y complementos de marcas como <strong>Sika, Texsa y Metic</strong>.
                        Entendemos el clima de la ciudad, las lluvias frecuentes y cómo afectan losas, tejas y cubiertas metálicas.
                    </p>
                    <p class="mb-3">
                        No vendemos “obras llave en mano”: te damos <strong>la lista de materiales y cantidades orientativas</strong> para que
                        tu maestro o contratista los aplique según ficha técnica. Si buscas una visión general sin enfoque local,
                        también tenemos la página <a href="{{ route('web.solutions.show', 'techos') }}">soluciones para techos</a>.
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
                    @include('web.components.impeercol-techos-dual-photo', [
                        'alt' => $page['image_alt'] ?? 'Productos para impermeabilización de techos en Bogotá',
                    ])
                </div>
            </div>
        </div>
    </section>

    @include('web.solutions.partials.problem-matrix', ['matrix' => $page['problem_matrix'] ?? []])

    @include('web.solutions.partials.related-products')

    @include('web.solutions.partials.whatsapp-cta', [
        'whatsappCtaTitle' => '¿Filtraciones en tu techo en Bogotá?',
        'whatsappCtaText' => 'Envíanos fotos del interior y de la cubierta, zona de la ciudad y tipo de techo. Te orientamos por WhatsApp con productos y cantidades.',
        'whatsappCtaLabel' => 'Solicitar asesoría por WhatsApp',
    ])

    <section class="service-2-area de-padding pt-0">
        <div class="container">
            <div class="row mb-40">
                <div class="col-xl-8">
                    <h2 class="hero-title mb-20">Tipos de productos para techos en Bogotá</h2>
                    <p class="mb-0">
                        Cada cubierta requiere un sistema coherente con pendiente, movimiento y exposición al sol.
                        Estas familias son las que más consultamos en la ciudad.
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
                        <h2 class="hero-title mb-20">Cómo te ayudamos a comprar el producto adecuado</h2>
                        <p class="mb-30">
                            Partimos del problema que ves en casa o en la obra en Bogotá y lo cruzamos con el tipo de techo.
                            Así definimos referencias de catálogo y un consumo por m² realista para cotizar.
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
                            <h3 class="heading-6">Nos cuentas el caso</h3>
                            <p>Tipo de cubierta, zona en Bogotá, manchas o goteras, y si ya se aplicó algún producto antes.</p>
                        </div>
                        <div class="step-box">
                            <span class="step-number">02</span>
                            <h3 class="heading-6">Lista de materiales</h3>
                            <p>Te proponemos referencias (Sika, Texsa, Metic u otras) y cantidades según área aproximada.</p>
                        </div>
                        <div class="step-box">
                            <span class="step-number">03</span>
                            <h3 class="heading-6">Tu instalador aplica</h3>
                            <p>Entregamos criterios alineados con la ficha técnica para no invalidar garantías de fábrica.</p>
                        </div>
                        <div class="step-box">
                            <span class="step-number">04</span>
                            <h3 class="heading-6">Seguimiento</h3>
                            <p>Resolvemos dudas de mezcla, tiempo entre manos o compatibilidad entre capas.</p>
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
                    <h2 class="hero-title mb-20">¿Necesitas cotizar materiales para un techo en Bogotá?</h2>
                    <p class="mb-3">
                        Cuéntanos el tipo de cubierta, el área aproximada y el barrio o municipio. Prepararemos una propuesta
                        de <strong>productos</strong> para que compares con tu cuadrilla de obra.
                    </p>
                    <ul class="list-unstyled mb-0">
                        <li><i class="icofont-check"></i> Conjuntos residenciales, locales, bodegas y viviendas.</li>
                        <li><i class="icofont-check"></i> También puedes usar el <a href="{{ route('web.contact') }}">formulario de contacto</a>.</li>
                    </ul>
                </div>
                <div class="col-xl-5">
                    <div class="contact-right contact-bg-animated">
                        <h3 class="mb-3">Solicitar asesoría por WhatsApp</h3>
                        <p class="mb-3">La vía más rápida para fotos, audios y ubicación.</p>
                        <a href="{{ $whatsappAdvisoryUrl }}" class="btn-whatsapp-primary w-100 justify-content-center" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-whatsapp" aria-hidden="true"></i>
                            <span>Solicitar asesoría por WhatsApp</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="faq-area de-padding pt-0">
        <div class="container">
            <div class="row mb-40">
                <div class="col-xl-8 offset-xl-2 text-center">
                    <h2 class="hero-title mb-20">Preguntas frecuentes — productos para techos en Bogotá</h2>
                    <p class="mb-0">
                        Enfocadas en <strong>compra de materiales y asesoría</strong>, no en prometer ejecución de obra por nuestra cuenta.
                    </p>
                </div>
            </div>
            <div class="accordion" id="faqTechosBogotaProductos">
                <div class="accordion-item">
                    <h3 class="accordion-header" id="faq-bogota-1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-bogota-c1" aria-expanded="true" aria-controls="faq-bogota-c1">
                            ¿Cada cuánto debo revisar los productos en mi techo?
                        </button>
                    </h3>
                    <div id="faq-bogota-c1" class="accordion-collapse collapse show" aria-labelledby="faq-bogota-1" data-bs-parent="#faqTechosBogotaProductos">
                        <div class="accordion-body">
                            Depende del sistema aplicado y de la exposición. Como regla general, conviene una inspección visual anual
                            y planificar renovación o refuerzo cada varios años según indique el fabricante y el estado de la lámina o recubrimiento.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="faq-bogota-2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-bogota-c2" aria-expanded="false" aria-controls="faq-bogota-c2">
                            ¿Cuánto material necesito para mi techo?
                        </button>
                    </h3>
                    <div id="faq-bogota-c2" class="accordion-collapse collapse" aria-labelledby="faq-bogota-2" data-bs-parent="#faqTechosBogotaProductos">
                        <div class="accordion-body">
                            Se calcula con metros cuadrados reales, número de manos y rendimiento en ficha técnica (litros o kg por m²).
                            Si nos compartes medidas y fotos, estimamos una lista de compra más ajustada.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="faq-bogota-3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-bogota-c3" aria-expanded="false" aria-controls="faq-bogota-c3">
                            ¿Trabajan solo en Bogotá o también en municipios cercanos?
                        </button>
                    </h3>
                    <div id="faq-bogota-c3" class="accordion-collapse collapse" aria-labelledby="faq-bogota-3" data-bs-parent="#faqTechosBogotaProductos">
                        <div class="accordion-body">
                            Nuestra operación principal es <strong>Bogotá</strong>; también coordinamos envíos o entregas hacia municipios cercanos
                            como Soacha, Chía, Cota o Funza según logística. Escríbenos la ubicación exacta.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h3 class="accordion-header" id="faq-bogota-4">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-bogota-c4" aria-expanded="false" aria-controls="faq-bogota-c4">
                            ¿Qué garantía tienen los productos?
                        </button>
                    </h3>
                    <div id="faq-bogota-c4" class="accordion-collapse collapse" aria-labelledby="faq-bogota-4" data-bs-parent="#faqTechosBogotaProductos">
                        <div class="accordion-body">
                            Las garantías de desempeño las define cada fabricante cuando el sistema se aplica según su manual.
                            IMPEERCOL suministra productos originales y la información técnica; el cumplimiento en obra es responsabilidad de quien ejecuta la aplicación.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('web.components.contact-info-strip')
@endsection
