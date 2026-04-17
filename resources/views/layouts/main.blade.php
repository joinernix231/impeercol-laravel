{{--
    ============================================
    LAYOUT PRINCIPAL: MAIN.BLADE.PHP
    ============================================

    PROPÓSITO:
    Este es el layout base de toda la aplicación web. Define la estructura HTML
    principal y organiza los componentes reutilizables (head, navbar, footer, scripts).

    CÓMO FUNCIONA:
    1. Define la estructura HTML básica (<!DOCTYPE>, <html>, <body>)
    2. Incluye el componente head usando @include
    3. Incluye el preloader (animación de carga)
    4. Incluye el navbar usando @include
    5. Define la sección @yield('content') donde cada vista insertará su contenido único
    6. Incluye el footer usando @include
    7. Incluye los scripts usando @include

    QUÉ REEMPLAZA:
    Reemplaza la estructura completa del archivo index.html original, pero de forma modular.

    INSTRUCCIONES PARA DESARROLLADORES:
    1. Para crear una nueva vista, extiende este layout usando: @extends('layouts.main')
    2. Define el contenido único de la vista dentro de @section('content') ... @endsection
    3. Opcionalmente puedes definir @section('title') para cambiar el título de la página
    4. Opcionalmente puedes definir @section('styles') para agregar CSS adicional
    5. Opcionalmente puedes definir @section('scripts') para agregar JavaScript adicional

    EJEMPLO DE USO:
    @extends('layouts.main')

    @section('title', 'Página de Inicio')

    @section('content')
        <h1>Mi contenido aquí</h1>
    @endsection
--}}

<!doctype html>
<html class="no-js" lang="es">
<head>
	{{-- Incluye el componente head con todos los meta tags y estilos --}}
	@include('web.components.head')
</head>

<body id="bdy">
	{{-- Preloader: Animación de carga al inicio --}}
	<!-- Start PreLoader
	============================================= -->
	@if(request()->routeIs('web.home'))
		<div class="preloader">
			<div class="preloader-container">
				<div class="preloader-animation">
				</div>
			</div>
		</div>
	@endif
	<!-- End PreLoader-->

	{{-- Incluye la barra de navegación --}}
	@include('web.components.navbar')

	{{-- Contenedor principal: Aquí cada vista insertará su contenido único --}}
	<main class="main">
		@yield('content')
	</main>

	<div class="clearfix"></div>

	{{-- Incluye el pie de página --}}
	@include('web.components.footer')

	{{-- Incluye todos los scripts JavaScript --}}
	@include('web.components.scripts')
</body>
</html>

