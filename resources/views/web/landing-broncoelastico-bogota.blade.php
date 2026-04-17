@extends('layouts.main')

@section('title', 'Broncoelástico 10 Años en Bogotá | Impermeabilizante para techos en lluvia')
@section('description', 'Broncoelástico Bogotá para impermeabilizante techos lluvia. Solución goteras Bogotá con elasticidad +120%, secado rápido y protección hasta 10 años.')

@section('og_image', asset('assets/img/webp/productos-techos-2.webp'))

@section('styles')
<link rel="preload" as="image" href="{{ asset('assets/img/webp/productos-techos-2.webp') }}" fetchpriority="high">
<style>
    #imp-nav,
    #imp-nav.imp-nav--scrolled {
        background: rgba(15, 23, 42, .94) !important;
        border-bottom: 1px solid rgba(148, 163, 184, .22);
        backdrop-filter: blur(6px);
    }
    #imp-header .imp-nav__link,
    #imp-header .imp-nav__link--drop,
    #imp-header .imp-search-trigger {
        color: #f8fafc !important;
    }
    #imp-header .imp-logo--light {
        opacity: 1 !important;
        visibility: visible !important;
    }
    #imp-header .imp-logo--dark {
        opacity: 0 !important;
        visibility: hidden !important;
    }
    #imp-header .imp-whatsapp-btn {
        box-shadow: 0 10px 22px rgba(220, 38, 38, .3);
    }

    .bronco-lp { --bl-bg: #f8fafc; --bl-surface: #fff; --bl-text: #0f172a; --bl-muted: #334155; --bl-line: #e2e8f0; --bl-primary: #dc2626; --bl-primary-2: #ef4444; --bl-success: #16a34a; }
    .bronco-lp * { box-sizing: border-box; }
    .bronco-lp { background: var(--bl-bg); color: var(--bl-text); line-height: 1.5; text-rendering: optimizeLegibility; }
    .bronco-lp img { max-width: 100%; height: auto; display: block; }
    .bronco-lp a.bronco-lp__link { color: inherit; text-decoration: none; }
    .bronco-lp__w { width: min(1120px, 92vw); margin: 0 auto; }
    .bronco-lp .section { padding: 3.7rem 0; }
    .bronco-lp .kicker {
        font-size: .79rem;
        letter-spacing: .03em;
        text-transform: uppercase;
        color: #0284c7;
        font-weight: 700;
        margin: 0 0 .5rem;
    }
    .bronco-lp h2 { margin: 0 0 .8rem; font-size: clamp(1.45rem, 3.2vw, 2.1rem); line-height: 1.2; }
    .bronco-lp h3 { margin: 0 0 .4rem; font-size: 1.08rem; }
    .bronco-lp p { margin: 0; color: var(--bl-muted); }

    .bronco-lp .hero {
        padding: 1.25rem 0 3.5rem;
        background:
            radial-gradient(ellipse 90% 80% at 85% 15%, rgba(14, 165, 233, .18) 0%, transparent 55%),
            radial-gradient(ellipse 70% 50% at 10% 90%, rgba(220, 38, 38, .06) 0%, transparent 50%),
            linear-gradient(180deg, #f1f5f9 0%, #f8fafc 45%, #fff 100%);
    }
    .bronco-lp .hero-grid {
        display: grid;
        grid-template-columns: 1.02fr .98fr;
        gap: clamp(1.25rem, 3vw, 2.25rem);
        align-items: center;
    }
    .bronco-lp .hero__copy-block {
        padding: clamp(1rem, 2.5vw, 1.75rem);
        border-radius: 20px;
        background: rgba(255, 255, 255, .72);
        border: 1px solid rgba(226, 232, 240, .9);
        box-shadow: 0 4px 24px rgba(15, 23, 42, .06);
        backdrop-filter: blur(8px);
    }
    .bronco-lp .hero-urgent {
        margin: 0 0 .85rem;
        font-size: clamp(.95rem, 1.8vw, 1.05rem);
        font-weight: 600;
        color: #b91c1c;
        line-height: 1.35;
    }
    .bronco-lp .hero-copy { font-size: clamp(1rem, 2.2vw, 1.14rem); max-width: 58ch; margin-bottom: 1.15rem; }
    .bronco-lp .hero-badges {
        display: flex;
        flex-wrap: wrap;
        gap: .45rem;
        margin: 0 0 1.1rem;
    }
    .bronco-lp .hero-badge {
        font-size: .72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .04em;
        color: #0369a1;
        background: rgba(14, 165, 233, .12);
        border: 1px solid rgba(14, 165, 233, .22);
        padding: .35rem .6rem;
        border-radius: 999px;
    }
    .bronco-lp .hero-cta-wrap {
        margin-bottom: 1.15rem;
    }
    .bronco-lp .btn-hero {
        width: 100%;
        max-width: 22rem;
        min-height: 56px;
        font-size: 1.05rem;
        border-radius: 14px;
        padding: .85rem 1.25rem;
        box-shadow: 0 14px 32px rgba(220, 38, 38, .35);
        transition: transform .2s ease, box-shadow .2s ease;
    }
    .bronco-lp .btn-hero:hover {
        transform: translateY(-2px);
        box-shadow: 0 18px 38px rgba(220, 38, 38, .4);
        color: #fff;
    }
    .bronco-lp .btn-hero .fab { font-size: 1.35rem; }
    .bronco-lp .hero-cta-note {
        margin: .55rem 0 0;
        font-size: .86rem;
        color: #64748b;
        max-width: 22rem;
    }
    .bronco-lp .hero-cta-note strong { color: #475569; }
    .bronco-lp .hero-media {
        position: relative;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid var(--bl-line);
        background: linear-gradient(160deg, #e0f2fe 0%, #f8fafc 50%, #fff 100%);
        box-shadow:
            0 24px 48px rgba(15, 23, 42, .14),
            0 0 0 1px rgba(255, 255, 255, .6) inset;
    }
    .bronco-lp .hero-media::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 45%, rgba(15, 23, 42, .12) 100%);
        pointer-events: none;
    }
    .bronco-lp .hero-media img {
        width: 100%;
        aspect-ratio: 960 / 1280;
        object-fit: cover;
        object-position: 50% 38%;
    }
    .bronco-lp .hero-media__label {
        position: absolute;
        left: 12px;
        bottom: 12px;
        z-index: 2;
        padding: .45rem .75rem;
        font-size: .75rem;
        font-weight: 700;
        color: #f8fafc;
        background: rgba(15, 23, 42, .82);
        border-radius: 10px;
        border: 1px solid rgba(255, 255, 255, .15);
        max-width: calc(100% - 24px);
    }
    .bronco-lp .hero h1 {
        margin: 0 0 .55rem;
        font-size: clamp(1.95rem, 5vw, 3rem);
        line-height: 1.08;
        letter-spacing: -0.02em;
        background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    @supports not (-webkit-background-clip: text) {
        .bronco-lp .hero h1 { color: #0f172a; background: none; }
    }
    .bronco-lp .btn {
        border: 0;
        min-height: 48px;
        border-radius: 12px;
        padding: .72rem 1rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .55rem;
        cursor: pointer;
    }
    .bronco-lp .btn-primary {
        color: #fff;
        background: linear-gradient(135deg, var(--bl-primary) 0%, var(--bl-primary-2) 100%);
        box-shadow: 0 12px 26px rgba(220, 38, 38, .28);
    }
    .bronco-lp .btn-primary:hover { filter: brightness(1.04); color: #fff; }
    .bronco-lp .btn-dark {
        color: #fff;
        background: rgba(15, 23, 42, .38);
        border: 1px solid rgba(248, 250, 252, .25);
    }
    .bronco-lp .hero-stats { margin-top: 0; display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: .55rem; }
    .bronco-lp .hero-stat {
        background: linear-gradient(160deg, #1e293b 0%, #0f172a 100%);
        color: #f8fafc;
        border-radius: 12px;
        text-align: center;
        padding: .65rem .5rem;
        border: 1px solid rgba(148, 163, 184, .2);
    }
    .bronco-lp .hero-stat strong { display: block; font-size: 1.08rem; line-height: 1.15; }
    .bronco-lp .hero-stat span:last-child { font-size: .72rem; opacity: .88; }

    .bronco-lp .grid-3, .bronco-lp .grid-4, .bronco-lp .proof-grid, .bronco-lp .gallery { display: grid; gap: .8rem; margin-top: 1rem; }
    .bronco-lp .grid-3, .bronco-lp .proof-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .bronco-lp .grid-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
    .bronco-lp .gallery { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .bronco-lp .card {
        background: var(--bl-surface);
        border: 1px solid var(--bl-line);
        border-radius: 14px;
        padding: .95rem;
        box-shadow: 0 6px 20px rgba(15, 23, 42, .05);
    }
    .bronco-lp .list-clean { list-style: none; margin: 1rem 0 0; padding: 0; display: grid; gap: .7rem; }
    .bronco-lp .list-clean li { border: 1px solid var(--bl-line); background: var(--bl-surface); border-radius: 12px; padding: .8rem .9rem; }
    .bronco-lp .specs { margin-top: 1rem; background: #fff; border: 1px solid var(--bl-line); border-radius: 14px; overflow: hidden; }
    .bronco-lp .specs table { width: 100%; border-collapse: collapse; }
    .bronco-lp .specs th, .bronco-lp .specs td { text-align: left; padding: .8rem .9rem; border-bottom: 1px solid var(--bl-line); vertical-align: top; }
    .bronco-lp .specs th { width: 36%; background: #f8fafc; color: #0f172a; }
    .bronco-lp .gallery figure { margin: 0; background: #fff; border: 1px solid var(--bl-line); border-radius: 12px; overflow: hidden; }
    .bronco-lp .gallery img { width: 100%; aspect-ratio: 4 / 3; object-fit: cover; }
    .bronco-lp .gallery figcaption { padding: .55rem .7rem; font-size: .84rem; color: #475569; }

    .bronco-lp .cta-panel {
        margin-top: 1rem;
        border-radius: 18px;
        padding: 1.3rem;
        border: 1px solid rgba(148, 163, 184, .3);
        background: linear-gradient(140deg, #0f172a 0%, #1e293b 55%, #0b3348 100%);
        position: relative;
        overflow: hidden;
    }
    .bronco-lp .cta-panel::after {
        content: "";
        position: absolute;
        width: 220px;
        height: 220px;
        right: -20px;
        top: -30px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(56, 189, 248, .28) 0%, rgba(56, 189, 248, 0) 72%);
    }
    .bronco-lp .cta-panel h2, .bronco-lp .cta-panel p { color: #f8fafc; position: relative; z-index: 1; }
    .bronco-lp .cta-panel p { color: #cbd5e1; max-width: 70ch; }
    .bronco-lp .cta-row { margin-top: .9rem; display: flex; flex-wrap: wrap; gap: .6rem; align-items: center; position: relative; z-index: 1; }

    .bronco-lp .sticky-cta {
        display: none;
        position: fixed;
        left: 50%;
        transform: translateX(-50%);
        bottom: .7rem;
        width: min(480px, calc(100vw - 14px));
        z-index: 1040;
        box-shadow: 0 12px 24px rgba(0, 0, 0, .24);
    }
    .bronco-lp .sticky-cta .btn { width: 100%; min-height: 52px; border-radius: 14px; }

    .bronco-lp .lp-footer-note { padding: 2rem 0 5rem; text-align: center; color: #64748b; font-size: .9rem; }

    @media (max-width: 1024px) {
        .bronco-lp .grid-4 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media (max-width: 920px) {
        .bronco-lp .section { padding: 3rem 0; }
        .bronco-lp .hero-grid, .bronco-lp .grid-3, .bronco-lp .grid-4, .bronco-lp .proof-grid, .bronco-lp .gallery { grid-template-columns: 1fr; }
        .bronco-lp .hero-stats { grid-template-columns: 1fr; }
        .bronco-lp .specs th { width: 45%; }
        .bronco-lp .sticky-cta { display: block; }
    }
</style>
@endsection

@section('content')
@php
    $phone = config('services.impeercol.whatsapp_phone', '573025069825');
    $whatsappMessage = urlencode('Hola, quiero cotizar Broncoelástico 10 Años para impermeabilizar mi techo en Bogotá.');
    $whatsappUrl = 'https://wa.me/' . $phone . '?text=' . $whatsappMessage;
@endphp

<div class="bronco-lp">
    <section class="hero" id="hero">
        <div class="bronco-lp__w hero-grid">
            <article class="hero__copy-block">
                <p class="kicker">Impermeabilizante techos lluvia · Bogotá</p>
                <h1>Broncoelástico 10 Años en Bogotá</h1>
                <p class="hero-urgent">Lluvias fuertes en camino: cada día sin protección aumenta el riesgo de filtraciones.</p>
                <p class="hero-copy">
                    Protege techo, terraza o superficie expuesta con una membrana acrílica elástica que sella fisuras y
                    reduce humedad antes de que el daño sea mayor.
                </p>
                <div class="hero-badges" aria-label="Palabras clave del producto">
                    <span class="hero-badge">broncoelástico Bogotá</span>
                    <span class="hero-badge">impermeabilizante techos lluvia</span>
                    <span class="hero-badge">impermeabilizar techo Bogotá</span>
                </div>
                <div class="hero-cta-wrap">
                    <a href="{{ $whatsappUrl }}" class="btn btn-primary btn-hero wa-track bronco-lp__link" data-conv data-cta-location="hero" target="_blank" rel="noopener noreferrer">
                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                        <span>Cotizar por WhatsApp</span>
                    </a>
                    <p class="hero-cta-note"><strong>Sin compromiso.</strong> Te respondemos con cantidad estimada y capas recomendadas.</p>
                </div>
                <div class="hero-stats" aria-label="Indicadores técnicos principales">
                    <div class="hero-stat"><strong>+120%</strong><span>Elasticidad</span></div>
                    <div class="hero-stat"><strong>10 años</strong><span>Durabilidad</span></div>
                    <div class="hero-stat"><strong>~3 h</strong><span>Secado / capa</span></div>
                </div>
            </article>
            <figure class="hero-media">
                <img src="{{ asset('assets/img/webp/productos-techos-2.webp') }}"
                     alt="Broncoelástico 10 años, impermeabilizante para techos en Bogotá"
                     width="960"
                     height="1280"
                     decoding="async"
                     fetchpriority="high">
                <figcaption class="hero-media__label">Broncoelástico 10 años · membrana elástica</figcaption>
            </figure>
        </div>
    </section>

    <section class="section" id="problema">
        <div class="bronco-lp__w">
            <p class="kicker">Problema</p>
            <h2>Goteras y filtraciones que empeoran en lluvias de Bogotá</h2>
            <p>
                La humedad no solo mancha: deteriora acabados, daña estructuras y aumenta costos de reparación.
                Broncoelástico funciona como <strong>solución goteras Bogotá</strong> para intervenir antes de pérdidas mayores.
            </p>
            <div class="grid-3">
                <article class="card"><h3>Goteras frecuentes</h3><p>El agua entra por fisuras y juntas debilitadas.</p></article>
                <article class="card"><h3>Filtraciones ocultas</h3><p>La humedad avanza dentro del sistema y afecta interiores.</p></article>
                <article class="card"><h3>Daños por lluvia</h3><p>Cada aguacero acelera el deterioro si no hay protección elástica.</p></article>
            </div>
        </div>
    </section>

    <section class="section" id="solucion">
        <div class="bronco-lp__w">
            <p class="kicker">Solución</p>
            <h2>Una capa impermeable elástica que sella fisuras y protege por años</h2>
            <p>
                Broncoelástico es un recubrimiento acrílico de alta adherencia para techos, terrazas y superficies expuestas.
                Crea una barrera continua contra agua y humedad, mantiene flexibilidad y reduce aparición de grietas.
            </p>
            <ul class="list-clean">
                <li><strong>Membrana elástica:</strong> acompaña movimientos sin quebrarse.</li>
                <li><strong>Sellado de microfisuras:</strong> menor paso de agua en puntos críticos.</li>
                <li><strong>Protección prolongada:</strong> desempeño diseñado para clima lluvia-sol.</li>
            </ul>
        </div>
    </section>

    <section class="section" id="beneficios">
        <div class="bronco-lp__w">
            <p class="kicker">Beneficios</p>
            <h2>Claros, técnicos y listos para decidir compra</h2>
            <div class="grid-4">
                <article class="card"><h3>Hasta 10 años de protección</h3><p>Cobertura duradera si se aplica el sistema recomendado.</p></article>
                <article class="card"><h3>Ideal temporada de lluvias</h3><p>Resiste exposición continua al agua y cambios de clima.</p></article>
                <article class="card"><h3>Aplicación rápida</h3><p>Secado por capa en aprox. 3 horas para avanzar obra.</p></article>
                <article class="card"><h3>Múltiples superficies</h3><p>Compatible con concreto, zinc, fibrocemento y ladrillo.</p></article>
            </div>
        </div>
    </section>

    <section class="section" id="ficha-tecnica">
        <div class="bronco-lp__w">
            <p class="kicker">Sección técnica</p>
            <h2>Especificaciones simplificadas para compra segura</h2>
            <div class="specs" role="region" aria-label="Especificaciones técnicas de broncoelástico">
                <table>
                    <tbody>
                    <tr><th>Elasticidad</th><td>Más de 120%, ayuda a cubrir micro movimientos y puentes de fisuras.</td></tr>
                    <tr><th>Consumo estimado</th><td>Aproximadamente 4.5 a 5 m² por galón según estado del sustrato.</td></tr>
                    <tr><th>Secado por capa</th><td>Cerca de 3 horas en condiciones normales de ventilación.</td></tr>
                    <tr><th>Sistema recomendado</th><td>Aplicar 2 a 3 capas para continuidad y mejor desempeño.</td></tr>
                    <tr><th>Versión blanca</th><td>Mayor reflexión solar para reducir absorción térmica superficial.</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section class="section" id="social-proof">
        <div class="bronco-lp__w">
            <p class="kicker">Prueba social</p>
            <h2>Clientes y obras que respaldan resultados</h2>
            <div class="proof-grid">
                <article class="card"><h3>+520 clientes satisfechos</h3><p>Asesorados para impermeabilizar superficies en Bogotá y alrededores.</p></article>
                <article class="card"><h3>+780 trabajos referenciados</h3><p>Aplicaciones en vivienda, comercio y cubiertas expuestas.</p></article>
                <article class="card"><h3>Soporte técnico previo</h3><p>Recomendación de capas, consumo y tiempos de secado.</p></article>
            </div>
            <div class="gallery">
                <figure>
                    <img src="{{ asset('assets/img/webp/productos-techos-2.webp') }}"
                         alt="Impermeabilización de cubierta expuesta en Bogotá"
                         width="960"
                         height="1280"
                         loading="lazy"
                         decoding="async">
                    <figcaption>Aplicación en cubierta para temporada de lluvia.</figcaption>
                </figure>
                <figure>
                    <img src="{{ asset('assets/img/webp/background-impeercol.webp') }}"
                         alt="Producto broncoelástico para techo en Bogotá"
                         width="1280"
                         height="960"
                         loading="lazy"
                         decoding="async">
                    <figcaption>Producto con alta adherencia y resistencia climática.</figcaption>
                </figure>
            </div>
        </div>
    </section>

    <section class="section" id="cotizar">
        <div class="bronco-lp__w">
            <div class="cta-panel">
                <p class="kicker" style="color:#38bdf8;">CTA final</p>
                <h2>Cotiza hoy mismo y evita más daños por lluvia</h2>
                <p>
                    Envíanos fotos del área, tipo de superficie y metraje aproximado.
                    Te orientamos para elegir sistema, capas y consumo de broncoelástico Bogotá.
                </p>
                <div class="cta-row">
                    <a href="{{ $whatsappUrl }}" class="btn btn-primary wa-track bronco-lp__link" data-conv data-cta-location="final" target="_blank" rel="noopener noreferrer">
                        Cotizar por WhatsApp
                    </a>
                    <span class="btn btn-dark">Atención rápida en Bogotá</span>
                </div>
            </div>
        </div>
    </section>

    <div class="sticky-cta">
        <a href="{{ $whatsappUrl }}" class="btn btn-primary wa-track bronco-lp__link" data-conv data-cta-location="sticky" target="_blank" rel="noopener noreferrer">
            Cotiza hoy mismo
        </a>
    </div>

    <div class="lp-footer-note bronco-lp__w">
        © {{ now()->year }} IMPEERCOL. Landing optimizada para broncoelástico Bogotá.
    </div>
</div>
@endsection

@section('scripts')
<script>
(function () {
    var buttons = document.querySelectorAll('.wa-track');
    buttons.forEach(function (button) {
        button.addEventListener('click', function () {
            var location = button.getAttribute('data-cta-location') || 'unknown';
            if (typeof gtag === 'function') {
                gtag('event', 'click_whatsapp', {
                    event_category: 'lead',
                    event_label: 'broncoelastico_10_anos_bogota',
                    cta_location: location
                });
            }
        });
    });
})();
</script>
@endsection
