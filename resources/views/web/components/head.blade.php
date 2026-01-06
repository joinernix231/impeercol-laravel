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

<!-- Place favicon.ico in the root directory -->
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
<!-- Apple Touch Icon -->
<link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/apple-touch-icon.png') }}">

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

