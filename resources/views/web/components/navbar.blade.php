{{-- 
    ============================================
    COMPONENTE: NAVBAR (Barra de Navegación)
    ============================================
    
    PROPÓSITO:
    Este componente contiene la barra de navegación principal del sitio web,
    incluyendo el logo, menú de navegación y búsqueda.
    
    CÓMO FUNCIONA:
    Este archivo se incluye en el layout principal (main.blade.php) usando @include.
    Las rutas de navegación usan las rutas nombradas de Laravel (route('web.home')).
    Los assets (imágenes) se convierten usando {{ asset() }}.
    
    QUÉ REEMPLAZA:
    Reemplaza las líneas 43-135 del archivo index.html original (header completo).
    
    INSTRUCCIONES PARA DESARROLLADORES:
    1. Para agregar un nuevo enlace al menú, agrega un <li> dentro de <ul class="navbar-nav ms-auto">
    2. Usa route('web.nombre_ruta') para generar las URLs de forma segura
    3. El logo cambia automáticamente cuando se hace scroll (logo-display vs logo-scrolled)
    4. El carrito de compras está comentado, se puede activar más adelante si es necesario
--}}

<!-- Start header
============================================= -->
<header class="header header-2">
	<div class="main-navigation">
		<nav id="navbar_top" class="navbar navbar-expand-lg">
			<div class="container g-0">
				{{-- Logo de IMPEERCOL --}}
				<a class="navbar-brand" href="{{ route('web.home') }}">
					<img src="{{ asset('assets/img/logo/logo-white.png') }}" class="logo-display" alt="IMPEERCOL Logo">
					<img src="{{ asset('assets/img/logo/logo.png') }}" class="logo-scrolled" alt="IMPEERCOL Logo">
				</a>
				
				{{-- Botón del menú móvil --}}
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"><i class="ti-menu-alt"></i></span>
				</button>
				
				{{-- Menú de navegación --}}
				<div class="collapse navbar-collapse" id="main_nav">
					<ul class="navbar-nav ms-auto">
						<li class="nav-item">
							<a class="nav-link" href="{{ route('web.home') }}">Inicio</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('web.about') }}">Sobre nosotros</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('web.services') }}">Servicios</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('web.products') }}">Productos</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('web.blog') }}">Blog</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{ route('web.contact') }}">Contacto</a>
						</li>
					</ul>
				</div>
				<!-- navbar-collapse.// -->
				
				{{-- Búsqueda y carrito (carrito comentado por ahora) --}}
				<div class="search-cart">
					<ul class="cart-li">
						{{-- Carrito de compras - Comentado por ahora, se puede activar más adelante
						<li>
							<div class="site-cart">
								<input type="checkbox" class="site-checkbox-cart" id="site-checkbox-cart">
								<label for="site-checkbox-cart" class="site-cart-label">
									<i class="icofont-shopping-cart"></i>
								</label>
								<div class="site-cart-list">
									<ul>
										<li>
											<div class="site-cart-up">
												<div class="site-cart-pic">
													<img src="{{ asset('assets/img/single/cart-pic.jpg') }}" alt="Carrito de compras IMPEERCOL">
												</div>
												<div class="site-cart-desc">
													<h6>Lampost Frame Loft</h6>
													<span>1 × $299.00</span>
												</div>
											</div>
										</li>
									</ul>
									<div class="site-cart-bottom text-center">
										<div class="sub-total">
											<span>Subtotal: $499.00</span>
										</div>
										<div class="site-cart-button">
											<a href="#" class="button-btns">View Cart</a>
											<a href="#" class="button-btns">Checkout</a>
										</div>
									</div>
								</div>
							</div>
						</li>
						--}}
						
						{{-- Búsqueda --}}
						<li>
							<div class="site-search">
								<input type="checkbox" class="site-input-checkbox" id="site-input-checkbox">
								<label for="site-input-checkbox" class="site-input-label">
									<i class="icofont-search"></i>
									<span class="site-close">
										<i class="icofont-close"></i>
									</span>
								</label>
								<div class="navigation__background">&nbsp;</div>
								<div class="site-search-content">
									<form method="GET" action="{{ route('web.products') }}">
										<input type="text" 
											   name="search" 
											   placeholder="Buscar productos..." 
											   class="input-style-3"
											   value="{{ request('search') }}"
											   autocomplete="off">
										<button type="submit">Buscar</button>
									</form>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div> <!-- container -->
		</nav>
	</div>
</header>
<!-- End header -->

