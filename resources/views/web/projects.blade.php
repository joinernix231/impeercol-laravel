@extends('layouts.main')

@section('title', 'Proyectos - IMPEERCOL')

@section('description', 'Galería de proyectos de impermeabilización realizados por IMPEERCOL. Conoce casos de éxito con sistemas de impermeabilización para techos, juntas, recubrimientos y más. Soluciones duraderas que detienen filtraciones y protegen estructuras. Verifica la calidad de nuestros trabajos y encuentra inspiración para tu próximo proyecto.')

@section('content')
	<!-- Start Breadcrumb -->
	<div class="site-breadcrumb breadcrumb-bg-default">
		<div class="container">
			<h2 class="breadcrumb-title">Nuestros Proyectos</h2>
			<ul class="breadcrumb-menu clearfix">
				<li><a href="{{ route('web.home') }}">Inicio</a></li>
				<li class="active">Proyectos</li>
			</ul>
		</div>
	</div>
	
	<!-- Start Project Page -->
	<div class="project-page de-padding">
		<div class="container">
			<div class="row mb-60">
				<div class="col-xl-8 offset-xl-2">
					<div class="site-title text-center">
						<h2>Nuestros Proyectos</h2>
						<p>Casos de éxito con sistemas IMPEERCOL</p>
					</div>
				</div>
			</div>
			<div class="project-page-wpr magnific-mix-gallery grid-3">
				@forelse($projects as $project)
					<div class="project-card image-scale-hover">
						<div class="project-img">
							<img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-100">
							<div class="port-overlay">
								<div class="port-shape">
									<span class="shape-1"></span>
								</div>
								<div class="port-links">
									<a href="{{ $project->image_url }}" class="item popup-link port-link">
										<i class="ti ti-fullscreen"></i>
									</a>
									<a href="{{ route('web.project.show', $project->slug) }}" class="single-link port-link">
										<i class="ti ti-angle-double-right"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
				@empty
					<div class="col-12 text-center">
						<p>No hay proyectos disponibles</p>
					</div>
				@endforelse
			</div>
		</div>
	</div>
@endsection

