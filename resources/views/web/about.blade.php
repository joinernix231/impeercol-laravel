{{-- 
    ============================================
    VISTA: ABOUT (Sobre Nosotros)
    ============================================
    
    PROPÓSITO:
    Página que muestra información sobre la empresa IMPEERCOL, incluyendo:
    - Historia y valores
    - Misión y Visión
    - Marcas con las que trabajan
    
    QUÉ REEMPLAZA:
    Reemplaza el contenido principal del archivo about.html original.
--}}

@extends('layouts.main')

@section('title', 'Sobre Nosotros - IMPEERCOL')

@section('content')
	{{-- Breadcrumb --}}
	<!-- Start Breadcrumb
	============================================= -->
	<div class="site-breadcrumb" style="background: url({{ asset('assets/img/gallery/IMG_2798-convertido-de-jpg.webp') }})">
		<div class="container">
			<h2 class="breadcrumb-title">Sobre Nosotros</h2>
			<ul class="breadcrumb-menu clearfix">
				<li><a href="{{ route('web.home') }}">Inicio</a></li>
				<li class="active">Sobre Nosotros</li>
			</ul>
		</div>
	</div>
	<!-- End Breadcrumb -->
	
	{{-- Sección Principal Sobre Nosotros --}}
	<!-- Start About
	============================================= -->
	<div class="about-2-area de-padding">
		<div class="container">
			<div class="about-2-wpr grid-2">
				<div class="about-2-left">
					<div class="about-2-header">
						<span class="hero-sub-title">Sobre Nosotros</span>
						<h2 class="hero-title mb-0">¿Quiénes Somos?</h2>
					</div>
					<p class="about-2-txt mb-20">
						En IMPEERCOL llevamos más de 15 años protegiendo los espacios de los colombianos con impermeabilizantes de alta calidad. Ofrecemos soluciones duraderas para techos, muros y cubiertas, garantizando resultados visibles y protección total contra la humedad.
					</p>
					<p class="about-2-txt">
						Nos mueve la asesoría honesta y el acompañamiento técnico. Te guiamos para elegir el producto ideal según tu necesidad, y contamos con distribución a nivel nacional para que recibas tu pedido a tiempo.
					</p>
					<div class="about-2-mgn mt-40">
						<ul class="colmn-2">
							<li class="wow fadeInUp" data-wow-delay=".05s">
								<i class="icofont-long-arrow-right"></i>
								Marcas reconocidas
							</li>
							<li class="wow fadeInUp" data-wow-delay=".1s">
								<i class="icofont-long-arrow-right"></i>
								Asesoría técnica
							</li>
							<li class="wow fadeInUp" data-wow-delay=".15s">
								<i class="icofont-long-arrow-right"></i>
								Distribución nacional
							</li>
							<li class="wow fadeInUp" data-wow-delay=".2s">
								<i class="icofont-long-arrow-right"></i>
								15+ años de experiencia
							</li>
						</ul>
					</div>
					<div class="about-2-btn mt-30">
						<div class="button-container-3">
							<span class="mas">Contáctanos</span>
							<a href="{{ route('web.contact') }}" class="site-btn-3">Contáctanos</a>
						</div>
					</div>
				</div>
				<div class="about-2-right">
					<div class="about-2-content">
						<div class="about-right-2-header">
							<div class="row g-5">
								<div class="col-xl-3">
									<div class="about-right-2-pic">
										<img src="{{ asset('assets/img/gallery/impe-convertido-de-jpg.webp') }}" alt="Equipo IMPEERCOL trabajando en proyectos de impermeabilización" loading="lazy">
									</div>
								</div>
								<div class="col-xl-9">
									<div class="about-right-2-desc">
										<ul>
											<li class="d-flex align-items-center">
												<i aria-hidden="true" class="fas fa-check"></i>
												Productos de alta calidad y respaldo técnico
											</li>
											<li class="d-flex align-items-center">
												<i aria-hidden="true" class="fas fa-check"></i>
												Acompañamiento para elegir el sistema ideal
											</li>
											<li class="d-flex align-items-center">
												<i aria-hidden="true" class="fas fa-check"></i>
												Logística y entregas a nivel nacional
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="about-2-bottom-content grid-2">
							<div class="about-2-bottom-left wow fadeInLeft" data-wow-delay=".1s">
								<div class="about-2-bottom-pic">
									<img src="{{ asset('assets/img/gallery/sobre2-convertido-de-jpg.webp') }}" alt="Proyecto de impermeabilización IMPEERCOL en Bogotá" loading="lazy">
								</div>
								<div class="about-2-bottom-call">
									<i class="icofont-ui-call"></i>
									<div class="about-2-bottom-call-content">
										<h4>Llámanos</h4>
										<span>
											<a href="tel:+573025069825">Centro: 302 5069825</a><br>
											<a href="tel:+573237313633">7 de Agosto: 323 7313633</a>
										</span>
									</div>
								</div>
							</div>
							<div class="about-2-bottom-right wow fadeInRight" data-wow-delay=".2s">
								<div class="about-2-opt">
									<div class="about-opt-single">
										<div class="about-2-opt-icon">
											<span class="about-2-tt">15+</span>
										</div>
										<div class="about-2-opt-desc">
											<h5 class="mb-0">Años de Experiencia</h5>
										</div>
									</div>
								</div>
								<img src="{{ asset('assets/img/gallery/contactanos-convertido-de-jpg.webp') }}" alt="Contacto IMPEERCOL - Servicios de impermeabilización en Bogotá" loading="lazy">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End About -->
	
	{{-- Misión y Visión --}}
	<!-- Start Mission & Vision
	============================================= -->
	<div class="review-area about-page pos-rel bg-overlay de-padding hero-bg" style="background-image: url({{ asset('assets/img/bg/action-bg.png') }})">
		<div class="review-shape">
			<img src="{{ asset('assets/img/bg/bg-1.png') }}" alt="Fondo decorativo IMPEERCOL">
		</div>
		<div class="container">
			<div class="row">
				<div class="col-xl-6 offset-xl-3">
					<div class="site-title wh text-center wow fadeInUp" data-wow-delay=".1s">
						<h2>Misión y Visión</h2>
						<p class="mb-0">
							Los principios que guían nuestro trabajo y las metas que nos impulsan hacia el futuro.
						</p>
					</div>
				</div>
			</div>
			<div class="review-wpr grid-2 mt-60">
				<div class="review-box wow fadeInLeft" data-wow-delay=".2s">
					<div class="review-pic">
						<div class="review-icon-box">
							<i class="icofont-bullseye" style="font-size: 6rem; color: var(--clr-def);"></i>
						</div>
						<div class="review-bio">
							<h4>Nuestra Misión</h4>
							<span>Compromiso con la calidad</span>
						</div>
					</div>
					<div class="review-content">
						<div class="review-quote">
							<blockquote>
								Proteger los espacios de los colombianos con impermeabilizantes de alta calidad, ofreciendo soluciones duraderas y asesoría técnica especializada para cada proyecto.
							</blockquote>
							<img src="{{ asset('assets/img/single/single-qoute.png') }}" class="quote-icon" alt="Icono de comillas IMPEERCOL">
						</div>
					</div>
				</div>
				<div class="review-box wow fadeInRight" data-wow-delay=".3s">
					<div class="review-pic">
						<div class="review-icon-box">
							<i class="icofont-eye-alt" style="font-size: 6rem; color: var(--clr-def);"></i>
						</div>
						<div class="review-bio">
							<h4>Nuestra Visión</h4>
							<span>Proyección hacia el futuro</span>
						</div>
					</div>
					<div class="review-content">
						<div class="review-quote">
							<blockquote>
								Ser el referente nacional en impermeabilización, reconocidos por nuestra excelencia e innovación, consolidándonos como el aliado estratégico del sector construcción.
							</blockquote>
							<img src="{{ asset('assets/img/single/single-qoute.png') }}" class="quote-icon" alt="Icono de comillas IMPEERCOL">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Mission & Vision -->
	
	{{-- Marcas --}}
	<!-- Start IMPEERCOL Brands Section
	============================================= -->
	<div class="brands-area de-padding">
		<div class="container">
			<div class="row">
				<div class="col-xl-8 offset-xl-2">
					<div class="site-title text-center wow fadeInUp" data-wow-delay=".1s">
						<h4 class="hero-sub-title mb-0">NUESTRAS MARCAS</h4>
						<h2 class="hero-title mb-30">Marcas de Confianza</h2>
						<div class="title-line"></div>
						<p class="mb-0 mt-40">
							En IMPEERCOL trabajamos con las mejores marcas del mercado de impermeabilización. Cada producto que ofrecemos ha sido seleccionado por su calidad, durabilidad y resultados comprobados. Confía en nosotros para proteger tus espacios con soluciones de las marcas líderes en el sector.
						</p>
					</div>
				</div>
			</div>
			<div class="partner-pic partner-sldr-2 owl-carousel owl-theme carousel mt-60">
				<a href="{{ route('web.products') }}" aria-label="Ver todos los productos" class="wow fadeInUp" data-wow-delay=".2s" style="cursor: pointer;">
					<img src="{{ asset('assets/img/gallery/logo-mobile-convertido-de-png.webp') }}" alt="Logo Mobile">
				</a>
				@php
					$sikaId = $brandsMap['sika'] ?? null;
				@endphp
				<a href="{{ $sikaId ? route('web.products', ['brand' => $sikaId]) : route('web.products') }}" aria-label="Sika" class="wow fadeInUp" data-wow-delay=".25s" style="cursor: pointer;">
					<img src="{{ asset('assets/img/gallery/Sika_NoClaim_pos_rgb_mobile-convertido-de-webp.webp') }}" alt="Sika">
				</a>
				@php
					$texsaId = $brandsMap['texsa'] ?? null;
				@endphp
				<a href="{{ $texsaId ? route('web.products', ['brand' => $texsaId]) : route('web.products') }}" aria-label="Texsa" class="wow fadeInUp" data-wow-delay=".3s" style="cursor: pointer;">
					<img src="{{ asset('assets/img/gallery/Logo-Texsa-Original.png-convertido-de-webp.webp') }}" alt="Texsa">
				</a>
				@php
					$meticId = $brandsMap['metic'] ?? null;
				@endphp
				<a href="{{ $meticId ? route('web.products', ['brand' => $meticId]) : route('web.products') }}" aria-label="Metic" class="wow fadeInUp" data-wow-delay=".35s" style="cursor: pointer;">
					<img src="{{ asset('assets/img/gallery/Metic (1).webp') }}" alt="Metic">
				</a>
				@php
					$fiberglassId = $brandsMap['fiberglass'] ?? $brandsMap['fiverglass'] ?? null;
				@endphp
				<a href="{{ $fiberglassId ? route('web.products', ['brand' => $fiberglassId]) : route('web.products') }}" aria-label="FiberGlass" class="wow fadeInUp" data-wow-delay=".4s" style="cursor: pointer;">
					<img src="{{ asset('assets/img/gallery/FiverGlass-convertido-de-webp.webp') }}" alt="FiberGlass">
				</a>
				@php
					$kaudalId = $brandsMap['kaudal'] ?? null;
				@endphp
				<a href="{{ $kaudalId ? route('web.products', ['brand' => $kaudalId]) : route('web.products') }}" aria-label="Kaudal" class="wow fadeInUp" data-wow-delay=".45s" style="cursor: pointer;">
					<img src="{{ asset('assets/img/gallery/Kaudal-convertido-de-webp.webp') }}" alt="Kaudal">
				</a>
				@php
					$tekbondId = $brandsMap['tekbond'] ?? null;
				@endphp
				<a href="{{ $tekbondId ? route('web.products', ['brand' => $tekbondId]) : route('web.products') }}" aria-label="Tekbond" class="wow fadeInUp" data-wow-delay=".5s" style="cursor: pointer;">
					<img src="{{ asset('assets/img/gallery/tekbond-logo-convertido-de-webp.webp') }}" alt="Tekbond">
				</a>
			</div>
		</div>
	</div>
	<!-- End IMPEERCOL Brands Section -->
	
	{{-- Información de Contacto --}}
	<!-- Contact Info Boxes -->
	<div class="contact-info-strip">
		<div class="container">
			<div class="info-strip">
				<div class="info-card wow animated fadeInUp" data-wow-delay=".1s" style="animation-delay:.1s">
					<div class="info-icon"><i class="icofont-clock-time"></i></div>
					<div class="info-text">
						<div class="info-top">Lun - Sab 8 am–6 pm</div>
						<div class="info-bold">Lun - Sab: 8 am - 6 pm</div>
					</div>
				</div>
				<div class="info-card wow animated fadeInUp" data-wow-delay=".2s" style="animation-delay:.2s">
					<div class="info-icon"><i class="icofont-email"></i></div>
					<div class="info-text">
						<div class="info-top">E-mail</div>
						<div class="info-bold">info@impeercol.com</div>
					</div>
				</div>
				<div class="info-card wow animated fadeInUp" data-wow-delay=".3s" style="animation-delay:.3s">
					<div class="info-icon"><i class="icofont-google-map"></i></div>
					<div class="info-text">
						<div class="info-top">Cra. 16 # 12–09</div>
						<div class="info-bold">Bogotá, Colombia</div>
					</div>
				</div>
				<div class="info-card wow animated fadeInUp" data-wow-delay=".4s" style="animation-delay:.4s">
					<div class="info-icon"><i class="icofont-google-map"></i></div>
					<div class="info-text">
						<div class="info-top">Cra 20 # 68 - 15</div>
						<div class="info-bold">Siete de Agosto, Bogotá</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

