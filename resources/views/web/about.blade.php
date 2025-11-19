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
										<img src="{{ asset('assets/img/about/logimper.png    ') }}" alt="Equipo IMPEERCOL trabajando en proyectos de impermeabilización" loading="lazy">
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
									<img src="{{ asset('assets/img/about/bod.jpg') }}" alt="Proyecto de impermeabilización IMPEERCOL en Bogotá" loading="lazy">
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
								<img src="{{ asset('assets/img/gallery/centro-general.png') }}" alt="Contacto IMPEERCOL - Servicios de impermeabilización en Bogotá" loading="lazy">
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
	<div class="review-area about-page pos-rel bg-overlay de-padding hero-bg" style="background-image: url({{ asset('assets/img/gallery/centro-general.png') }}); background-attachment: fixed; background-size: cover; background-position: center;">
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

	{{-- Nuestras Sedes --}}
	<!-- Start Our Locations
	============================================= -->
	<div class="about-2-area de-padding">
		<div class="container">
			<div class="row">
				<div class="col-xl-8 offset-xl-2">
					<div class="site-title text-center wow fadeInUp" data-wow-delay=".1s">
						<h4 class="hero-sub-title mb-0">NUESTRAS SEDES</h4>
						<h2 class="hero-title mb-30">Conoce Nuestras Oficinas</h2>
						<div class="title-line"></div>
						<p class="mb-0 mt-40">
							Contamos con dos sedes estratégicamente ubicadas en Bogotá para brindarte un mejor servicio y atención personalizada.
						</p>
					</div>
				</div>
			</div>
			<div class="row mt-60">
				<div class="col-xl-6 col-lg-6 mb-40">
					<a href="https://www.google.com/maps?q=Cra.%2016%20%23%2012-09,%20Bogot%C3%A1,%20Colombia" target="_blank" rel="noopener noreferrer" class="sede-card-link">
						<div class="sede-card wow fadeInLeft" data-wow-delay=".2s">
							<div class="sede-image">
								<img src="{{ asset('assets/img/gallery/sede-centro.jpg') }}" alt="Sede Centro - IMPEERCOL Bogotá" loading="lazy">
							</div>
							<div class="sede-info">
								<h4 class="sede-title">Sede Centro</h4>
								<div class="sede-details">
									<div class="sede-detail-item">
										<i class="icofont-location-pin"></i>
										<span>Cra. 16 # 12–09, Bogotá, Colombia</span>
									</div>
									<div class="sede-detail-item">
										<i class="icofont-ui-call"></i>
										<a href="tel:+573025069825" onclick="event.stopPropagation();">302 5069825</a>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="col-xl-6 col-lg-6 mb-40">
					<a href="https://www.google.com/maps?q=Cra%2020%20%2368-15,%20Siete%20de%20Agosto,%20Bogot%C3%A1" target="_blank" rel="noopener noreferrer" class="sede-card-link">
						<div class="sede-card wow fadeInRight" data-wow-delay=".3s">
							<div class="sede-image">
								<img src="{{ asset('assets/img/gallery/sede-siete-de-agosto.jpg') }}" alt="Sede Siete de Agosto - IMPEERCOL Bogotá" loading="lazy">
							</div>
							<div class="sede-info">
								<h4 class="sede-title">Sede Siete de Agosto</h4>
								<div class="sede-details">
									<div class="sede-detail-item">
										<i class="icofont-location-pin"></i>
										<span>Cra 20 # 68 - 15, Siete de Agosto, Bogotá</span>
									</div>
									<div class="sede-detail-item">
										<i class="icofont-ui-call"></i>
										<a href="tel:+573237313633" onclick="event.stopPropagation();">323 7313633</a>
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	<!-- End Our Locations -->

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
                @php
                    $sikaIndustryId = $brandsMap['sika'] ?? null;
                @endphp
                <a href="{{ $sikaIndustryId ? route('web.products', ['brand' => $sikaIndustryId]) : route('web.products') }}" aria-label="Sika Industry" class="wow fadeInUp sika-industry-logo" data-wow-delay=".55s" style="cursor: pointer;">
                    <img src="{{ asset('assets/img/gallery/sikaind.png') }}" alt="Sika Industry">
                </a>

			</div>
		</div>
	</div>
	<!-- End IMPEERCOL Brands Section -->

	{{-- Información de Contacto --}}
	@include('web.components.contact-info-strip')
@endsection

@section('styles')
<style>
	/* Estilos para las tarjetas de sedes */
	.sede-card-link {
		text-decoration: none;
		color: inherit;
		display: block;
		cursor: pointer;
	}

	.sede-card-link:hover {
		text-decoration: none;
		color: inherit;
	}

	.sede-card {
		background: #fff;
		border-radius: 12px;
		overflow: hidden;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
		transition: all 0.3s ease;
		height: 100%;
		display: flex;
		flex-direction: column;
	}

	.sede-card:hover {
		transform: translateY(-5px);
		box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
	}

	.sede-image {
		width: 100%;
		height: 400px;
		overflow: hidden;
		position: relative;
	}

	.sede-image img {
		width: 100%;
		height: 100%;
		object-fit: cover;
		transition: transform 0.3s ease;
	}

	.sede-card:hover .sede-image img {
		transform: scale(1.05);
	}

	.sede-info {
		padding: 2.5rem;
		background: #fff;
	}

	.sede-title {
		font-size: 2.2rem;
		font-weight: 700;
		color: #1a1a1a;
		margin-bottom: 2rem;
		position: relative;
		padding-bottom: 1rem;
	}

	.sede-title::after {
		content: '';
		position: absolute;
		bottom: 0;
		left: 0;
		width: 60px;
		height: 3px;
		background: var(--clr-def, #e63946);
		border-radius: 2px;
	}

	.sede-details {
		display: flex;
		flex-direction: column;
		gap: 1.5rem;
	}

	.sede-detail-item {
		display: flex;
		align-items: flex-start;
		gap: 1.2rem;
		color: #555;
		font-size: 1.5rem;
		line-height: 1.6;
	}

	.sede-detail-item i {
		color: var(--clr-def, #e63946);
		font-size: 2rem;
		margin-top: 0.2rem;
		flex-shrink: 0;
	}

	.sede-detail-item span {
		color: #555;
	}

	.sede-detail-item a {
		color: #1a1a1a;
		text-decoration: none;
		font-weight: 600;
		transition: color 0.3s ease;
	}

	.sede-detail-item a:hover {
		color: var(--clr-def, #e63946);
	}

	/* Responsive */
	@media (max-width: 768px) {
		.sede-image {
			height: 300px;
		}

		.sede-info {
			padding: 2rem;
		}

		.sede-title {
			font-size: 1.8rem;
		}
	}

	/* Estilos para el logo de Sika Industry - mismo tamaño que el logo de Sika normal */
	.partner-sldr-2 .sika-industry-logo {
		display: flex;
		align-items: center;
		justify-content: center;
		padding: 15px;
	}
	
	.partner-sldr-2 .sika-industry-logo img {
		max-height: 120px !important;
		max-width: 200px !important;
		width: auto !important;
		height: auto !important;
		object-fit: contain;
		filter: grayscale(100%);
		opacity: .85;
		transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
		transform: scale(1);
	}
	
	.partner-sldr-2 .sika-industry-logo:hover img {
		filter: grayscale(0%);
		opacity: 1;
		transform: scale(1.08) translateY(-5px);
		box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
	}
</style>
@endsection

