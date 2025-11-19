@extends('layouts.main')

@section('title', $product->name . ' - IMPEERCOL')

@section('styles')
<style>
	/* Animaciones simples al pasar el mouse */
	.shop-datails-pic img {
		transition: transform 0.3s ease;
	}

	.shop-datails-pic:hover img {
		transform: scale(1.05);
	}

	.sh-pic {
		transition: all 0.3s ease;
		cursor: pointer;
	}

	.sh-pic:hover {
		transform: translateY(-5px);
		box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
		border-color: #dc3545 !important;
	}

	.sh-pic img {
		transition: all 0.3s ease;
	}

	.sh-pic:hover img {
		border-color: #dc3545 !important;
	}

	/* Botones con animación y color rojo */
	.sh-de-btn-1 {
		transition: all 0.3s ease;
	}

	.sh-de-btn-1:hover {
		background-color: #dc3545 !important;
		transform: translateY(-3px);
		box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
	}

	.sh-de-btn-2 {
		transition: all 0.3s ease;
		border-color: #dc3545 !important;
		color: #dc3545 !important;
	}

	.sh-de-btn-2:hover {
		background-color: #dc3545 !important;
		color: #ffffff !important;
		transform: translateY(-3px);
		box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
	}

	/* Pestañas con animación */
	.nav-pills .nav-link {
		transition: all 0.3s ease;
	}

	.nav-pills .nav-link:hover {
		background-color: rgba(220, 53, 69, 0.1);
		color: #dc3545;
	}

	.nav-pills .nav-link.active {
		background-color: #dc3545 !important;
		color: #ffffff !important;
	}

	/* Tabla con hover */
	.table tbody tr {
		transition: all 0.3s ease;
	}

	.table tbody tr:hover {
		background-color: rgba(220, 53, 69, 0.05);
		transform: translateX(5px);
	}

	/* Productos relacionados con hover */
	.products-box {
		transition: all 0.3s ease;
	}

	.products-box:hover {
		transform: translateY(-5px);
		box-shadow: 0 10px 25px rgba(220, 53, 69, 0.2);
	}

	.products-box:hover .products-pic img {
		transform: scale(1.1);
	}

	.products-pic img {
		transition: transform 0.3s ease;
	}

	.cart-btn {
		transition: all 0.3s ease;
	}

	.cart-btn:hover {
		background-color: #dc3545 !important;
		color: #ffffff !important;
		transform: translateY(-2px);
		box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
	}

	/* Precio destacado */
	.sh-de-price span {
		color: #dc3545;
		font-weight: 700;
	}

	/* Botón de descarga de ficha técnica mejorado */
	.technical-sheet-download-btn {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 15px;
		padding: 18px 40px;
		background: linear-gradient(135deg, var(--clr-def, #cd0b0b) 0%, #a00909 100%);
		color: #ffffff;
		border: none;
		border-radius: 12px;
		font-size: 1.3rem;
		font-weight: 700;
		text-decoration: none;
		transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
		box-shadow: 0 4px 15px rgba(205, 11, 11, 0.3);
		position: relative;
		overflow: hidden;
		min-width: 320px;
		text-align: center;
	}

	.technical-sheet-download-btn::before {
		content: '';
		position: absolute;
		top: 50%;
		left: 50%;
		width: 0;
		height: 0;
		border-radius: 50%;
		background: rgba(255, 255, 255, 0.2);
		transform: translate(-50%, -50%);
		transition: width 0.6s ease, height 0.6s ease;
		z-index: 0;
	}

	.technical-sheet-download-btn:hover::before {
		width: 400px;
		height: 400px;
	}

	.technical-sheet-download-btn i,
	.technical-sheet-download-btn span {
		position: relative;
		z-index: 1;
		transition: all 0.3s ease;
	}

	.technical-sheet-download-btn:hover {
		background: linear-gradient(135deg, #a00909 0%, var(--clr-def, #cd0b0b) 100%);
		color: #ffffff;
		transform: translateY(-4px);
		box-shadow: 0 8px 25px rgba(205, 11, 11, 0.5);
		text-decoration: none;
	}

	.technical-sheet-download-btn:hover i {
		transform: scale(1.2) rotate(-5deg);
	}

	.technical-sheet-download-btn i {
		font-size: 1.8rem;
		transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
	}

	/* Botón pequeño en la parte superior también mejorado */
	.sh-de-btn-2 {
		padding: 12px 24px;
		font-size: 1rem;
		font-weight: 600;
		border-radius: 8px;
		transition: all 0.3s ease;
	}

	.sh-de-btn-2:hover {
		transform: translateY(-2px);
		box-shadow: 0 6px 20px rgba(205, 11, 11, 0.4);
	}
</style>
@endsection

@section('content')
	<!-- Start Breadcrumb -->
	<div class="site-breadcrumb" style="background: url({{ asset('assets/img/breadcrumb/breadcrumb.jpg') }})">
		<div class="container">
			<h2 class="breadcrumb-title">{{ $product->name }}</h2>
			<ul class="breadcrumb-menu clearfix">
				<li><a href="{{ route('web.home') }}">Inicio</a></li>
				<li><a href="{{ route('web.products') }}">Productos</a></li>
				<li class="active">{{ $product->name }}</li>
			</ul>
		</div>
	</div>
	<!-- End Breadcrumb -->
	
	<!-- Start sh-de -->
	<div class="sh-de-area de-padding">
		<div class="container">
			<div class="sh-de-wrapper">
				<div class="sh-de-left">
					@php
						// Recopilar todas las imágenes: variantes con imagen, galería del producto, imagen principal
						$allImages = [];
						$imageLabels = [];
						
						// Agregar imágenes de variantes activas
						foreach($product->activeVariants as $variant) {
							if($variant->image) {
								$allImages[] = $variant->image_url;
								$imageLabels[] = $variant->name;
							}
						}
						
						// Agregar galería del producto
						if($product->gallery && count($product->gallery) > 0) {
							foreach($product->gallery_urls as $url) {
								$allImages[] = $url;
								$imageLabels[] = 'Galería';
							}
						}
						
						// Agregar imagen principal si existe
						if($product->image) {
							$allImages[] = $product->image_url;
							$imageLabels[] = 'Principal';
						}
						
						// Si no hay imágenes, usar una por defecto
						if(count($allImages) === 0) {
							$allImages[] = asset('assets/img/shop/1.jpg');
							$imageLabels[] = 'Producto';
						}
					@endphp
					
					@if(count($allImages) > 0)
						<div class="tab-content" id="nav-tabContent">
							@foreach($allImages as $index => $url)
								<div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="nav-{{ $index }}" role="tabpanel" aria-labelledby="nav-{{ $index }}-tab">
									<div class="shop-datails-pic">
										<img src="{{ $url }}" alt="{{ $product->name }}">
									</div>
								</div>
							@endforeach
						</div>
						<nav>
							<div class="nav grid-4 nav-tabs" id="nav-tab" role="tablist" style="flex-direction: column;">
								@foreach($allImages as $index => $url)
									<button class="nav-link {{ $index === 0 ? 'active' : '' }}" id="nav-{{ $index }}-tab" data-bs-toggle="tab" data-bs-target="#nav-{{ $index }}" type="button" role="tab" aria-controls="nav-{{ $index }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}" style="margin-bottom: 10px; border: 2px solid {{ $index === 0 ? '#0d6efd' : 'transparent' }}; padding: 5px;">
										<span class="sh-pic">
											<img src="{{ $url }}" alt="thumb" style="width: 80px; height: 80px; object-fit: cover;">
										</span>
									</button>
								@endforeach
							</div>
						</nav>
					@else
						<div class="tab-content" id="nav-tabContent">
							<div class="tab-pane fade show active" id="nav-main" role="tabpanel" aria-labelledby="nav-main-tab">
								<div class="shop-datails-pic">
									<img src="{{ asset('assets/img/shop/1.jpg') }}" alt="{{ $product->name }}">
								</div>
							</div>
						</div>
					@endif
				</div>
				<div class="sh-de-right">
					<div class="sh-de-header">
						<h4>{{ $product->name }}</h4>
						@if($product->brand_name)
							<p class="mb-2"><strong>Marca:</strong> {{ $product->brand_name }}</p>
						@endif
						@if($product->category)
							<p class="mb-2"><strong>Categoría:</strong> {{ $product->category->name }}</p>
						@endif
						<p>{{ $product->description }}</p>
					</div>
					<div class="sh-de-bottom">
						<div class="sh-de-btn">
							<a href="{{ $product->whatsapp_url }}" target="_blank" class="sh-de-btn-1">
								Cotizar <i class="fas fa-whatsapp"></i>
							</a>
							@if($product->technical_sheet_file)
								<a href="{{ asset('storage/' . $product->technical_sheet_file) }}" target="_blank" class="sh-de-btn-2" style="background-color: var(--clr-def, #cd0b0b); color: #ffffff; border-color: var(--clr-def, #cd0b0b);">
									<i class="fas fa-file-pdf"></i> Ficha Técnica
								</a>
							@endif
						</div>
						<div class="sh-de-category">
							<p class="mb-0">Categoría: {{ $product->category->name ?? 'N/A' }}</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End sh-de -->
	
	<!-- Start Product Description -->
	<div class="product-rev de-pb">
		<div class="container">
			<div class="product-rev-wrapper">
				<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
							DESCRIPCIÓN
						</button>
					</li>
					@if($product->activeVariants->count() > 0)
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="pills-variants-tab" data-bs-toggle="pill" data-bs-target="#pills-variants" type="button" role="tab" aria-controls="pills-variants" aria-selected="false">
								VARIANTES
							</button>
						</li>
					@endif
					@if($product->technical_sheet_file)
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="pills-technical-tab" data-bs-toggle="pill" data-bs-target="#pills-technical" type="button" role="tab" aria-controls="pills-technical" aria-selected="false">
								FICHA TÉCNICA
							</button>
						</li>
					@endif
				</ul>
				<div class="tab-content" id="pills-tabContent">
					<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
						<div class="pro-rev-text">
							<p>{{ $product->description }}</p>
						</div>
					</div>
					@if($product->activeVariants->count() > 0)
						<div class="tab-pane fade" id="pills-variants" role="tabpanel" aria-labelledby="pills-variants-tab">
							<div class="pro-rev-text">
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>Variante</th>
											</tr>
										</thead>
										<tbody>
											@foreach($product->activeVariants as $variant)
												<tr>
													<td>{{ $variant->name }}</td>
												</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					@endif
					@if($product->technical_sheet_file)
						<div class="tab-pane fade" id="pills-technical" role="tabpanel" aria-labelledby="pills-technical-tab">
							<div class="pro-rev-text text-center">
								<div class="mb-4">
									<i class="fas fa-file-pdf" style="font-size: 4rem; color: var(--clr-def, #cd0b0b); margin-bottom: 20px;"></i>
									<h4 class="mb-3">Ficha Técnica del Producto</h4>
									<p class="text-muted mb-4">Descarga la información técnica completa de este producto en formato PDF</p>
								</div>
								<a href="{{ asset('storage/' . $product->technical_sheet_file) }}" target="_blank" class="technical-sheet-download-btn">
									<i class="fas fa-file-pdf"></i>
									<span>Descargar Ficha Técnica PDF</span>
								</a>
							</div>
						</div>
					@endif
				</div>
			</div>
		</div>
	</div>
	<!-- End Product Description -->
	
	@if(isset($relatedProducts) && $relatedProducts->count() > 0)
		<!-- Start feature product -->
		<div class="feature-product de-pb">
			<div class="container">
				<div class="row">
					<div class="col-xl-8">
						<div class="site-title">
							<h2>Productos Relacionados</h2>
						</div>
					</div>
				</div>
				<div class="feature-product-wrapper grid-4">
					@foreach($relatedProducts as $relatedProduct)
						<div class="products-box">
							<div class="products-pic">
								<a href="{{ route('web.product.show', $relatedProduct->slug) }}">
									<img src="{{ $relatedProduct->image_url }}" alt="{{ $relatedProduct->name }}">
								</a>
								<ul class="carts d-flex align-items-center">
									<li>
										<a href="{{ route('web.product.show', $relatedProduct->slug) }}">
											<i class="icofont-eye-alt"></i>
										</a>
									</li>
								</ul>
							</div>
							<div class="products-desc">
								<a href="{{ route('web.product.show', $relatedProduct->slug) }}" target="_blank">
									<h5>{{ $relatedProduct->name }}</h5>
								</a>
								<div class="add-to-cart">
									<a href="{{ route('web.product.show', $relatedProduct->slug) }}" class="cart-btn">Ver detalle</a>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<!-- End feature product -->
	@endif
	
	@include('web.components.contact-info-strip')
@endsection
