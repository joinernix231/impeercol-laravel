@extends('layouts.main')

@section('title', 'Servicios - IMPEERCOL')

@section('description', 'Servicios de IMPEERCOL: asesoría técnica especializada en impermeabilización, distribución de productos de alta calidad, cotización rápida y entrega en Bogotá. Trabajamos con las mejores marcas del mercado. Te ayudamos a elegir el producto ideal para techos, muros, terrazas y cubiertas. Más de 15 años protegiendo espacios en Colombia.')

@section('content')
	<!-- Start Breadcrumb -->
	<div class="site-breadcrumb breadcrumb-bg-blog">
		<div class="container">
			<h2 class="breadcrumb-title">Servicios</h2>
			<ul class="breadcrumb-menu clearfix">
				<li><a href="{{ route('web.home') }}">Inicio</a></li>
				<li class="active">Servicios</li>
			</ul>
		</div>
	</div>
	
	<!-- Start Service -->
	<div class="service-2-area de-padding">
		<div class="container">
			<div class="service-2-wpr grid-4">
				<div class="service-2-box wow fadeInUp" data-wow-delay=".05s">
					<div class="service-2-shape"><img src="{{ asset('assets/img/shape/shape-7.png') }}" alt="thumb"></div>
					<div class="service-2-icon"><i class="icofont-ui-home"></i></div>
					<div class="service-2-desc">
						<h4>Impermeabilización de Techos</h4>
						<p class="mb-0">Sistemas acrílicos y membranas para detener filtraciones y reducir temperatura.</p>
					</div>
					<div class="service-2-btn">
						<a href="{{ route('web.contact') }}" class="btn-2">Ver detalle <i class="icofont-long-arrow-right"></i></a>
					</div>
				</div>
				<div class="service-2-box wow fadeInUp" data-wow-delay=".1s">
					<div class="service-2-shape"><img src="{{ asset('assets/img/shape/shape-7.png') }}" alt="thumb"></div>
					<div class="service-2-icon"><i class="icofont-tools-alt-2"></i></div>
					<div class="service-2-desc">
						<h4>Sellado de Juntas y Fisuras</h4>
						<p class="mb-0">Selladores elásticos de alto desempeño para controlar dilataciones.</p>
					</div>
					<div class="service-2-btn">
						<a href="{{ route('web.contact') }}" class="btn-2">Ver detalle <i class="icofont-long-arrow-right"></i></a>
					</div>
				</div>
				<div class="service-2-box wow fadeInUp" data-wow-delay=".15s">
					<div class="service-2-shape"><img src="{{ asset('assets/img/shape/shape-7.png') }}" alt="thumb"></div>
					<div class="service-2-icon"><i class="icofont-building-alt"></i></div>
					<div class="service-2-desc">
						<h4>Recubrimientos y Fachadas</h4>
						<p class="mb-0">Protección impermeable y acabados durables para muros y fachadas.</p>
					</div>
					<div class="service-2-btn">
						<a href="{{ route('web.contact') }}" class="btn-2">Ver detalle <i class="icofont-long-arrow-right"></i></a>
					</div>
				</div>
				<div class="service-2-box wow fadeInUp" data-wow-delay=".2s">
					<div class="service-2-shape"><img src="{{ asset('assets/img/shape/shape-7.png') }}" alt="thumb"></div>
					<div class="service-2-icon"><i class="icofont-repair"></i></div>
					<div class="service-2-desc">
						<h4>Mantenimiento y Reparación</h4>
						<p class="mb-0">Rehabilitación de cubiertas y puntos críticos para extender la vida útil.</p>
					</div>
					<div class="service-2-btn">
						<a href="{{ route('web.contact') }}" class="btn-2">Ver detalle <i class="icofont-long-arrow-right"></i></a>
					</div>
				</div>
				<div class="service-2-box wow fadeInUp" data-wow-delay=".25s">
					<div class="service-2-shape"><img src="{{ asset('assets/img/shape/shape-7.png') }}" alt="thumb"></div>
					<div class="service-2-icon"><i class="icofont-ui-settings"></i></div>
					<div class="service-2-desc">
						<h4>Asesoría Técnica</h4>
						<p class="mb-0">Acompañamiento para seleccionar el sistema y consumo adecuado por m².</p>
					</div>
					<div class="service-2-btn">
						<a href="{{ route('web.contact') }}" class="btn-2">Ver detalle <i class="icofont-long-arrow-right"></i></a>
					</div>
				</div>
				<div class="service-2-box wow fadeInUp" data-wow-delay=".3s">
					<div class="service-2-shape"><img src="{{ asset('assets/img/shape/shape-7.png') }}" alt="thumb"></div>
					<div class="service-2-icon"><i class="icofont-search-property"></i></div>
					<div class="service-2-desc">
						<h4>Inspecciones y Diagnóstico</h4>
						<p class="mb-0">Visita técnica, identificación de fallas y plan de intervención.</p>
					</div>
					<div class="service-2-btn">
						<a href="{{ route('web.contact') }}" class="btn-2">Ver detalle <i class="icofont-long-arrow-right"></i></a>
					</div>
				</div>
			</div>
			<div class="text-center mt-40">
				<a href="{{ route('web.contact') }}" class="btn-3">Solicitar cotización <i class="icofont-long-arrow-right"></i></a>
			</div>
		</div>
	</div>
	
	@include('web.components.contact-info-strip')
@endsection

