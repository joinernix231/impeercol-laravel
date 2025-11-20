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
								<h2 class="hero-title fade-in-up">
									Productos especializados con la mejor asesoría tecnica.
								</h2>
								<p class="fade-in-up-delay">
									Mejor asesoría tecnica y productos de alta calidad.
								</p>
								<div class="hero-btn d-flex justify-content-center fade-in-up-delay-2">
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
								<h2 class="hero-title fade-in-up">
									Impermeabiliza, protege y conserva
								</h2>
								<p class="fade-in-up-delay">
									Todo lo que necesitas para mantener tus espacios en perfectas condiciones.
								</p>
								<div class="hero-btn d-flex justify-content-center fade-in-up-delay-2">
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
								<div class="about-photo pos-rel fade-in-left">
									<span class="about-dotted"></span>
									<img src="{{ asset('assets/img/gallery/inicio-convertido-de-jpg.webp') }}" class="about-main-pic" alt="IMPEERCOL - Expertos en impermeabilización y recubrimientos en Bogotá" loading="lazy">
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-7">
						<div class="about-right pl-60">
							<div class="about-heading mb-40">
								<h2 class="hero-title mb-30 fade-in-right">¿Quiénes Somos?</h2>
								<p class="mb-0 fade-in-right-delay">
									En impeercol llevamos más de 15 años protegiendo los espacios de los colombianos con impermeabilizantes de alta calidad. Ofrecemos soluciones duraderas y confiables para techos, muros y cubiertas, garantizando resultados visibles y protección total contra la humedad. Somos tu aliado en impermeabilización, con productos fáciles de aplicar y pensados para durar.
								</p>
							</div>
							<div class="about-features">
								<div class="feature-grid">
									<div class="feature-item fade-in-up-stagger" data-delay="0.1s">
										<h4>Marcas Reconocidas</h4>
										<p>Las mejores marcas del mercado</p>
									</div>
									<div class="feature-item fade-in-up-stagger" data-delay="0.2s">
										<h4>Asesoría Técnica</h4>
										<p>Te ayudamos a elegir el producto ideal</p>
									</div>
									<div class="feature-item fade-in-up-stagger" data-delay="0.3s">
										<h4>Distribución Nacional</h4>
										<p>Envíos a toda Colombia</p>
									</div>
									<div class="feature-item fade-in-up-stagger" data-delay="0.4s">
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

	{{-- Slider de Productos Destacados --}}
	<!-- Start Featured Products
	============================================= -->
	<div class="featured-products-area de-padding">
		<div class="container">
			<div class="row">
				<div class="col-xl-8 offset-xl-2">
					<div class="site-title text-center mb-60">
						<h4 class="hero-sub-title mb-0 fade-in-down">PRODUCTOS DESTACADOS</h4>
						<h2 class="hero-title mb-30 fade-in-up">Nuestros Productos Más Populares</h2>
						<div class="title-line fade-in-scale"></div>
						<p class="mb-0 mt-40 fade-in-up-delay">
							Descubre nuestra selección de impermeabilizantes de alta calidad, elegidos por su excelente rendimiento y durabilidad.
						</p>
					</div>
				</div>
			</div>
			<div class="featured-products-slider owl-carousel owl-theme">
				@forelse($featuredProducts as $index => $product)
					<div class="featured-product-item fade-in-scale-stagger" data-delay="{{ $index * 0.1 }}s">
						<div class="products-box">
							<div class="products-pic">
								<a href="{{ route('web.product.show', $product->slug) }}">
									<img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy">
								</a>
							</div>
							<div class="products-desc">
								<h5>
									<a href="{{ route('web.product.show', $product->slug) }}">{{ $product->name }}</a>
								</h5>
								@if($product->brand_name)
									<p class="text-muted mb-2"><small>Marca: {{ $product->brand_name }}</small></p>
								@endif
								@if($product->category)
									<p class="text-muted mb-2"><small>Categoría: {{ $product->category->name }}</small></p>
								@endif
								@if($product->description)
									<p class="product-excerpt">{{ Str::limit(strip_tags($product->description), 80) }}</p>
								@endif
								<div class="add-to-cart pt-3">
									<a href="{{ route('web.product.show', $product->slug) }}" class="cart-btn">Ver Detalles</a>
								</div>
							</div>
						</div>
					</div>
				@empty
					<div class="col-12 text-center">
						<p class="text-muted">No hay productos destacados disponibles en este momento.</p>
					</div>
				@endforelse
			</div>
		</div>
	</div>
	<!-- End Featured Products -->
	
	{{-- Sección Cómo Trabajamos --}}
	<!-- Start Steps
	============================================= -->
	<div class="step-area de-pt pos-rel pb-256 hero-bg" style="background-image: url({{ asset('assets/img/gallery/Centro-frente.jpg') }}); background-attachment: fixed; background-size: cover; background-position: center;">
		<div class="container">
			<div class="step-wpr grid-2">
				<div class="step-left d-flex align-items-center">
					<div class="step-left-content">
						<div class="step-left-header">
							<h3 class="hero-sub-title">&nbsp;</h3>
							<h2 class="hero-title mb-0 fade-in-left">Cómo Trabajamos</h2>
						</div>
						<p class="mb-50 step-left-para fade-in-left-delay">
							En impeercol hacemos fácil y rápida la compra de impermeabilizantes. Te guiamos para elegir el producto ideal y proteger tus espacios con confianza.
						</p>
						<div class="button-container-2 fade-in-left-delay-2">
							<span class="mas">Contáctanos</span>
							<a href="#contact" class="site-btn-2 smooth-menu">Contáctanos</a>
						</div>
					</div>
				</div>
				<div class="step-right">
					<div class="step-box-wpr grid-2">
						<div class="step-box fade-in-up-stagger" data-delay="0.1s">
							<span class="step-number">01</span>
							<h4 class="heading-6">Asesoría</h4>
							<p>
								Elegimos contigo el impermeabilizante ideal para tu superficie (techo, muro, terraza).
							</p>
						</div>
						<div class="step-box fade-in-up-stagger" data-delay="0.2s">
							<span class="step-number">02</span>
							<h4 class="heading-6">Cotización</h4>
							<p class="mb-0">
								Cotización rápida y clara, con productos disponibles en nuestro catálogo.
							</p>
						</div>
						<div class="step-box fade-in-up-stagger" data-delay="0.3s">
							<span class="step-number">03</span>
							<h4 class="heading-6">Compra</h4>
							<p class="mb-0">
								Haz tu pedido; te indicamos métodos de pago y disponibilidad inmediata.
							</p>
						</div>
						<div class="step-box fade-in-up-stagger" data-delay="0.4s">
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
							<h2 class="fade-in-left">Nuestros Trabajos de Impermeabilización</h2>
							<p class="mb-0 work-title-para fade-in-left-delay">
								Casos de éxito con sistemas impeercol: soluciones duraderas para techos, juntas
								y recubrimientos que detienen filtraciones y protegen tus estructuras.
							</p>
						</div>
					</div>
				</div>
			</div>

			<div class="work-wpr gallery-sldr owl-carousel owl-theme">
				
				@forelse($featuredProjects as $index => $project)
					<div class="work-box fade-in-scale-stagger" data-delay="{{ $index * 0.1 }}s">
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
						<h4 class="hero-sub-title mb-0 fade-in-right">Contáctanos</h4>
						<h2 class="hero-title mb-0 fade-in-right-delay">¿Tienes alguna consulta?</h2>
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
						<h2 class="fade-in-up">Últimas noticias</h2>
						<p class="mb-0 fade-in-up-delay">
							Noticias y artículos recientes sobre impermeabilización, productos y consejos de mantenimiento.
						</p>
					</div>
				</div>
			</div>
			<div class="blog-wpr grid-3">
				@forelse($latestBlogs as $index => $blog)
					<div class="blog-box fade-in-scale-stagger" data-delay="{{ $index * 0.1 }}s">
						<div class="blog-pic">
							<a href="{{ route('web.blog.show', $blog->slug) }}">
								<img src="{{ $blog->image_url }}" alt="{{ $blog->title }}">
							</a>
							@if($blog->published_at)
								<div class="blog-date">
									<i class="icofont-calendar"></i>
									{{ strtoupper($blog->published_at->locale('es')->translatedFormat('F d, Y')) }}
								</div>
							@elseif($blog->created_at)
								<div class="blog-date">
									<i class="icofont-calendar"></i>
									{{ strtoupper($blog->created_at->locale('es')->translatedFormat('F d, Y')) }}
								</div>
							@endif
						</div>
						<div class="blog-desc">
							<ul class="blog-meta">
								@if($blog->author)
									<li>
										<a href="{{ route('web.blog') }}">
											<i class="icofont-ui-user"></i>
											{{ $blog->author }}
										</a>
									</li>
								@endif
							</ul>
							<div class="blog-content">
								<a href="{{ route('web.blog.show', $blog->slug) }}">
									<h4>
										{{ $blog->title }}
									</h4>
								</a>
								<p>
									@if($blog->excerpt)
										{{ Str::limit($blog->excerpt, 100) }}
									@elseif($blog->content)
										{{ Str::limit(strip_tags($blog->content), 100) }}
									@endif
								</p>
								<a href="{{ route('web.blog.show', $blog->slug) }}" class="btn-2">
									Leer más
									<i class="icofont-long-arrow-right"></i>
								</a>
							</div>
						</div>
					</div>
				@empty
					<div class="col-12 text-center">
						<p class="text-muted">No hay artículos disponibles en este momento.</p>
					</div>
				@endforelse
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
						<h4 class="hero-sub-title mb-0 fade-in-down">NUESTRAS MARCAS</h4>
						<h2 class="hero-title mb-30 fade-in-up">Marcas de Confianza</h2>
						<div class="title-line fade-in-scale"></div>
						<p class="mb-0 mt-40 fade-in-up-delay">
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
				@php
					$sikaIndustryId = $brandsMap['sika'] ?? null;
				@endphp
				<a href="{{ $sikaIndustryId ? route('web.products', ['brand' => $sikaIndustryId]) : route('web.products') }}" aria-label="Sika Industry" class="sika-industry-logo" style="cursor: pointer;">
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
	.featured-products-area {
		background: #f8f9fa;
	}

	.featured-products-slider {
		margin-top: 4rem;
	}

	.featured-product-item {
		padding: 0 15px;
	}

	.featured-product-item .products-box {
		background: #fff;
		border-radius: 10px;
		overflow: hidden;
		box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
		transition: all 0.3s ease;
		height: 100%;
		display: flex;
		flex-direction: column;
	}

	.featured-product-item .products-pic {
		width: 100%;
		height: 250px;
		overflow: hidden;
		position: relative;
	}

	.featured-product-item .products-pic img {
		width: 100%;
		height: 100%;
		object-fit: cover;
		transition: transform 0.4s ease-out;
	}

	.featured-product-item .products-desc {
		padding: 2rem;
		flex: 1;
		display: flex;
		flex-direction: column;
	}

	.featured-product-item .products-desc h5 {
		margin-bottom: 1rem;
		font-size: 1.8rem;
		font-weight: 600;
	}

	.featured-product-item .products-desc h5 a {
		color: #1a1a1a;
		text-decoration: none;
		transition: color 0.3s ease;
	}

	.featured-product-item .products-desc h5 a:hover {
		color: var(--clr-def, #e63946);
	}

	.featured-product-item .product-excerpt {
		font-size: 1.4rem;
		color: #666;
		line-height: 1.6;
		margin-bottom: 1.5rem;
		flex: 1;
	}

	.featured-product-item .cart-btn {
		margin-top: auto;
	}

	@media (max-width: 768px) {
		.featured-product-item .products-pic {
			height: 200px;
		}

		.featured-product-item .products-desc {
			padding: 1.5rem;
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

	/* ============================================
	   ANIMACIONES SUTILES Y PROFESIONALES
	   Modernas, elegantes y empresariales
	   ============================================ */

	/* Fade In Up - Entrada suave desde abajo */
	.fade-in-up {
		opacity: 0;
		transform: translateY(30px);
		animation: fadeInUp 0.8s ease-out forwards;
	}

	.fade-in-up-delay {
		opacity: 0;
		transform: translateY(30px);
		animation: fadeInUp 0.8s ease-out 0.2s forwards;
	}

	.fade-in-up-delay-2 {
		opacity: 0;
		transform: translateY(30px);
		animation: fadeInUp 0.8s ease-out 0.4s forwards;
	}

	@keyframes fadeInUp {
		from {
			opacity: 0;
			transform: translateY(30px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	/* Fade In Down - Entrada suave desde arriba */
	.fade-in-down {
		opacity: 0;
		transform: translateY(-20px);
		animation: fadeInDown 0.8s ease-out forwards;
	}

	@keyframes fadeInDown {
		from {
			opacity: 0;
			transform: translateY(-20px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	/* Fade In Left - Entrada suave desde la izquierda */
	.fade-in-left {
		opacity: 0;
		transform: translateX(-40px);
		animation: fadeInLeft 0.8s ease-out forwards;
	}

	.fade-in-left-delay {
		opacity: 0;
		transform: translateX(-40px);
		animation: fadeInLeft 0.8s ease-out 0.2s forwards;
	}

	.fade-in-left-delay-2 {
		opacity: 0;
		transform: translateX(-40px);
		animation: fadeInLeft 0.8s ease-out 0.4s forwards;
	}

	@keyframes fadeInLeft {
		from {
			opacity: 0;
			transform: translateX(-40px);
		}
		to {
			opacity: 1;
			transform: translateX(0);
		}
	}

	/* Fade In Right - Entrada suave desde la derecha */
	.fade-in-right {
		opacity: 0;
		transform: translateX(40px);
		animation: fadeInRight 0.8s ease-out forwards;
	}

	.fade-in-right-delay {
		opacity: 0;
		transform: translateX(40px);
		animation: fadeInRight 0.8s ease-out 0.2s forwards;
	}

	@keyframes fadeInRight {
		from {
			opacity: 0;
			transform: translateX(40px);
		}
		to {
			opacity: 1;
			transform: translateX(0);
		}
	}

	/* Fade In Scale - Entrada con ligero zoom */
	.fade-in-scale {
		opacity: 0;
		transform: scale(0.95);
		animation: fadeInScale 0.8s ease-out forwards;
	}

	@keyframes fadeInScale {
		from {
			opacity: 0;
			transform: scale(0.95);
		}
		to {
			opacity: 1;
			transform: scale(1);
		}
	}

	/* Fade In Scale Stagger - Para productos con delay */
	.fade-in-scale-stagger {
		opacity: 0;
		transform: scale(0.95) translateY(20px);
		animation: fadeInScaleStagger 0.6s ease-out forwards;
	}

	.fade-in-scale-stagger[data-delay="0s"] { animation-delay: 0s; }
	.fade-in-scale-stagger[data-delay="0.1s"] { animation-delay: 0.1s; }
	.fade-in-scale-stagger[data-delay="0.2s"] { animation-delay: 0.2s; }
	.fade-in-scale-stagger[data-delay="0.3s"] { animation-delay: 0.3s; }
	.fade-in-scale-stagger[data-delay="0.4s"] { animation-delay: 0.4s; }

	@keyframes fadeInScaleStagger {
		from {
			opacity: 0;
			transform: scale(0.95) translateY(20px);
		}
		to {
			opacity: 1;
			transform: scale(1) translateY(0);
		}
	}

	/* Fade In Up Stagger - Para tarjetas con delay */
	.fade-in-up-stagger {
		opacity: 0;
		transform: translateY(25px);
		animation: fadeInUpStagger 0.6s ease-out forwards;
	}

	.fade-in-up-stagger[data-delay="0.1s"] { animation-delay: 0.1s; }
	.fade-in-up-stagger[data-delay="0.2s"] { animation-delay: 0.2s; }
	.fade-in-up-stagger[data-delay="0.3s"] { animation-delay: 0.3s; }
	.fade-in-up-stagger[data-delay="0.4s"] { animation-delay: 0.4s; }

	@keyframes fadeInUpStagger {
		from {
			opacity: 0;
			transform: translateY(25px);
		}
		to {
			opacity: 1;
			transform: translateY(0);
		}
	}

	/* Hover effects sutiles y profesionales */
	.featured-product-item .products-box:hover {
		transform: translateY(-8px);
		box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
		transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
	}

	.featured-product-item .products-box:hover .products-pic img {
		transform: scale(1.08);
		transition: transform 0.4s ease-out;
	}

	.feature-item:hover {
		transform: translateY(-5px);
		box-shadow: 0 10px 25px rgba(230, 57, 70, 0.15);
		transition: all 0.3s ease-out;
	}

	.work-box:hover {
		transform: translateY(-8px);
		box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
		transition: all 0.3s ease-out;
	}

	.blog-box:hover {
		transform: translateY(-6px);
		box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
		transition: all 0.3s ease-out;
	}

	/* Scroll reveal con Intersection Observer - Solo para elementos visibles */
	@media (prefers-reduced-motion: no-preference) {
		.fade-in-up,
		.fade-in-up-delay,
		.fade-in-up-delay-2,
		.fade-in-down,
		.fade-in-left,
		.fade-in-left-delay,
		.fade-in-left-delay-2,
		.fade-in-right,
		.fade-in-right-delay,
		.fade-in-scale,
		.fade-in-scale-stagger,
		.fade-in-up-stagger {
			opacity: 0;
		}
	}

	/* Desactivar animaciones en móviles para mejor rendimiento */
	@media (max-width: 768px) {
		.fade-in-up,
		.fade-in-up-delay,
		.fade-in-up-delay-2,
		.fade-in-down,
		.fade-in-left,
		.fade-in-left-delay,
		.fade-in-left-delay-2,
		.fade-in-right,
		.fade-in-right-delay,
		.fade-in-scale,
		.fade-in-scale-stagger,
		.fade-in-up-stagger {
			animation: none !important;
			opacity: 1 !important;
			transform: none !important;
		}
	}
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

		// Inicializar slider de productos destacados
		if ($('.featured-products-slider').length > 0) {
			$('.featured-products-slider').owlCarousel({
				loop: true,
				margin: 30,
				nav: true,
				dots: true,
				autoplay: true,
				autoplayTimeout: 4000,
				autoplayHoverPause: true,
				navText: [
					'<i class="icofont-long-arrow-left"></i>',
					'<i class="icofont-long-arrow-right"></i>'
				],
				responsive: {
					0: {
						items: 1,
						margin: 15
					},
					576: {
						items: 2,
						margin: 20
					},
					768: {
						items: 3,
						margin: 25
					},
					992: {
						items: 4,
						margin: 30
					}
				}
			});
		}

		// Activar animaciones sutiles cuando los elementos entran en viewport
		if ('IntersectionObserver' in window) {
			const animateObserver = new IntersectionObserver(function(entries) {
				entries.forEach(function(entry) {
					if (entry.isIntersecting) {
						entry.target.style.animationPlayState = 'running';
						animateObserver.unobserve(entry.target);
					}
				});
			}, {
				threshold: 0.1,
				rootMargin: '0px 0px -30px 0px'
			});

			// Observar todos los elementos con animaciones fade-in
			document.querySelectorAll('[class*="fade-in-"]').forEach(function(el) {
				el.style.animationPlayState = 'paused';
				animateObserver.observe(el);
			});
		}

		// Animación del hero slider al cambiar slide
		if ($('.hero-sldr').length > 0) {
			$('.hero-sldr').on('changed.owl.carousel', function(event) {
				var $activeItem = $(event.target).find('.owl-item.active .hero-2-content');
				
				// Reiniciar animaciones suavemente
				$activeItem.find('.fade-in-up, .fade-in-up-delay, .fade-in-up-delay-2').each(function() {
					var $this = $(this);
					$this.css('animation', 'none');
					setTimeout(function() {
						$this.css('animation', '');
					}, 10);
				});
			});
		}

	});
</script>
@endsection

