{{-- 
    ============================================
    VISTA: HOME (Página de Inicio)
    ============================================
    
    PROPÓSITO:
    Esta es la página principal del sitio web. Muestra:
    - Slider principal con imágenes y mensajes
    - Sección "Sobre Nosotros"
    - Galería de trabajos/proyectos
    - Sección "Cómo Trabajamos"
    - Formulario de contacto
    - Blog reciente
    - Marcas de confianza
    
    CÓMO FUNCIONA:
    Extiende el layout principal (layouts.main) y define el contenido único
    dentro de @section('content'). Todas las rutas de assets se convierten usando {{ asset() }}.
    
    QUÉ REEMPLAZA:
    Reemplaza el contenido principal del archivo index.html original (líneas 138-726).
    
    INSTRUCCIONES PARA DESARROLLADORES:
    1. Para modificar el slider, edita la sección "hero-section"
    2. Para cambiar el contenido de "Sobre Nosotros", modifica la sección "about-area"
    3. Los enlaces a otras páginas usan route('web.nombre_ruta')
    4. Las imágenes deben estar en public/assets/
--}}

@extends('layouts.main')

@section('title', 'IMPEERCOL - Expertos en Impermeabilización en Bogotá')

@php
    use Illuminate\Support\Str;
@endphp

@section('content')
	{{-- Slider Principal --}}
	<!-- Start Slider
	============================================= -->
	<div class="hero-section pos-rel">
		<div class="hero-section-content hero-sldr owl-carousel owl-theme">
			<div class="hero-2-single hero-overlay hero-bg" style="background-image: url({{ asset('assets/img/gallery/BO-convertido-de-jpg.webp') }})">
				<div class="container g-0">
					<div class="row">
						<div class="col-xl-8 offset-xl-2">
							<div class="hero-2-content text-center">
								<h2 class="hero-title">
									Productos que duran, resultados que se notan.
								</h2>
								<p>
									Ofrecemos calidad, respaldo y asesoría para que cada compra sea una inversión duradera.
								</p>
								<div class="hero-btn d-flex justify-content-center">
									<div class="button-container-1">
										<span class="mas">Contáctanos</span>
										<a href="#contact" class="site-btn-1 smooth-menu">Contáctanos</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="hero-2-single hero-overlay hero-bg" style="background-image: url({{ asset('assets/img/gallery/Bogata-convertido-de-jpg.webp') }})">
				<div class="container g-0">
					<div class="row">
						<div class="col-xl-8 offset-xl-2">
							<div class="hero-2-content text-center">
								<h2 class="hero-title">
									Impermeabiliza, protege y conserva
								</h2>
								<p>
									Todo lo que necesitas para mantener tus espacios en perfectas condiciones.
								</p>
								<div class="hero-btn d-flex justify-content-center">
									<div class="button-container-2">
										<span class="mas">Contáctanos</span>
										<a href="#contact" class="site-btn-2 smooth-menu">Contáctanos</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Slider -->
	
	{{-- Sección Sobre Nosotros --}}
	<!-- Start About
	============================================= -->
	<div class="about-area de-padding">
		<div class="container">
			<div class="about-wrap">
				<div class="row">
					<div class="col-xl-5">
						<div class="about-left">
							<div class="about-left-content">
								<div class="about-photo pos-rel">
									<span class="about-dotted"></span>
									<img src="{{ asset('assets/img/gallery/inicio-convertido-de-jpg.webp') }}" class="about-main-pic" alt="IMPEERCOL - Expertos en impermeabilización y recubrimientos en Bogotá" loading="lazy">
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-7">
						<div class="about-right pl-60">
							<div class="about-heading mb-40">
								<h2 class="hero-title mb-30">¿Quiénes Somos?</h2>
								<p class="mb-0">
									En impeercol llevamos más de 15 años protegiendo los espacios de los colombianos con impermeabilizantes de alta calidad. Ofrecemos soluciones duraderas y confiables para techos, muros y cubiertas, garantizando resultados visibles y protección total contra la humedad. Somos tu aliado en impermeabilización, con productos fáciles de aplicar y pensados para durar.
								</p>
							</div>
							<div class="about-features">
								<div class="feature-grid">
									<div class="feature-item">
										<h4>Marcas Reconocidas</h4>
										<p>Las mejores marcas del mercado</p>
									</div>
									<div class="feature-item">
										<h4>Asesoría Técnica</h4>
										<p>Te ayudamos a elegir el producto ideal</p>
									</div>
									<div class="feature-item">
										<h4>Distribución Nacional</h4>
										<p>Envíos a toda Colombia</p>
									</div>
									<div class="feature-item">
										<h4>15+ Años</h4>
										<p>Experiencia en el sector</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End about -->
	
	{{-- Galería de Trabajos --}}
	<!-- Start Work
	============================================= -->
	<div class="work-area work-minus">
		<div class="work-wpr-content work-wpr-style hero-bg ml-300">
			<!-- Título -->
			<div class="container">
				<div class="row mb-60 align-items-center">
					<div class="col-xl-8">
						<div class="site-title mb-0">
							<h2>Nuestros Trabajos de Impermeabilización</h2>
							<p class="mb-0 work-title-para">
								Casos de éxito con sistemas impeercol: soluciones duraderas para techos, juntas
								y recubrimientos que detienen filtraciones y protegen tus estructuras.
							</p>
						</div>
					</div>
				</div>
			</div>

			<div class="work-wpr gallery-sldr owl-carousel owl-theme">
				
				@forelse($featuredProjects as $index => $project)
					@php
						$delay = '.' . ($index + 1);
					@endphp
					<div class="work-box wow fadeInUp" data-wow-delay="{{ $delay }}s">
						<div class="work-pic">
							<img src="{{ $project->image_url }}" alt="{{ $project->title }}">
							<div class="work-ovarlay">
								<div class="work-overlay-content">
									<div class="work-overlay-header">
										<h4 class="heading-5">{{ $project->title }}</h4>
										<a href="{{ route('web.project.show', $project->slug) }}" class="work-link">
											<i class="ti ti-plus"></i>
										</a>
									</div>
									<p class="work-text mb-0">
										{{ Str::limit($project->description, 100, '...') }}
									</p>
								</div>
							</div>
						</div>
					</div>
			
				@empty
					<p>No hay proyectos destacados por el momento.</p>
				@endforelse
			</div>
			
		</div>
	</div>
	<!-- End Work -->
	
	{{-- Sección Cómo Trabajamos --}}
	<!-- Start Steps
	============================================= -->
	<div class="step-area de-pt pos-rel pb-256 hero-bg" style="background-image: url({{ asset('assets/img/gallery/paquetes-convertido-de-jpg.webp') }})">
		<div class="container">
			<div class="step-wpr grid-2">
				<div class="step-left d-flex align-items-center">
					<div class="step-left-content">
						<div class="step-left-header">
							<h3 class="hero-sub-title">&nbsp;</h3>
							<h2 class="hero-title mb-0">Cómo Trabajamos</h2>
						</div>
						<p class="mb-50 step-left-para">
							En impeercol hacemos fácil y rápida la compra de impermeabilizantes. Te guiamos para elegir el producto ideal y proteger tus espacios con confianza.
						</p>
						<div class="button-container-2">
							<span class="mas">Contáctanos</span>
							<a href="#contact" class="site-btn-2 smooth-menu">Contáctanos</a>
						</div>
					</div>
				</div>
				<div class="step-right">
					<div class="step-box-wpr grid-2">
						<div class="step-box wow fadeInUp" data-wow-delay=".1s">
							<span class="step-number">01</span>
							<h4 class="heading-6">Asesoría</h4>
							<p>
								Elegimos contigo el impermeabilizante ideal para tu superficie (techo, muro, terraza).
							</p>
						</div>
						<div class="step-box wow fadeInUp" data-wow-delay=".2s">
							<span class="step-number">02</span>
							<h4 class="heading-6">Cotización</h4>
							<p class="mb-0">
								Cotización rápida y clara, con productos disponibles en nuestro catálogo.
							</p>
						</div>
						<div class="step-box wow fadeInUp" data-wow-delay=".3s">
							<span class="step-number">03</span>
							<h4 class="heading-6">Compra</h4>
							<p class="mb-0">
								Haz tu pedido; te indicamos métodos de pago y disponibilidad inmediata.
							</p>
						</div>
						<div class="step-box wow fadeInUp" data-wow-delay=".4s">
							<span class="step-number">04</span>
							<h4 class="heading-6">Entrega</h4>
							<p class="mb-0">
								Entrega rápida en Bogotá para que uses tus productos a tiempo.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Steps -->
	
	{{-- Formulario de Contacto --}}
	<!-- Start Contact
	============================================= -->
	<div id="contact" class="contact-area pos-rel de-padding">
		<div class="contact-sketch">
			<img src="{{ asset('assets/img/bg/sketch.png') }}" alt="Diseño decorativo IMPEERCOL">
		</div>
		<div class="container">
			<div class="contact-wpr grid-2">
				<div class="contact-left">
					<div class="contact-form-header mb-30">
						<h4 class="hero-sub-title mb-0">Contáctanos</h4>
						<h2 class="hero-title mb-0">¿Tienes alguna consulta?</h2>
					</div>
					<div class="addr-box">
						<div class="addr-box-single">
							<div class="addr-icon">
								<i class="icofont-google-map"></i>
							</div>
							<div class="addr-desc">
								<h4>Dirección</h4>
								<p class="mb-0">
									<a href="https://www.google.com/maps/search/?api=1&query=Cra.%2016%20%23%2012-09,%20Bogot%C3%A1,%20Colombia" target="_blank" rel="noopener noreferrer">
										Cra. 16 # 12-09<br>
										Bogotá, Colombia
									</a>
								</p>
							</div>
						</div>
						<div class="addr-box-single">
							<div class="addr-icon">
								<i class="icofont-phone"></i>
							</div>
							<div class="addr-desc">
								<h4>Teléfono</h4>
								<p class="mb-0">
									<a href="tel:+573025069825">Centro: 302 5069825</a><br>
									<a href="tel:+573237313633">7 de Agosto: 323 7313633</a>
								</p>
							</div>
						</div>
						<div class="addr-box-single">
							<div class="addr-icon">
								<i class="icofont-email"></i>
							</div>
							<div class="addr-desc">
								<h4>Correo electrónico</h4>
								<p class="mb-0">
									<a href="mailto:impeercol@gmail.com?subject=Consulta%20desde%20la%20web">impeercol@gmail.com</a>
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="contact-right contact-bg-animated">
					<form action="https://formspree.io/f/mdkpzvdd" method="post" class="contact-form" data-provider="formspree">
						<input type="hidden" name="_subject" value="Nuevo mensaje desde IMPEERCOL">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control input-style-2" id="name" name="Nombre" placeholder="Nombre completo*">
									<span class="alert alert-error"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="email" class="form-control input-style-2" id="email" name="Correo" placeholder="Correo electrónico*">
									<span class="alert alert-error"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" class="form-control input-style-2" id="phone" name="Telefono" placeholder="Número de teléfono">
									<span class="alert alert-error"></span>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" class="form-control input-style-2" id="subject" name="Asunto" placeholder="Asunto...">
									<span class="alert alert-error"></span>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<textarea class="form-control input-style-2" id="comment" name="Mensaje" placeholder="Tu mensaje..."></textarea>
								</div>
								<div class="contact-sub-btn text-center">
									<button type="submit" name="submit" id="submit" class="btn-3">
										Enviar mensaje 
										<i class="fas fa-chevron-right"></i>
									</button>
								</div>
								<!-- Alert Message -->
								<div class="alert-notification">
									<div id="message" class="alert-msg"></div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- End Contact-->
	
	{{-- Sección Blog --}}
	<!-- Start Blog
	============================================= -->
	<div class="blog-area pos-rel bg de-padding">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 offset-xl-3">
					<div class="site-title text-center">
						<h2>Últimas noticias</h2>
						<p class="mb-0">
							Noticias y artículos recientes sobre impermeabilización, productos y consejos de mantenimiento.
						</p>
					</div>
				</div>
			</div>
			<div class="blog-wpr grid-3">
				<div class="blog-box wow fadeInUp" data-wow-delay=".1s">
					<div class="blog-pic">
						<img src="{{ asset('assets/img/blog/1.jpg') }}" alt="Artículo del blog IMPEERCOL sobre ingeniería mecánica">
						<div class="blog-date">
							<i class="icofont-calendar"></i>
							ABRIL 18, 2022
						</div>
					</div>
					<div class="blog-desc">
						<ul class="blog-meta">
							<li>
								<a href="#">
									<i class="icofont-ui-user"></i>
									Kazi Jihad
								</a>
							</li>
							<li>
								<a href="#">
									<i class="icofont-comment"></i>
									12 Comentarios
								</a>
							</li>
						</ul>
						<div class="blog-content">
							<a href="{{ route('web.blog') }}" target="_blank">
								<h4>
									Ingeniería mecánica y suministros
								</h4>
							</a>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. In sit maxime nihil, corporis possimus dolore?
							</p>
							<a href="{{ route('web.blog') }}" class="btn-2">
								Leer más
								<i class="icofont-long-arrow-right"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="blog-box wow fadeInUp" data-wow-delay=".2s">
					<div class="blog-pic">
						<img src="{{ asset('assets/img/blog/2.jpg') }}" alt="Artículo del blog IMPEERCOL sobre servicios">
						<div class="blog-date">
							<i class="icofont-calendar"></i>
							ABRIL 18, 2022
						</div>
					</div>
					<div class="blog-desc">
						<ul class="blog-meta">
							<li>
								<a href="#">
									<i class="icofont-ui-user"></i>
									Philip Carouto
								</a>
							</li>
							<li>
								<a href="#">
									<i class="icofont-comment"></i>
									12 Comentarios
								</a>
							</li>
						</ul>
						<div class="blog-content">
							<a href="{{ route('web.blog') }}" target="_blank">
								<h4>
									Ingeniería mecánica y suministros
								</h4>
							</a>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. In sit maxime nihil, corporis possimus dolore?
							</p>
							<a href="{{ route('web.blog') }}" class="btn-2">
								Leer más
								<i class="icofont-long-arrow-right"></i>
							</a>
						</div>
					</div>
				</div>
				<div class="blog-box wow fadeInUp" data-wow-delay=".3s">
					<div class="blog-pic">
						<img src="{{ asset('assets/img/blog/3.jpg') }}" alt="Artículo del blog IMPEERCOL sobre proyectos">
						<div class="blog-date">
							<i class="icofont-calendar"></i>
							ABRIL 18, 2022
						</div>
					</div>
					<div class="blog-desc">
						<ul class="blog-meta">
							<li>
								<a href="#">
									<i class="icofont-ui-user"></i>
									John Mudi
								</a>
							</li>
							<li>
								<a href="#">
									<i class="icofont-comment"></i>
									12 Comentarios
								</a>
							</li>
						</ul>
						<div class="blog-content">
							<a href="{{ route('web.blog') }}" target="_blank">
								<h4>
									Ingeniería mecánica y suministros
								</h4>
							</a>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipisicing elit. In sit maxime nihil, corporis possimus dolore?
							</p>
							<a href="{{ route('web.blog') }}" class="btn-2">
								Leer más
								<i class="icofont-long-arrow-right"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Blog -->
	
	{{-- Sección de Marcas --}}
	<!-- Start IMPEERCOL Brands Section
	============================================= -->
	<div class="brands-area de-padding">
		<div class="container">
			<div class="row">
				<div class="col-xl-8 offset-xl-2">
					<div class="site-title text-center">
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
				<a href="{{ route('web.products') }}" aria-label="Ver todos los productos" style="cursor: pointer;">
					<img src="{{ asset('assets/img/gallery/logo-mobile-convertido-de-png.webp') }}" alt="Logo Mobile">
				</a>
				@php
					$sikaId = $brandsMap['sika'] ?? null;
				@endphp
				<a href="{{ $sikaId ? route('web.products', ['brand' => $sikaId]) : route('web.products') }}" aria-label="Sika" style="cursor: pointer;">
					<img src="{{ asset('assets/img/gallery/Sika_NoClaim_pos_rgb_mobile-convertido-de-webp.webp') }}" alt="Sika">
				</a>
				@php
					$texsaId = $brandsMap['texsa'] ?? null;
				@endphp
				<a href="{{ $texsaId ? route('web.products', ['brand' => $texsaId]) : route('web.products') }}" aria-label="Texsa" style="cursor: pointer;">
					<img src="{{ asset('assets/img/gallery/Logo-Texsa-Original.png-convertido-de-webp.webp') }}" alt="Texsa">
				</a>
				@php
					$meticId = $brandsMap['metic'] ?? null;
				@endphp
				<a href="{{ $meticId ? route('web.products', ['brand' => $meticId]) : route('web.products') }}" aria-label="Metic" style="cursor: pointer;">
					<img src="{{ asset('assets/img/gallery/Metic (1).webp') }}" alt="Metic">
				</a>
				@php
					$fiberglassId = $brandsMap['fiberglass'] ?? $brandsMap['fiverglass'] ?? null;
				@endphp
				<a href="{{ $fiberglassId ? route('web.products', ['brand' => $fiberglassId]) : route('web.products') }}" aria-label="FiberGlass" style="cursor: pointer;">
					<img src="{{ asset('assets/img/gallery/FiverGlass-convertido-de-webp.webp') }}" alt="FiberGlass">
				</a>
				@php
					$kaudalId = $brandsMap['kaudal'] ?? null;
				@endphp
				<a href="{{ $kaudalId ? route('web.products', ['brand' => $kaudalId]) : route('web.products') }}" aria-label="Kaudal" style="cursor: pointer;">
					<img src="{{ asset('assets/img/gallery/Kaudal-convertido-de-webp.webp') }}" alt="Kaudal">
				</a>
				@php
					$tekbondId = $brandsMap['tekbond'] ?? null;
				@endphp
				<a href="{{ $tekbondId ? route('web.products', ['brand' => $tekbondId]) : route('web.products') }}" aria-label="Tekbond" style="cursor: pointer;">
					<img src="{{ asset('assets/img/gallery/tekbond-logo-convertido-de-webp.webp') }}" alt="Tekbond">
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
	
</style>
@endsection

@section('scripts')
<script>
	$(document).ready(function() {
		// Reinicializar el carousel con menos margin
		if ($('.gallery-sldr').length > 0) {
			if ($('.gallery-sldr').data('owl.carousel')) {
				$('.gallery-sldr').trigger('destroy.owl.carousel');
			}
			$('.gallery-sldr').owlCarousel({
				loop: true,
				margin: 0,
				nav: false,
				dots: true,
				autoplay: true,
				autoplayTimeout: 5000,
				autoplayHoverPause: true,
				responsive: {
					0: {
						items: 1,
						margin: 10
					},
					768: {
						items: 2,
						margin: 20
					},
					992: {
						items: 3,
						margin: 30
					}
				}
			});
		}
	});
</script>
@endsection

