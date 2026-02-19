@extends('layouts.main')

@section('title', 'Blog - IMPEERCOL')

@section('description', 'Blog de IMPEERCOL: consejos, guías y artículos sobre impermeabilización, mantenimiento de techos, aplicación de productos, soluciones para filtraciones y más. Aprende de nuestros expertos sobre cómo proteger y mantener tus espacios. Información actualizada sobre productos, técnicas y mejores prácticas en impermeabilización.')

@section('content')
	<!-- Start Breadcrumb -->
	<div class="site-breadcrumb breadcrumb-bg-blog">
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
					{{-- Barra de búsqueda --}}
					<div class="mb-4">
						<div class="widget search">
							<h5 class="work-title">Buscar Artículos</h5>
							<form class="search-form" method="GET" action="{{ route('web.blog') }}">
								<input type="text" 
									   name="search" 
									   class="input-style-2" 
									   placeholder="Buscar artículos..." 
									   value="{{ $search ?? '' }}">
								<button type="submit" class="btn-sub">
									<i class="icofont-search"></i>
								</button>
							</form>
							@if($search ?? false)
								<div class="mt-3">
									<a href="{{ route('web.blog') }}" class="tags-link">
										<i class="icofont-close"></i> Limpiar búsqueda
									</a>
								</div>
							@endif
						</div>
					</div>

					<div class="blog-pagination">
						<div class="blog-page-wpr">
							@forelse($blogs as $blog)
								<div class="blog-page-single mb-4">
									@if($blog->image)
										<div class="blog-pic">
											<a href="{{ route('web.blog.show', $blog->slug) }}">
												@php
													$optimizedUrl = \App\Helpers\ImageHelper::optimizedImageUrl($blog->image ?? '', 800, 500);
													$srcset = $blog->image ? \App\Helpers\ImageHelper::srcset($blog->image, [400, 800, 1200]) : '';
												@endphp
												<img src="{{ $optimizedUrl }}" 
													 @if($srcset)srcset="{{ $srcset }}" sizes="(max-width: 768px) 100vw, 800px"@endif
													 alt="{{ $blog->title }} - Blog IMPEERCOL" 
													 loading="lazy" 
													 decoding="async"
													 width="800" 
													 height="500"
													 style="width: 100%; height: auto;">
											</a>
										</div>
									@endif
									<div class="blog-content">
										<div class="blog-meta mb-2">
											@if($blog->published_at)
												<span class="text-muted">
													<i class="bi bi-calendar"></i> {{ $blog->published_at->format('d/m/Y') }}
												</span>
											@endif
											@if($blog->author)
												<span class="text-muted ms-3">
													<i class="bi bi-person"></i> {{ $blog->author }}
												</span>
											@endif
										</div>
										<h3 class="blog-page-title mb-30">
											<a href="{{ route('web.blog.show', $blog->slug) }}" class="link-no-decoration">
												{{ $blog->title }}
											</a>
										</h3>
										@if($blog->excerpt)
											<div class="blog-text">
												<p class="mb-0">{{ $blog->excerpt }}</p>
											</div>
										@elseif($blog->content)
											<div class="blog-text">
												<p class="mb-0">{{ Str::limit(strip_tags($blog->content), 200) }}</p>
											</div>
										@endif
										<div class="red-more mt-30">
											<a href="{{ route('web.blog.show', $blog->slug) }}" class="btn-4">Leer más</a>
										</div>
									</div>
								</div>
							@empty
								<div class="text-center py-5">
									<h4>No se encontraron artículos</h4>
									<p class="text-muted">
										@if($search ?? false)
											No hay artículos que coincidan con tu búsqueda.
										@else
											Aún no hay artículos publicados.
										@endif
									</p>
								</div>
							@endforelse
						</div>
					</div>

					{{-- Paginación --}}
					@if($blogs->hasPages())
						<div class="mt-4">
							{{ $blogs->appends(request()->query())->links() }}
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
	
	{{-- Structured Data (JSON-LD) para SEO --}}
	@include('web.components.seo.breadcrumb-schema', [
		'items' => [
			['name' => 'Inicio', 'url' => route('web.home')],
			['name' => 'Blog', 'url' => route('web.blog')]
		]
	])
@endsection
