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

@section('description', 'IMPEERCOL: Expertos en impermeabilización en Bogotá. 15+ años de experiencia con productos Sika, Texsa, Metic. Asesoría técnica, distribución nacional.')

@php
    use Illuminate\Support\Str;
    // Preload para la primera imagen del slider (above the fold)
    $firstBannerImage = $banners->first()->image_url ?? asset('assets/img/gallery/BO-convertido-de-jpg.webp');
@endphp

{{-- Preload de imagen crítica (primera del slider) --}}
@if(isset($banners) && $banners->count() > 0)
    <link rel="preload" as="image" href="{{ $firstBannerImage }}" fetchpriority="high">
@else
    <link rel="preload" as="image" href="{{ asset('assets/img/gallery/BO-convertido-de-jpg.webp') }}" fetchpriority="high">
@endif

@section('content')
	{{-- Slider Principal --}}
	<!-- Start Slider
	============================================= -->
    <div class="hero-section pos-rel">
        <div class="hero-section-content hero-sldr owl-carousel owl-theme">
            @forelse($banners as $index => $banner)
                <div class="hero-2-single hero-overlay hero-bg" style="background-image: url({{ $banner->image_url }})">
                    <div class="container g-0">
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">
                                <div class="hero-2-content text-center">
                                    <h{{ $index === 0 ? '1' : '2' }} class="hero-title">
                                        {{ $banner->title }}
                                    </h{{ $index === 0 ? '1' : '2' }}>
                                    @if($banner->subtitle)
                                        <p>
                                            {{ $banner->subtitle }}
                                        </p>
                                    @endif
                                    <div class="hero-btn d-flex justify-content-center">
                                        <div class="button-container-{{ $index + 1 }}">
                                            <span class="mas">Contáctanos</span>
                                            <a href="#contact" class="site-btn-{{ $index + 1 }} smooth-menu">Contáctanos</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{-- Banners por defecto si no hay ninguno configurado --}}
                <div class="hero-2-single hero-overlay hero-bg" style="background-image: url({{ asset('assets/img/gallery/BO-convertido-de-jpg.webp') }})">
                    <div class="container g-0">
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">
                                <div class="hero-2-content text-center">
                                    <h1 class="hero-title">
                                        IMPEERCOL - Expertos en Impermeabilización en Bogotá
                                    </h1>
                                    <p>
                                        Más de 15 años de experiencia ofreciendo productos de alta calidad de las mejores marcas
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
            @endforelse
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
									<img src="{{ asset('assets/img/gallery/inicio-convertido-de-jpg.webp') }}"
										 class="about-main-pic"
										 alt="IMPEERCOL - Expertos en impermeabilización y recubrimientos en Bogotá"
										 loading="lazy"
										 decoding="async"
										 width="500"
										 height="600"
										 style="max-width: 100%; height: auto;">
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-7">
						<div class="about-right pl-60">
							<div class="about-heading mb-40">
								<h2 class="hero-title mb-30 fade-in-right">¿Quiénes Somos?</h2>
								<p class="mb-0 fade-in-right-delay">
									IMPEERCOL es tu aliado en impermeabilización en Bogotá. Llevamos más de 15 años protegiendo los espacios de los colombianos con impermeabilizantes de alta calidad. Somos expertos en impermeabilización, ofreciendo soluciones duraderas y confiables para techos, muros y cubiertas, garantizando resultados visibles y protección total contra la humedad. Productos fáciles de aplicar y pensados para durar.
								</p>
							</div>
							<div class="about-features">
								<div class="feature-grid">
									<div class="feature-item fade-in-up-stagger" data-delay="0.1s">
										<h3>Marcas Reconocidas</h3>
										<p>Las mejores marcas del mercado</p>
									</div>
									<div class="feature-item fade-in-up-stagger" data-delay="0.2s">
										<h3>Asesoría Técnica</h3>
										<p>Te ayudamos a elegir el producto ideal</p>
									</div>
									<div class="feature-item fade-in-up-stagger" data-delay="0.3s">
										<h3>Distribución Nacional</h3>
										<p>Envíos a toda Colombia</p>
									</div>
									<div class="feature-item fade-in-up-stagger" data-delay="0.4s">
										<h3>15+ Años</h3>
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
									@php
										$optimizedUrl = 'https://impeercol.com.co/storage/projects/images/2025/11/plastocrete-dm-20-kg-y-200-kg_1764433073_xOeMmLs4.png';
										$srcset = 'https://impeercol.com.co/storage/projects/images/2025/11/plastocrete-dm-20-kg-y-200-kg_1764433073_xOeMmLs4.png';
									@endphp
									<img src="{{ $optimizedUrl }}"
										 @if($srcset)srcset="{{ $srcset }}" sizes="(max-width: 768px) 300px, (max-width: 1200px) 400px, 300px"@endif
										 alt="{{ $product->name }}"
										 loading="lazy"
										 decoding="async"
										 width="300"
										 height="300">
								</a>
							</div>
							<div class="products-desc">
								<h3>
									<a href="{{ route('web.product.show', $product->slug) }}">{{ $product->name }}</a>
								</h3>
								@if($product->brand_name)
									<p class="text-muted mb-2"><small>Marca: {{ $product->brand_name }}</small></p>
								@endif
								@if($product->category)
									<p class="text-muted mb-2"><small>Categoría: {{ $product->category->name }}</small></p>
								@endif
								@if($product->description)
									<p class="product-excerpt">{{ Str::limit(strip_tags($product->description), 100) }}</p>
								@endif
								<div class="add-to-cart">
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
	<div class="step-area de-pt pos-rel pb-256 hero-bg step-area-bg">
		<div class="container">
			<div class="step-wpr grid-2">
				<div class="step-left d-flex align-items-center">
					<div class="step-left-content">
						<div class="step-left-header">
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
							<h3 class="heading-6">Asesoría</h3>
							<p>
								Elegimos contigo el impermeabilizante ideal para tu superficie (techo, muro, terraza).
							</p>
						</div>
						<div class="step-box fade-in-up-stagger" data-delay="0.2s">
							<span class="step-number">02</span>
							<h3 class="heading-6">Cotización</h3>
							<p class="mb-0">
								Cotización rápida y clara, con productos disponibles en nuestro catálogo.
							</p>
						</div>
						<div class="step-box fade-in-up-stagger" data-delay="0.3s">
							<span class="step-number">03</span>
							<h3 class="heading-6">Compra</h3>
							<p class="mb-0">
								Haz tu pedido; te indicamos métodos de pago y disponibilidad inmediata.
							</p>
						</div>
						<div class="step-box fade-in-up-stagger" data-delay="0.4s">
							<span class="step-number">04</span>
							<h3 class="heading-6">Entrega</h3>
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
					<a href="{{ route('web.project.show', $project->slug) }}" class="work-box-link" style="display: block;">
						<div class="work-box wow fadeInUp" data-wow-delay="{{ ($index + 1) * 0.1 }}s">
							<div class="work-pic">
								<img src="{{ $project->image_url }}"
									 alt="{{ $project->title }} - Proyecto IMPEERCOL"
									 loading="lazy"
									 decoding="async"
									 width="400"
									 height="300"
									 style="width: 100%; height: auto;">
								<div class="work-ovarlay">
									<div class="work-overlay-content">
										<div class="work-overlay-header">
											<h4 class="heading-5">{{ $project->title }}</h4>
											<span class="work-link">
												<i class="ti ti-plus"></i>
											</span>
										</div>
										<p class="work-text mb-0">
											{{ Str::limit($project->description, 100, '...') }}
										</p>
									</div>
								</div>
							</div>
						</div>
					</a>

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
								<h3>Dirección</h3>
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
								<i class="icofont-google-map"></i>
							</div>
							<div class="addr-desc">
								<h4>Dirección</h4>
								<p class="mb-0">
									<a href="https://www.google.com/maps/search/?api=1&query=Cra%2020%20%2368-15,%20Siete%20de%20Agosto,%20Bogot%C3%A1" target="_blank" rel="noopener noreferrer">
										Cra 20 # 68 - 15<br>
										Siete de Agosto, Bogotá
									</a>
								</p>
							</div>
						</div>
						<div class="addr-box-single">
							<div class="addr-icon">
								<i class="icofont-phone"></i>
							</div>
							<div class="addr-desc">
								<h3>Teléfono</h3>
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
								<h3>Correo electrónico</h3>
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
								<img src="{{ $blog->image_url }}"
									 alt="{{ $blog->title }} - Blog IMPEERCOL"
									 loading="lazy"
									 decoding="async"
									 width="400"
									 height="250"
									 style="width: 100%; height: auto;">
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
									<h3>
										{{ $blog->title }}
									</h3>
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
				<a href="{{ route('web.products') }}" aria-label="Ver todos los productos" class="cursor-pointer">
					<img src="{{ asset('assets/img/gallery/logo-mobile-convertido-de-png.webp') }}" alt="Logo IMPEERCOL">
				</a>
				@php
					$sikaId = $brandsMap['sika'] ?? null;
				@endphp
				<a href="{{ $sikaId ? route('web.products', ['brand' => $sikaId]) : route('web.products') }}" aria-label="Sika" class="cursor-pointer" rel="nofollow">
					<img src="{{ asset('assets/img/gallery/Sika_NoClaim_pos_rgb_mobile-convertido-de-webp.webp') }}" alt="Sika">
				</a>
				@php
					$texsaId = $brandsMap['texsa'] ?? null;
				@endphp
				<a href="{{ $texsaId ? route('web.products', ['brand' => $texsaId]) : route('web.products') }}" aria-label="Texsa" class="cursor-pointer" rel="nofollow">
					<img src="{{ asset('assets/img/gallery/Logo-Texsa-Original.png-convertido-de-webp.webp') }}" alt="Texsa">
				</a>
				@php
					$meticId = $brandsMap['metic'] ?? null;
				@endphp
				<a href="{{ $meticId ? route('web.products', ['brand' => $meticId]) : route('web.products') }}" aria-label="Metic" class="cursor-pointer" rel="nofollow">
					<img src="{{ asset('assets/img/gallery/Metic (1).webp') }}" alt="Metic">
				</a>
				@php
					$fiberglassId = $brandsMap['fiberglass'] ?? $brandsMap['fiverglass'] ?? null;
				@endphp
				<a href="{{ $fiberglassId ? route('web.products', ['brand' => $fiberglassId]) : route('web.products') }}" aria-label="FiberGlass" class="cursor-pointer" rel="nofollow">
					<img src="{{ asset('assets/img/gallery/FiverGlass-convertido-de-webp.webp') }}" alt="FiberGlass">
				</a>
				@php
					$kaudalId = $brandsMap['kaudal'] ?? null;
				@endphp
				<a href="{{ $kaudalId ? route('web.products', ['brand' => $kaudalId]) : route('web.products') }}" aria-label="Kaudal" class="cursor-pointer" rel="nofollow">
					<img src="{{ asset('assets/img/gallery/Kaudal-convertido-de-webp.webp') }}" alt="Kaudal">
				</a>
				@php
					$tekbondId = $brandsMap['tekbond'] ?? null;
				@endphp
				<a href="{{ $tekbondId ? route('web.products', ['brand' => $tekbondId]) : route('web.products') }}" aria-label="Tekbond" class="cursor-pointer" rel="nofollow">
					<img src="{{ asset('assets/img/gallery/tekbond-logo-convertido-de-webp.webp') }}" alt="Tekbond">
				</a>
				@php
					$sikaIndustryId = $brandsMap['sika'] ?? null;
				@endphp
				<a href="{{ $sikaIndustryId ? route('web.products', ['brand' => $sikaIndustryId]) : route('web.products') }}" aria-label="Sika Industry" class="sika-industry-logo cursor-pointer" rel="nofollow">
					<img src="{{ asset('assets/img/gallery/sikaind.png') }}" alt="Sika Industry">
				</a>
			</div>
		</div>
	</div>
	<!-- End IMPEERCOL Brands Section -->

	{{-- Información de Contacto --}}
	@include('web.components.contact-info-strip')

	{{-- Structured Data (JSON-LD) para SEO --}}
	@include('web.components.seo.organization-schema')
	@include('web.components.seo.localbusiness-schema')
	@include('web.components.seo.website-schema')
@endsection

@section('styles')
{{-- Archivos CSS externos para mejor rendimiento y organización --}}
<link href="{{ asset('assets/css/animations.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/home.css') }}" rel="stylesheet">
@endsection

@section('scripts')
{{-- Archivos JavaScript externos para mejor rendimiento y organización --}}
<script src="{{ asset('assets/js/animations.js') }}"></script>
<script src="{{ asset('assets/js/home.js') }}"></script>
@endsection

