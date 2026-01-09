@extends('layouts.main')

@section('title', 'Proyectos - IMPEERCOL')

@section('description', 'Galería de proyectos de impermeabilización realizados por IMPEERCOL. Conoce casos de éxito con sistemas de impermeabilización para techos, juntas, recubrimientos y más. Soluciones duraderas que detienen filtraciones y protegen estructuras. Verifica la calidad de nuestros trabajos y encuentra inspiración para tu próximo proyecto.')

@section('styles')
<style>
	.project-card {
		background: #fff;
		border-radius: 8px;
		overflow: hidden;
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
		transition: all 0.3s ease;
		margin-bottom: 30px;
	}

	.project-card:hover {
		box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
		transform: translateY(-5px);
	}

	.project-img-link {
		cursor: pointer;
		text-decoration: none;
	}

	.project-img-link:hover {
		text-decoration: none;
	}

	.project-content {
		padding: 20px;
		background: #fff;
	}

	.project-title {
		font-size: 1.8rem;
		font-weight: 600;
		color: #1a1a1a;
		margin-bottom: 12px;
		line-height: 1.4;
		transition: color 0.3s ease;
	}

	.project-card:hover .project-title {
		color: var(--clr-def, #007bff);
	}

	.project-description {
		font-size: 1.4rem;
		color: #666;
		line-height: 1.6;
		margin: 0;
		display: -webkit-box;
		-webkit-line-clamp: 3;
		-webkit-box-orient: vertical;
		overflow: hidden;
		text-overflow: ellipsis;
	}

	@media (max-width: 768px) {
		.project-title {
			font-size: 1.6rem;
		}

		.project-description {
			font-size: 1.3rem;
			-webkit-line-clamp: 2;
		}

		.project-content {
			padding: 15px;
		}
	}
</style>
@endsection

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
						<a href="{{ route('web.project.show', $project->slug) }}" class="project-img-link" style="display: block; position: relative;">
							<div class="project-img">
								<img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-100">
								<div class="port-overlay">
									<div class="port-shape">
										<span class="shape-1"></span>
									</div>
									<div class="port-links">
										<a href="{{ $project->image_url }}" class="item popup-link port-link" onclick="event.stopPropagation();">
											<i class="ti ti-fullscreen"></i>
										</a>
										<span class="single-link port-link">
											<i class="ti ti-angle-double-right"></i>
										</span>
									</div>
								</div>
							</div>
						</a>
						<div class="project-content">
							<h4 class="project-title">
								<a href="{{ route('web.project.show', $project->slug) }}" style="color: inherit; text-decoration: none;">
									{{ $project->title }}
								</a>
							</h4>
							@if($project->description)
								<p class="project-description">{{ Str::limit(strip_tags($project->description), 120, '...') }}</p>
							@endif
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

