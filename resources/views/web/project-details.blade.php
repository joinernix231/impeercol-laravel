@extends('layouts.main')

@section('title', $project->title . ' - IMPEERCOL')

@php
    use Illuminate\Support\Str;
    $metaDesc = ($project->description ? Str::limit(strip_tags($project->description), 120) . ' ' : '') . 
        'Proyecto de impermeabilización ' . $project->title . 
        ' realizado por IMPEERCOL. Caso de éxito con soluciones duraderas para techos, juntas y recubrimientos. Verifica la calidad de nuestros trabajos y encuentra inspiración para tu próximo proyecto de impermeabilización.';
@endphp

@section('description', $metaDesc)

@section('content')
	<!-- Start Breadcrumb -->
	<div class="site-breadcrumb breadcrumb-bg-blog">
		<div class="container">
			<h2 class="breadcrumb-title">{{ $project->title }}</h2>
			<ul class="breadcrumb-menu clearfix">
				<li><a href="{{ route('web.home') }}">Inicio</a></li>
				<li><a href="{{ route('web.projects') }}">Proyectos</a></li>
				<li class="active">{{ $project->title }}</li>
			</ul>
		</div>
	</div>
	
	<!-- Start Product -->
	<div class="product-area de-padding">
		<div class="container">
			<div class="product-wpr">
				<div class="row ps g-5">
					<div class="col-xl-8">
						<div class="theme-single service-single">
							@if($project->image || ($project->gallery && is_array($project->gallery) && count($project->gallery) > 0))
								<div class="theme-pic mb-30">
									<div class="project-details-carousel owl-carousel owl-theme">
										@if($project->image)
											<div class="project-detail-item">
												<img src="{{ $project->image_url }}" class="big-pic" alt="{{ $project->title }}" loading="lazy" width="1600" height="900">
											</div>
										@endif
										@foreach($project->gallery_urls as $imageUrl)
											@if($imageUrl)
												<div class="project-detail-item">
													<img src="{{ $imageUrl }}" class="big-pic" alt="{{ $project->title }}" loading="lazy" width="1600" height="900">
												</div>
											@endif
										@endforeach
									</div>
								</div>
							@endif
							<div class="theme-info">
								<div class="theme-desc">
									<p class="mb-20">
										{{ $project->description }}
									</p>
									@if($project->client || $project->location || $project->system || $project->project_date)
										<div class="project-info-box mt-30">
											<h4 class="heading-5 mb-20">Información del Proyecto</h4>
											@if($project->client)
												<p class="mb-10"><strong>Cliente:</strong> {{ $project->client }}</p>
											@endif
											@if($project->location)
												<p class="mb-10"><strong>Ubicación:</strong> {{ $project->location }}</p>
											@endif
											@if($project->system)
												<p class="mb-10"><strong>Sistema Utilizado:</strong> {{ $project->system }}</p>
											@endif
											@if($project->project_date)
												<p class="mb-0"><strong>Fecha:</strong> <time datetime="{{ $project->project_date->format('Y-m-d') }}">{{ $project->project_date->format('d M Y') }}</time></p>
											@endif
										</div>
									@endif
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-4">
						<div class="project-sidebar">
							<div class="project-sidebar-single">
								<ul>
									@if($project->client)
										<li>
											Cliente <span>{{ $project->client }}</span>
										</li>
									@endif
									@if($project->location)
										<li>
											Ubicación <span>{{ $project->location }}</span>
										</li>
									@endif
									@if($project->system)
										<li>
											Sistema <span>{{ $project->system }}</span>
										</li>
									@endif
									@if($project->project_date)
										<li>
											Fecha <span><time datetime="{{ $project->project_date->format('Y-m-d') }}">{{ $project->project_date->format('d M Y') }}</time></span>
										</li>
									@endif
									<li>
										Proyecto <span>{{ $project->title }}</span>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Product -->
	
	@include('web.components.contact-info-strip')
@endsection

@section('scripts')
{{-- Archivo JavaScript externo para mejor rendimiento y organización --}}
<script src="{{ asset('assets/js/project-details.js') }}"></script>
@endsection

