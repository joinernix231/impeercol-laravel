@extends('layouts.main')

@section('title', $page['meta_title'])
@section('description', $page['meta_description'])

@section('styles')
<link href="{{ asset('assets/css/product-details.css') }}" rel="stylesheet">
<style>
/* ═══════════════════════════════════════════════
   LANDING DE SOLUCIONES — Estilos de conversión
═══════════════════════════════════════════════ */
:root {
    --sol-red:      #E30613;
    --sol-red-dark: #b8020e;
    --sol-dark:     #111827;
    --sol-gray:     #6b7280;
    --sol-light:    #f9fafb;
    --sol-border:   #e5e7eb;
    --sol-ease:     cubic-bezier(0.22, 1, 0.36, 1);
}

/* ── Hero ── */
.sol-hero {
    position: relative;
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 60%, #1a1a2e 100%);
    padding: 7rem 0 5rem;
    overflow: hidden;
    min-height: 520px;
    display: flex;
    align-items: center;
}
.sol-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 60% 80% at 70% 50%, rgba(227,6,19,0.12) 0%, transparent 70%),
        radial-gradient(ellipse 40% 60% at 10% 80%, rgba(227,6,19,0.07) 0%, transparent 60%);
    pointer-events: none;
}
.sol-hero__grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: center;
}
.sol-hero__badge {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    background: rgba(227,6,19,0.15);
    border: 1px solid rgba(227,6,19,0.35);
    color: #fca5a5;
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    padding: 0.45rem 1rem;
    border-radius: 50px;
    margin-bottom: 1.25rem;
}
.sol-hero__h1 {
    font-size: clamp(2.5rem, 4.5vw, 3.75rem);
    font-weight: 800;
    color: #ffffff;
    line-height: 1.2;
    margin-bottom: 1.1rem;
    letter-spacing: -0.02em;
}
.sol-hero__h1 span { color: var(--sol-red); }
.sol-hero__lead {
    font-size: 1.35rem;
    color: rgba(255,255,255,0.72);
    line-height: 1.7;
    margin-bottom: 2rem;
    max-width: 560px;
}
.sol-hero__actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.85rem;
    align-items: center;
    margin-bottom: 2.5rem;
}
.sol-btn-wa {
    display: inline-flex;
    align-items: center;
    gap: 0.55rem;
    padding: 1rem 2rem;
    background: var(--sol-red);
    color: #fff;
    font-size: 1.15rem;
    font-weight: 700;
    border-radius: 50px;
    text-decoration: none;
    transition: background 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease;
    white-space: nowrap;
}
.sol-btn-wa:hover {
    background: var(--sol-red-dark);
    box-shadow: 0 8px 24px rgba(227,6,19,0.4);
    transform: translateY(-2px);
    color: #fff;
    text-decoration: none;
}
.sol-btn-wa--outline {
    background: transparent;
    border: 2px solid rgba(255,255,255,0.3);
    color: rgba(255,255,255,0.88);
    padding: calc(0.9rem - 2px) calc(1.75rem - 2px);
}
.sol-btn-wa--outline:hover {
    background: rgba(255,255,255,0.08);
    border-color: rgba(255,255,255,0.55);
    color: #fff;
    box-shadow: none;
    transform: translateY(-1px);
}
.sol-hero__trust {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    flex-wrap: wrap;
}
.sol-hero__trust-item {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    color: rgba(255,255,255,0.55);
    font-size: 1.05rem;
}
.sol-hero__trust-item svg { color: #4ade80; flex-shrink: 0; }
.sol-hero__img-wrap {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* ── Barra de marcas ── */
.sol-brands {
    background: #ffffff;
    border-bottom: 1px solid var(--sol-border);
    padding: 1.4rem 0;
}
.sol-brands__inner {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.6rem 1.75rem;
    flex-wrap: wrap;
}
.sol-brands__label {
    font-size: 0.95rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: #9ca3af;
    white-space: nowrap;
}
.sol-brands__name {
    font-size: 1.35rem;
    font-weight: 800;
    color: #374151;
    letter-spacing: -0.01em;
    opacity: 0.7;
    transition: opacity 0.2s;
}
.sol-brands__name:hover { opacity: 1; }
.sol-brands__sep {
    width: 1px;
    height: 20px;
    background: var(--sol-border);
}

/* ── Sección genérica ── */
.sol-section { padding: 5rem 0; }
.sol-section--gray { background: var(--sol-light); }
.sol-section--dark {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    color: #fff;
}
.sol-section-tag {
    display: inline-block;
    font-size: 1rem;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--sol-red);
    margin-bottom: 0.6rem;
}
.sol-section-title {
    font-size: clamp(2rem, 3.5vw, 2.85rem);
    font-weight: 800;
    color: var(--sol-dark);
    line-height: 1.25;
    letter-spacing: -0.02em;
    margin-bottom: 0.85rem;
}
.sol-section-title--light { color: #ffffff; }
.sol-section-lead {
    font-size: 1.35rem;
    color: var(--sol-gray);
    line-height: 1.7;
    max-width: 650px;
}
.sol-section-lead--light { color: rgba(255,255,255,0.7); }

/* ── Cards de problema ── */
.sol-problem-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    margin-top: 3rem;
}
.sol-problem-card {
    background: #ffffff;
    border: 1px solid var(--sol-border);
    border-radius: 20px;
    padding: 2rem;
    transition: transform 0.28s var(--sol-ease), box-shadow 0.28s ease, border-color 0.25s ease;
    cursor: default;
    position: relative;
    overflow: hidden;
}
.sol-problem-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: var(--sol-red);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s var(--sol-ease);
}
.sol-problem-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.10);
    border-color: transparent;
}
.sol-problem-card:hover::before { transform: scaleX(1); }
.sol-problem-card__emoji {
    font-size: 2.85rem;
    margin-bottom: 1rem;
    display: block;
}
.sol-problem-card__title {
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--sol-dark);
    margin-bottom: 0.6rem;
    line-height: 1.3;
}
.sol-problem-card__body {
    font-size: 1.15rem;
    color: var(--sol-gray);
    line-height: 1.6;
    margin-bottom: 1rem;
}
.sol-problem-card__hint {
    font-size: 1rem;
    font-weight: 600;
    color: var(--sol-red);
    background: rgba(227,6,19,0.07);
    padding: 0.4rem 0.75rem;
    border-radius: 6px;
    display: inline-block;
    margin-bottom: 1.25rem;
}
.sol-problem-card__cta {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--sol-red);
    text-decoration: none;
    transition: gap 0.2s ease;
}
.sol-problem-card__cta:hover { gap: 0.7rem; color: var(--sol-red-dark); text-decoration: none; }

/* ── Productos ── */
.sol-products-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.5rem;
    margin-top: 3rem;
}
.sol-product-card {
    background: #fff;
    border: 1px solid var(--sol-border);
    border-radius: 16px;
    overflow: hidden;
    transition: transform 0.28s var(--sol-ease), box-shadow 0.28s ease;
}
.sol-product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 14px 36px rgba(0,0,0,0.10);
}
.sol-product-card__img {
    width: 100%;
    aspect-ratio: 1/1;
    object-fit: cover;
    display: block;
    background: #f3f4f6;
}
.sol-product-card__body {
    padding: 1.1rem;
}
.sol-product-card__brand {
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--sol-gray);
    margin-bottom: 0.3rem;
}
.sol-product-card__name {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--sol-dark);
    line-height: 1.35;
    margin-bottom: 0.85rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
.sol-product-card__name a { color: inherit; text-decoration: none; }
.sol-product-card__name a:hover { color: var(--sol-red); }
.sol-product-card__actions { display: flex; flex-direction: column; gap: 0.5rem; }
.sol-btn-product {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.4rem;
    padding: 0.75rem 1rem;
    font-size: 1.05rem;
    font-weight: 700;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.2s ease;
    text-align: center;
}
.sol-btn-product--wa {
    background: var(--sol-red);
    color: #fff;
}
.sol-btn-product--wa:hover {
    background: var(--sol-red-dark);
    color: #fff;
    text-decoration: none;
    box-shadow: 0 4px 14px rgba(227,6,19,0.3);
}
.sol-btn-product--outline {
    border: 1.5px solid var(--sol-border);
    color: var(--sol-gray);
}
.sol-btn-product--outline:hover {
    border-color: var(--sol-red);
    color: var(--sol-red);
    text-decoration: none;
}

/* ── Beneficios ── */
.sol-benefits-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.75rem;
    margin-top: 3rem;
}
.sol-benefit {
    text-align: center;
    padding: 2rem 1.25rem;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 16px;
    transition: background 0.25s ease, transform 0.25s ease;
}
.sol-benefit:hover {
    background: rgba(255,255,255,0.08);
    transform: translateY(-4px);
}
.sol-benefit__icon {
    width: 72px;
    height: 72px;
    background: rgba(227,6,19,0.15);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.1rem;
    color: #fca5a5;
    font-size: 2rem;
}
.sol-benefit__title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #ffffff;
    margin-bottom: 0.5rem;
}
.sol-benefit__text {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.55);
    line-height: 1.6;
}

/* ── Proceso ── */
.sol-steps-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.5rem;
    margin-top: 3rem;
    position: relative;
}
.sol-steps-grid::before {
    content: '';
    position: absolute;
    top: 28px;
    left: calc(12.5% + 28px);
    right: calc(12.5% + 28px);
    height: 2px;
    background: linear-gradient(90deg, var(--sol-red), rgba(227,6,19,0.2));
    z-index: 0;
}
.sol-step {
    text-align: center;
    position: relative;
    z-index: 1;
}
.sol-step__num {
    width: 64px;
    height: 64px;
    background: var(--sol-red);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    font-weight: 800;
    color: #fff;
    margin: 0 auto 1.1rem;
    border: 3px solid #fff;
    box-shadow: 0 0 0 3px var(--sol-red);
}
.sol-step__title {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--sol-dark);
    margin-bottom: 0.5rem;
}
.sol-step__text { font-size: 1.1rem; color: var(--sol-gray); line-height: 1.6; }

/* ── Stats ── */
.sol-stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0;
}
.sol-stat {
    text-align: center;
    padding: 2.5rem 1.5rem;
    border-right: 1px solid rgba(255,255,255,0.08);
}
.sol-stat:last-child { border-right: none; }
.sol-stat__num {
    font-size: 3.65rem;
    font-weight: 800;
    color: #fff;
    line-height: 1;
    margin-bottom: 0.4rem;
}
.sol-stat__num span { color: var(--sol-red); }
.sol-stat__label { font-size: 1.1rem; color: rgba(255,255,255,0.55); }

/* ── CTA final ── */
.sol-cta-final {
    background: linear-gradient(135deg, var(--sol-red) 0%, #c10010 100%);
    padding: 5rem 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.sol-cta-final::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Ccircle cx='30' cy='30' r='20'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
}
.sol-cta-final__title {
    font-size: clamp(2.3rem, 3.9vw, 3.25rem);
    font-weight: 800;
    color: #fff;
    margin-bottom: 1rem;
    position: relative;
}
.sol-cta-final__text {
    font-size: 1.45rem;
    color: rgba(255,255,255,0.8);
    margin-bottom: 2.25rem;
    max-width: 580px;
    margin-left: auto;
    margin-right: auto;
    position: relative;
}
.sol-btn-cta-final {
    display: inline-flex;
    align-items: center;
    gap: 0.65rem;
    padding: 1.15rem 2.5rem;
    background: #fff;
    color: var(--sol-red);
    font-size: 1.35rem;
    font-weight: 800;
    border-radius: 50px;
    text-decoration: none;
    position: relative;
    transition: box-shadow 0.25s ease, transform 0.25s ease;
}
.sol-btn-cta-final:hover {
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    transform: translateY(-2px);
    color: var(--sol-red-dark);
    text-decoration: none;
}

/* ── FAQ ── */
.sol-faq { padding: 5rem 0; background: var(--sol-light); }

/* ── Botón flotante WhatsApp ── */
.sol-float-wa {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    z-index: 999;
    display: flex;
    align-items: center;
    gap: 0.55rem;
    background: #25d366;
    color: #fff;
    padding: 0.9rem 1.55rem;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 700;
    text-decoration: none;
    box-shadow: 0 6px 24px rgba(37,211,102,0.45);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    animation: sol-float-in 0.5s var(--sol-ease) 1.5s both;
}
.sol-float-wa:hover {
    transform: translateY(-3px) scale(1.03);
    box-shadow: 0 10px 32px rgba(37,211,102,0.55);
    color: #fff;
    text-decoration: none;
}
@keyframes sol-float-in {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ── Responsivo ── */
@media (max-width: 1199.98px) {
    .sol-products-grid { grid-template-columns: repeat(3, 1fr); }
}
@media (max-width: 991.98px) {
    .sol-hero__grid { grid-template-columns: 1fr; }
    .sol-hero__img-wrap { display: none; }
    .sol-hero { padding: 5rem 0 4rem; min-height: auto; }
    .sol-problem-grid { grid-template-columns: 1fr 1fr; }
    .sol-benefits-grid { grid-template-columns: 1fr 1fr; }
    .sol-steps-grid { grid-template-columns: 1fr 1fr; }
    .sol-steps-grid::before { display: none; }
    .sol-stats-grid { grid-template-columns: 1fr 1fr; }
    .sol-stat { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.08); }
    .sol-products-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 575.98px) {
    .sol-problem-grid { grid-template-columns: 1fr; }
    .sol-benefits-grid { grid-template-columns: 1fr; }
    .sol-steps-grid { grid-template-columns: 1fr; }
    .sol-stats-grid { grid-template-columns: 1fr 1fr; }
    .sol-products-grid { grid-template-columns: 1fr 1fr; }
    .sol-float-wa span { display: none; }
    .sol-float-wa { padding: 0; width: 58px; height: 58px; border-radius: 50%; justify-content: center; }
}
</style>
@endsection

@section('content')

{{-- ═══════════════════════════════════════════════
     1. HERO
═══════════════════════════════════════════════ --}}
<section class="sol-hero">
    <div class="container position-relative" style="z-index:1;">
        <div class="sol-hero__grid">
            {{-- Texto --}}
            <div>
                <span class="sol-hero__badge">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    Venta de productos · Asesoría técnica gratuita
                </span>
                <h1 class="sol-hero__h1">{{ $page['h1'] }}<span>.</span></h1>
                <p class="sol-hero__lead">
                    Evita filtraciones, goteras y daños estructurales con los productos correctos. Te asesoramos para elegir el ideal según tu caso — <strong style="color:rgba(255,255,255,0.9)">sin costo adicional.</strong>
                </p>
                <div class="sol-hero__actions">
                    <a href="{{ $whatsappAdvisoryUrl }}" class="sol-btn-wa" target="_blank" rel="noopener noreferrer">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        Solicitar asesoría por WhatsApp
                    </a>
                    <a href="{{ route('web.products') }}" class="sol-btn-wa sol-btn-wa--outline">
                        Ver catálogo de productos
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
                    </a>
                </div>
                <div class="sol-hero__trust">
                    <span class="sol-hero__trust-item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Marcas originales garantizadas
                    </span>
                    <span class="sol-hero__trust-item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        Envíos a todo Colombia
                    </span>
                    <span class="sol-hero__trust-item">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        +15 años de experiencia
                    </span>
                </div>
            </div>
            {{-- Imagen --}}
            <div class="sol-hero__img-wrap">
                @if(($page['key'] ?? '') === 'techos')
                    @include('web.components.impeercol-techos-dual-photo', [
                        'alt' => $page['image_alt'] ?? 'Productos impermeabilización de techos',
                    ])
                @else
                    <img src="{{ asset('assets/img/gallery/'.$page['image']) }}"
                         alt="{{ $page['image_alt'] }}"
                         loading="eager"
                         width="560" height="420"
                         style="width:100%;height:auto;border-radius:20px;object-fit:cover;box-shadow:0 24px 60px rgba(0,0,0,0.4);">
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     2. BARRA DE MARCAS
═══════════════════════════════════════════════ --}}
<div class="sol-brands">
    <div class="container">
        <div class="sol-brands__inner">
            <span class="sol-brands__label">Distribuimos:</span>
            <span class="sol-brands__sep"></span>
            <span class="sol-brands__name">Sika</span>
            <span class="sol-brands__sep"></span>
            <span class="sol-brands__name">Texsa</span>
            <span class="sol-brands__sep"></span>
            <span class="sol-brands__name">Metic</span>
            <span class="sol-brands__sep"></span>
            <span class="sol-brands__name">Mapei</span>
            <span class="sol-brands__sep"></span>
            <span class="sol-brands__name">Kaudal</span>
            <span class="sol-brands__sep"></span>
            <span class="sol-brands__name">Soudal</span>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════
     3. PROBLEMA → PRODUCTO
═══════════════════════════════════════════════ --}}
@if(!empty($page['problem_matrix']))
<section class="sol-section">
    <div class="container">
        <span class="sol-section-tag">Diagnóstico rápido</span>
        <h2 class="sol-section-title">¿Qué producto necesitas según tu problema?</h2>
        <p class="sol-section-lead">Cada situación pide un sistema diferente. Identifica tu caso y te orientamos en WhatsApp con referencias exactas y cantidades.</p>

        <div class="sol-problem-grid">
            @php
                $emojis = ['💧','☀️','🧱'];
                $emojiIndex = 0;
            @endphp
            @foreach($page['problem_matrix'] as $row)
            <div class="sol-problem-card">
                <span class="sol-problem-card__emoji">{{ $emojis[$emojiIndex % count($emojis)] }}</span>
                @php $emojiIndex++ @endphp
                <h3 class="sol-problem-card__title">{{ $row['title'] }}</h3>
                <p class="sol-problem-card__body">{{ $row['body'] }}</p>
                @if(!empty($row['hint']))
                    <span class="sol-problem-card__hint">{{ $row['hint'] }}</span>
                @endif
                <br>
                <a href="{{ $whatsappAdvisoryUrl }}" class="sol-problem-card__cta" target="_blank" rel="noopener noreferrer">
                    Cotizar productos
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════
     4. PRODUCTOS DESTACADOS
═══════════════════════════════════════════════ --}}
@if(isset($relatedProducts) && $relatedProducts->isNotEmpty())
<section class="sol-section sol-section--gray">
    <div class="container">
        <span class="sol-section-tag">Catálogo</span>
        <h2 class="sol-section-title">Productos recomendados para {{ $page['breadcrumb_label'] ?? 'esta solución' }}</h2>
        <p class="sol-section-lead">Referencias reales de nuestro portafolio. Haz clic en "Cotizar" y te respondemos por WhatsApp con precio y disponibilidad.</p>

        <div class="sol-products-grid">
            @foreach($relatedProducts as $product)
            <div class="sol-product-card">
                <a href="{{ route('web.product.show', $product->slug) }}" tabindex="-1">
                    @php
                        $optimizedUrl = \App\Helpers\ImageHelper::optimizedImageUrl($product->image ?? '', 300, 300);
                        $srcset = $product->image ? \App\Helpers\ImageHelper::srcset($product->image, [300, 600]) : '';
                    @endphp
                    <img class="sol-product-card__img"
                         src="{{ $optimizedUrl }}"
                         @if($srcset) srcset="{{ $srcset }}" sizes="(max-width: 768px) 50vw, 25vw" @endif
                         alt="{{ $product->name }}"
                         loading="lazy" decoding="async"
                         width="300" height="300">
                </a>
                <div class="sol-product-card__body">
                    @if($product->brand_name)
                        <p class="sol-product-card__brand">{{ $product->brand_name }}</p>
                    @endif
                    <p class="sol-product-card__name">
                        <a href="{{ route('web.product.show', $product->slug) }}">{{ $product->name }}</a>
                    </p>
                    <div class="sol-product-card__actions">
                        <a href="{{ $product->whatsapp_url }}" class="sol-btn-product sol-btn-product--wa" target="_blank" rel="noopener noreferrer">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            Cotizar por WhatsApp
                        </a>
                        <a href="{{ route('web.product.show', $product->slug) }}" class="sol-btn-product sol-btn-product--outline">
                            Ver detalles
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center" style="margin-top:2.5rem;">
            <a href="{{ route('web.products') }}" class="sol-btn-wa" style="display:inline-flex;">
                Ver todos los productos del catálogo
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════
     5. BENEFICIOS (DARK)
═══════════════════════════════════════════════ --}}
<section class="sol-section sol-section--dark">
    <div class="container">
        <div class="text-center mb-0">
            <span class="sol-section-tag">¿Por qué elegirnos?</span>
            <h2 class="sol-section-title sol-section-title--light">Lo que nos diferencia de la competencia</h2>
        </div>
        <div class="sol-benefits-grid">
            <div class="sol-benefit">
                <div class="sol-benefit__icon"><i class="icofont-shield-alt" aria-hidden="true"></i></div>
                <h3 class="sol-benefit__title">Alta durabilidad</h3>
                <p class="sol-benefit__text">Productos formulados para resistir el clima de Bogotá: lluvia intensa, sol y cambios de temperatura.</p>
            </div>
            <div class="sol-benefit">
                <div class="sol-benefit__icon"><i class="icofont-certificate-alt-2" aria-hidden="true"></i></div>
                <h3 class="sol-benefit__title">Marcas originales</h3>
                <p class="sol-benefit__text">Solo distribuimos referencias de fabricantes reconocidos. Sin productos genéricos ni sustitutos sin ficha técnica.</p>
            </div>
            <div class="sol-benefit">
                <div class="sol-benefit__icon"><i class="icofont-headphone-alt" aria-hidden="true"></i></div>
                <h3 class="sol-benefit__title">Asesoría incluida</h3>
                <p class="sol-benefit__text">Nuestro equipo te orienta en qué comprar, cuánto y en qué orden. Sin costo extra por la consulta.</p>
            </div>
            <div class="sol-benefit">
                <div class="sol-benefit__icon"><i class="icofont-truck-alt" aria-hidden="true"></i></div>
                <h3 class="sol-benefit__title">Envíos a todo el país</h3>
                <p class="sol-benefit__text">Despachamos a cualquier ciudad de Colombia. Coordina con nosotros tiempo de entrega y logística.</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     6. PROCESO (4 PASOS)
═══════════════════════════════════════════════ --}}
<section class="sol-section">
    <div class="container">
        <div class="text-center mb-0">
            <span class="sol-section-tag">Así funciona</span>
            <h2 class="sol-section-title">{{ $page['process']['title'] ?? 'Cómo te ayudamos a elegir' }}</h2>
            <p class="sol-section-lead" style="margin:0 auto;">{{ $page['process']['intro'] ?? 'Desde el problema hasta el producto correcto, paso a paso.' }}</p>
        </div>
        <div class="sol-steps-grid">
            <div class="sol-step">
                <div class="sol-step__num">01</div>
                <h3 class="sol-step__title">Nos describes el problema</h3>
                <p class="sol-step__text">Tipo de superficie, fotos y zona afectada. Cuanto más contexto, mejor la orientación.</p>
            </div>
            <div class="sol-step">
                <div class="sol-step__num">02</div>
                <h3 class="sol-step__title">Propuesta de productos</h3>
                <p class="sol-step__text">Te sugerimos referencias del catálogo y consumo por m² según la ficha técnica del fabricante.</p>
            </div>
            <div class="sol-step">
                <div class="sol-step__num">03</div>
                <h3 class="sol-step__title">Cotización rápida</h3>
                <p class="sol-step__text">Confirmamos disponibilidad, precio y opciones de entrega o recogida en sede.</p>
            </div>
            <div class="sol-step">
                <div class="sol-step__num">04</div>
                <h3 class="sol-step__title">Soporte durante la obra</h3>
                <p class="sol-step__text">Resolvemos dudas de aplicación, compatibilidad y orden de capas durante el proceso.</p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     7. STATS / PRUEBA SOCIAL
═══════════════════════════════════════════════ --}}
<section class="sol-section--dark" style="padding: 0;">
    <div class="container" style="padding: 0; max-width: 100%;">
        <div class="sol-stats-grid">
            <div class="sol-stat">
                <div class="sol-stat__num">+15<span>años</span></div>
                <div class="sol-stat__label">de experiencia en impermeabilización</div>
            </div>
            <div class="sol-stat">
                <div class="sol-stat__num">+500<span></span></div>
                <div class="sol-stat__label">clientes atendidos en Bogotá y Colombia</div>
            </div>
            <div class="sol-stat">
                <div class="sol-stat__num">+6<span></span></div>
                <div class="sol-stat__label">marcas líderes en nuestro catálogo</div>
            </div>
            <div class="sol-stat">
                <div class="sol-stat__num">24<span>h</span></div>
                <div class="sol-stat__label">tiempo de respuesta por WhatsApp</div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════
     8. TIPOS DE SISTEMAS
═══════════════════════════════════════════════ --}}
@if(!empty($page['solution_cards']))
<section class="sol-section sol-section--gray">
    <div class="container">
        <span class="sol-section-tag">Sistemas disponibles</span>
        <h2 class="sol-section-title">Tipos de productos que manejamos</h2>
        <p class="sol-section-lead">La elección final depende de tu tipo de cubierta, pendiente y estado actual. Estas categorías te sirven como guía para la conversación.</p>
        <div class="service-2-wpr grid-3" style="margin-top:2.5rem;">
            @foreach($page['solution_cards'] as $card)
            <div class="service-2-box">
                <div class="service-2-icon"><i class="{{ $card['icon'] }}" aria-hidden="true"></i></div>
                <div class="service-2-desc">
                    <h3>{{ $card['title'] }}</h3>
                    <p>{{ $card['body'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════════════
     9. CTA FINAL FUERTE
═══════════════════════════════════════════════ --}}
<div class="sol-cta-final">
    <div class="container position-relative" style="z-index:1;">
        <h2 class="sol-cta-final__title">¿No sabes qué producto elegir?</h2>
        <p class="sol-cta-final__text">Te ayudamos a encontrar la mejor solución según tu techo, tu problema y tu presupuesto. Sin compromiso.</p>
        <a href="{{ $whatsappAdvisoryUrl }}" class="sol-btn-cta-final" target="_blank" rel="noopener noreferrer">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Hablar por WhatsApp ahora
        </a>
    </div>
</div>

{{-- ═══════════════════════════════════════════════
     10. FAQ
═══════════════════════════════════════════════ --}}
@if(!empty($page['faqs']))
<section class="sol-faq">
    <div class="container">
        <div class="row mb-40">
            <div class="col-xl-8 offset-xl-2 text-center">
                <span class="sol-section-tag">Preguntas frecuentes</span>
                <h2 class="sol-section-title">Resolvemos tus dudas antes de comprar</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-xl-9">
                <div class="accordion" id="faq_{{ $page['key'] }}">
                    @foreach($page['faqs'] as $index => $faq)
                        @php $i = $index + 1; $show = $index === 0; @endphp
                        <div class="accordion-item">
                            <h3 class="accordion-header" id="faq_{{ $page['key'] }}-h{{ $i }}">
                                <button class="accordion-button{{ $show ? '' : ' collapsed' }}" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#faq_{{ $page['key'] }}-c{{ $i }}"
                                        aria-expanded="{{ $show ? 'true' : 'false' }}"
                                        aria-controls="faq_{{ $page['key'] }}-c{{ $i }}">
                                    {{ $faq['q'] }}
                                </button>
                            </h3>
                            <div id="faq_{{ $page['key'] }}-c{{ $i }}"
                                 class="accordion-collapse collapse{{ $show ? ' show' : '' }}"
                                 aria-labelledby="faq_{{ $page['key'] }}-h{{ $i }}"
                                 data-bs-parent="#faq_{{ $page['key'] }}">
                                <div class="accordion-body">{!! nl2br(e($faq['a'])) !!}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@include('web.components.contact-info-strip')

{{-- ═══════════════════════════════════════════════
     BOTÓN FLOTANTE DE WHATSAPP
═══════════════════════════════════════════════ --}}
<a href="{{ $whatsappAdvisoryUrl }}"
   class="sol-float-wa"
   target="_blank"
   rel="noopener noreferrer"
   aria-label="Asesoría por WhatsApp">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
    <span>Asesoría por WhatsApp</span>
</a>

@endsection
