@extends('layouts.main')

@section('title', ($blog->meta_title ?? $blog->title) . ' - IMPEERCOL')

@php
    use Illuminate\Support\Str;
    $metaDesc = $blog->meta_description ?? 
        ($blog->excerpt ? Str::limit(strip_tags($blog->excerpt), 120) . ' ' : '') . 
        ($blog->content ? Str::limit(strip_tags($blog->content), 120) . ' ' : '') . 
        'Artículo sobre impermeabilización en el blog de IMPEERCOL. Consejos, guías y soluciones para proteger tus espacios. Lee más sobre ' . $blog->title . ' y encuentra información útil sobre productos y técnicas de impermeabilización.';
    $lcpImage = \App\Helpers\ImageHelper::optimizedImageUrl($blog->image ?? '', 1200, 675);
    $lcpSrcset = $blog->image ? \App\Helpers\ImageHelper::srcset($blog->image, [768, 1200, 1600]) : '';
@endphp

@section('description', $metaDesc)

{{-- Open Graph y Twitter Cards específicos para artículos --}}
@section('og_type', 'article')
@section('og_image', $blog->image_url ?? null)
@section('twitter_image', $blog->image_url ?? null)
@section('preload')
<link rel="preload" as="image" href="{{ $lcpImage }}" @if($lcpSrcset)imagesrcset="{{ $lcpSrcset }}" imagesizes="(max-width: 768px) 100vw, 1200px"@endif fetchpriority="high">
@endsection

@section('content')
	<!-- Start Breadcrumb -->
	<div class="site-breadcrumb breadcrumb-bg-blog">
		<div class="container">
			<h2 class="breadcrumb-title">{{ $blog->title }}</h2>
			<ul class="breadcrumb-menu clearfix">
				<li><a href="{{ route('web.home') }}">Inicio</a></li>
				<li><a href="{{ route('web.blog') }}">Blog</a></li>
				<li class="active">{{ $blog->title }}</li>
			</ul>
		</div>
	</div>
	
	<!-- Start Blog Single -->
	<div class="blog-single-area de-padding">
		<div class="container">
			<div class="blog-single-wpr">
				<div class="row ps g-5">
					<div class="col-xl-8">
						<div class="theme-single blog-single">
							@if($blog->image)
								<div class="theme-pic pos-rel">
									<img src="{{ $lcpImage }}"
                                         @if($lcpSrcset)srcset="{{ $lcpSrcset }}" sizes="(max-width: 768px) 100vw, 1200px"@endif
                                         class="big-pic"
                                         alt="{{ $blog->title }}"
                                         fetchpriority="high"
                                         decoding="async"
                                         width="1200"
                                         height="675">
									@if($blog->published_at)
										@php
											$meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
											$mes = $meses[$blog->published_at->format('n') - 1];
										@endphp
										<div class="blog-user-date-yr">
											<span class="blog-user-date">{{ $blog->published_at->format('d') }} {{ strtoupper($mes) }}</span>
											<span class="blog-user-yr">{{ $blog->published_at->format('Y') }}</span>
										</div>
									@endif
								</div>
							@endif
							
							<div class="theme-info">
								<div class="theme-desc">
									<h2 class="about-title">{{ $blog->title }}</h2>
									
									<div class="theme-meta">
										<div class="theme-meta-left">
											<ul>
												@if($blog->author)
													<li><i class="fas fa-user"></i> <a href="#">{{ $blog->author }}</a></li>
												@endif
												<li><i class="fas fa-calendar"></i> {{ $blog->published_at ? $blog->published_at->format('d/m/Y') : 'Sin fecha' }}</li>
											</ul>
										</div>
										<div class="theme-meta-right">
											<a href="#" class="shr-btn" onclick="shareArticle(); return false;" data-blog-title="{{ $blog->title }}" data-blog-text="{{ $blog->excerpt ?? '' }}">
												<i class="icofont-share-alt"></i> Compartir
											</a>
										</div>
									</div>
									
									@if($blog->excerpt)
										<p class="mb-30">{{ $blog->excerpt }}</p>
									@endif
									
									<div class="blog-text">
										@php
											$rawContent = $blog->content ?? '';
										@endphp

										@if(!empty($rawContent))
											@php
												// Si el contenido ya trae etiquetas HTML, lo renderizamos tal cual.
												$looksLikeHtml = Str::contains($rawContent, [
													'<p', '<h1', '<h2', '<h3', '<h4', '<ul', '<ol', '<li', '<strong', '<em', '<br', '<div', '<span'
												]);
											@endphp

											@if($looksLikeHtml)
												{!! $rawContent !!}
											@else
												<p class="mb-30">{!! nl2br(e($rawContent)) !!}</p>
											@endif
										@endif
									</div>

									@if($blog->gallery && count($blog->gallery) > 0)
										<div class="blog-gallery mt-4 mb-30">
											<h4 class="mb-20">Galería de Imágenes</h4>
											<div class="row g-3">
												@foreach($blog->gallery_urls as $url)
													@if($url)
														<div class="col-md-6">
															<img src="{{ $url }}" alt="Galería" class="img-fluid rounded" loading="lazy" decoding="async" width="600" height="400">
														</div>
													@endif
												@endforeach
											</div>
										</div>
									@endif

									<div class="content-tags mt-4">
										<h5 class="mb-0">Tags</h5>
										<ul>
											<li><a href="{{ route('web.blog') }}" class="tags-link">Impermeabilización</a></li>
											<li><a href="{{ route('web.blog') }}" class="tags-link">IMPEERCOL</a></li>
											@if($blog->category)
												<li><a href="{{ route('web.blog') }}" class="tags-link">{{ $blog->category }}</a></li>
											@endif
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-xl-4">
						<aside class="sidebar">
							{{-- Búsqueda --}}
							<div class="widget search">
								<h5 class="work-title">Buscar</h5>
								<form class="search-form" method="GET" action="{{ route('web.blog') }}">
									<input type="text" name="search" class="input-style-2" placeholder="Buscar artículos..." value="{{ request('search') }}">
									<button type="submit" class="btn-sub">
										<i class="icofont-search"></i>
									</button>
								</form>
							</div>
							
							{{-- Artículos Recientes --}}
							@if($relatedBlogs && $relatedBlogs->count() > 0)
								<div class="widget recent-post">
									<h5 class="work-title">Artículos Recientes</h5>
									@foreach($relatedBlogs as $relatedBlog)
										<div class="recent-post-single">
											@if($relatedBlog->image)
												<div class="recent-post-pic">
													<a href="{{ route('web.blog.show', $relatedBlog->slug) }}">
														<img src="{{ $relatedBlog->thumbnail_url }}" alt="{{ $relatedBlog->title }}" loading="lazy" decoding="async" width="120" height="80">
													</a>
												</div>
											@endif
											<div class="recent-post-bio">
												<h6>
													<a href="{{ route('web.blog.show', $relatedBlog->slug) }}" class="link-no-decoration">
														{{ $relatedBlog->title }}
													</a>
												</h6>
												<span>
													<i class="icofont-calendar"></i>
													@if($relatedBlog->published_at)
														@php
															$meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
															$mes = $meses[$relatedBlog->published_at->format('n') - 1];
														@endphp
														{{ $relatedBlog->published_at->format('d') }} {{ $mes }}, {{ $relatedBlog->published_at->format('Y') }}
													@else
														Sin fecha
													@endif
												</span>
											</div>
										</div>
									@endforeach
								</div>
							@endif
							
							{{-- Tags --}}
							<div class="widget sidebar-tags">
								<h5 class="work-title">Tags</h5>
								<div class="tags">
									<a href="{{ route('web.blog') }}" class="tags-link">Impermeabilización</a>
									<a href="{{ route('web.blog') }}" class="tags-link">Techos</a>
									<a href="{{ route('web.blog') }}" class="tags-link">Membranas</a>
									<a href="{{ route('web.blog') }}" class="tags-link">Acrílicos</a>
									<a href="{{ route('web.blog') }}" class="tags-link">Mantenimiento</a>
									<a href="{{ route('web.blog') }}" class="tags-link">IMPEERCOL</a>
								</div>
							</div>
							
							{{-- Botón Volver --}}
							<div class="widget">
								<a href="{{ route('web.blog') }}" class="button-btns w-100 text-center">
									<i class="bi bi-arrow-left"></i> Volver al Blog
								</a>
							</div>
						</aside>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	{{-- Structured Data (JSON-LD) para SEO --}}
	@include('web.components.seo.article-schema', ['blog' => $blog])
	@include('web.components.seo.breadcrumb-schema', [
		'items' => [
			['name' => 'Inicio', 'url' => route('web.home')],
			['name' => 'Blog', 'url' => route('web.blog')],
			['name' => $blog->title, 'url' => route('web.blog.show', $blog->slug)]
		]
	])
@endsection

@section('scripts')
{{-- Archivo JavaScript externo para mejor rendimiento y organización --}}
<script src="{{ asset('assets/js/blog-details.js') }}" defer></script>
@endsection
