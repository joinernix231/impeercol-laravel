@extends('layouts.main')

@section('title', 'Contacto - IMPEERCOL')

@section('content')
	<!-- Start Breadcrumb -->
	<div class="site-breadcrumb" style="background: url({{ asset('assets/img/gallery/IMG_2798-convertido-de-jpg.webp') }})">
		<div class="container">
			<h2 class="breadcrumb-title">Contacto</h2>
			<ul class="breadcrumb-menu clearfix">
				<li><a href="{{ route('web.home') }}">Inicio</a></li>
				<li class="active">Contacto</li>
			</ul>
		</div>
	</div>
	
	<!-- Start Contacto -->
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
	
	<!-- Start Google Map -->
	<div class="g-map-area">
		<div class="g-map--wrapper text-center">
			<iframe src="https://www.google.com/maps?q=Cra.%2016%20%23%2012-09,%20Bogot%C3%A1,%20Colombia&hl=es&z=18&output=embed"></iframe>
			<div class="map-overlay">
				<strong>Cra. 16 #12-09, Bogotá</strong>
				<div class="map-actions">
					<a class="btn-map" target="_blank" rel="noopener noreferrer" href="https://www.google.com/maps?q=Cra.%2016%20%23%2012-09,%20Bogot%C3%A1,%20Colombia">Ver en Google Maps</a>
					<a class="btn-map secondary" target="_blank" rel="noopener noreferrer" href="https://www.google.com/maps/dir/?api=1&destination=Cra.%2016%20%23%2012-09,%20Bogot%C3%A1,%20Colombia">Cómo llegar</a>
				</div>
			</div>
		</div>
	</div>
	
	@include('web.components.contact-info-strip')
@endsection

