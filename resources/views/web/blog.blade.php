@extends('layouts.main')

@section('title', 'Blog - IMPEERCOL')

@section('content')
	<!-- Start Breadcrumb -->
	<div class="site-breadcrumb" style="background: url({{ asset('assets/img/gallery/IMG_2798-convertido-de-jpg.webp') }})">
		<div class="container">
			<h2 class="breadcrumb-title">Blog</h2>
			<ul class="breadcrumb-menu">
				<li><a href="{{ route('web.home') }}">Inicio</a></li>
				<li class="active">Blog</li>
			</ul>
		</div>
	</div>
	
	<!-- Start Blog -->
	<div class="blog-page-area de-padding">
		<div class="container">
			<div class="row">
				<div class="col-xl-8 offset-xl-2">
					<div class="blog-pagination">
						<div class="blog-page-wpr">
							{{-- Aquí se mostrarán los artículos del blog cuando se implemente la base de datos --}}
							<div class="blog-page-single">
								<div class="blog-pic">
									<img src="{{ asset('assets/img/single/proj.jpg') }}" alt="Artículo del blog">
								</div>
								<div class="blog-content">
									<h3 class="blog-page-title mb-30">Artículo de ejemplo</h3>
									<div class="blog-text">
										<p class="mb-0">Contenido del artículo del blog...</p>
									</div>
									<div class="red-more mt-30">
										<a href="#" class="btn-4">Leer más</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

