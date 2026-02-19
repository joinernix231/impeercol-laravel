{{--
    ============================================
    COMPONENTE: HEAD
    ============================================

    PROPÓSITO:
    Este componente contiene toda la sección <head> del HTML, incluyendo:
    - Meta tags (charset, viewport, description)
    - Título de la página
    - Enlaces a hojas de estilo CSS
    - Favicon

    CÓMO FUNCIONA:
    Este archivo se incluye en el layout principal (main.blade.php) usando @include.
    Todas las rutas de assets se convierten usando {{ asset() }} para que Laravel
    pueda gestionarlas correctamente.

    QUÉ REEMPLAZA:
    Reemplaza las líneas 4-29 del archivo index.html original de la plantilla.

    INSTRUCCIONES PARA DESARROLLADORES:
    1. Para cambiar el título de la página, modifica la variable $title en cada vista
       usando @section('title', 'Nuevo Título')
    2. Para agregar CSS adicional, usa @section('styles') en la vista
    3. Los assets están en public/assets/
--}}

<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>@yield('title', 'IMPEERCOL')</title>
<meta name="description" content="@yield('description', 'IMPEERCOL es tu aliado en impermeabilización en Bogotá. Más de 15 años de experiencia ofreciendo productos de alta calidad de las mejores marcas como Sika, Texsa, Metic y más. Asesoría técnica especializada, distribución nacional y soluciones duraderas para techos, muros y cubiertas.')">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

{{-- Meta Tags Adicionales para SEO --}}
<meta name="author" content="IMPEERCOL">
<meta name="language" content="es">
<meta name="geo.region" content="CO-CUN">
<meta name="geo.placename" content="Bogotá">
<meta name="geo.position" content="4.6097;-74.0817">
<meta name="ICBM" content="4.6097, -74.0817">
<meta name="theme-color" content="#1a1a1a">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="apple-mobile-web-app-title" content="IMPEERCOL">
<meta name="format-detection" content="telephone=yes">
<meta name="mobile-web-app-capable" content="yes">
<meta name="msapplication-TileColor" content="#1a1a1a">
<meta name="msapplication-config" content="{{ asset('browserconfig.xml') }}">

{{-- Preconnect para mejorar rendimiento --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="dns-prefetch" href="https://www.google.com">
<link rel="dns-prefetch" href="https://www.google-analytics.com">

{{-- Meta Robots --}}
@php
    $robotsContent = view()->hasSection('robots') ? view()->yieldContent('robots') : 'index, follow';
    $robots = \App\Helpers\SeoHelper::robotsMeta($robotsContent);
@endphp
<meta name="robots" content="{{ $robots }}">

{{-- Etiqueta Canonical para SEO --}}
{{-- Ignora ?page=1 pero mantiene ?page=2+ y otros parámetros de query string --}}
<link rel="canonical" href="{{ \App\Helpers\SeoHelper::canonicalUrl() }}">

{{-- Open Graph Meta Tags (Facebook, LinkedIn, etc.) --}}
@php
    $ogTitle = view()->hasSection('title') ? view()->yieldContent('title') : 'IMPEERCOL';
    $ogDescription = view()->hasSection('description') ? view()->yieldContent('description') : 'IMPEERCOL es tu aliado en impermeabilización en Bogotá. Más de 15 años de experiencia ofreciendo productos de alta calidad de las mejores marcas como Sika, Texsa, Metic y más.';
    $ogImage = view()->hasSection('og_image') ? view()->yieldContent('og_image') : null;
    $ogType = view()->hasSection('og_type') ? view()->yieldContent('og_type') : 'website';
    $ogTags = \App\Helpers\SeoHelper::openGraphTags($ogTitle, $ogDescription, $ogImage, $ogType);
@endphp
@foreach($ogTags as $property => $content)
    <meta property="{{ $property }}" content="{{ $content }}">
@endforeach

{{-- Twitter Card Meta Tags --}}
@php
    $twitterTitle = view()->hasSection('title') ? view()->yieldContent('title') : 'IMPEERCOL';
    $twitterDescription = view()->hasSection('description') ? view()->yieldContent('description') : 'IMPEERCOL es tu aliado en impermeabilización en Bogotá. Más de 15 años de experiencia ofreciendo productos de alta calidad.';
    $twitterImage = view()->hasSection('twitter_image') ? view()->yieldContent('twitter_image') : $ogImage;
    $twitterCardType = view()->hasSection('twitter_card') ? view()->yieldContent('twitter_card') : 'summary_large_image';
    $twitterTags = \App\Helpers\SeoHelper::twitterCardTags($twitterTitle, $twitterDescription, $twitterImage, $twitterCardType);
@endphp
@foreach($twitterTags as $name => $content)
    <meta name="{{ $name }}" content="{{ $content }}">
@endforeach

<!-- Favicons -->
<link rel="icon" href="{{ asset('favicon.ico') }}" sizes="any">
<link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicon.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/apple-touch-icon.png') }}">
<link rel="manifest" href="{{ asset('site.webmanifest') }}">

{{-- Meta Tags de Verificación (agregar cuando tengas los códigos) --}}
{{-- <meta name="google-site-verification" content="TU_CODIGO_DE_VERIFICACION"> --}}
{{-- <meta name="msvalidate.01" content="TU_CODIGO_DE_VERIFICACION_BING"> --}}
{{-- <meta name="yandex-verification" content="TU_CODIGO_DE_VERIFICACION_YANDEX"> --}}


<!-- ========== Start Stylesheet ========== -->
<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/owl.theme.default.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/themify-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/icofont.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/site-flaticon.css') }}" rel="stylesheet">
<link href="{{ asset('assets/style.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/carousel-arrows-fix.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/common.css') }}" rel="stylesheet">
<!-- ========== End Stylesheet ========== -->

{{-- Sección para agregar estilos adicionales desde las vistas --}}
@yield('styles')

