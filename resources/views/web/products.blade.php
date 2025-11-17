@extends('layouts.main')

@section('title', 'Productos - IMPEERCOL')

@section('content')
	<!-- Start Breadcrumb -->
	<div class="site-breadcrumb" style="background: url({{ asset('assets/img/breadcrumb/breadcrumb.jpg') }})">
		<div class="container">
			<h2 class="breadcrumb-title">Productos</h2>
			<ul class="breadcrumb-menu clearfix">
				<li><a href="{{ route('web.home') }}">Inicio</a></li>
				<li class="active">Productos</li>
			</ul>
		</div>
	</div>

	<!-- Start Shop -->
	<div class="shop-area de-padding">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="site-title text-center mb-60">
						<h2>Nuestros Productos</h2>
						<p>Impermeabilizantes de alta calidad para proteger tus espacios</p>
					</div>
				</div>
			</div>

			{{-- Filtros --}}
			<div class="row mb-4">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<form method="GET" action="{{ route('web.products') }}" class="row g-3">
								<div class="col-md-4">
									<label for="category_id" class="form-label">Categoría</label>
									<select class="form-select" id="category_id" name="category_id" onchange="this.form.submit()">
										<option value="">Todas las categorías</option>
										@foreach($categories as $category)
											<option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
												{{ $category->name }}
											</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-4">
									<label for="brand" class="form-label">Marca</label>
									<select class="form-select" id="brand" name="brand" onchange="this.form.submit()">
										<option value="">Todas las marcas</option>
										@foreach($brands as $brand)
											<option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>
												{{ $brand }}
											</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-4">
									<label class="form-label">&nbsp;</label>
									<div>
										<a href="{{ route('web.products') }}" class="btn btn-outline-secondary w-100">
											<i class="bi bi-x-circle"></i> Limpiar Filtros
										</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			{{-- Lista de Productos --}}
			<div class="products-wpr grid-4">
				@forelse($products as $product)
					<div class="products-box">
						<div class="products-pic">
							<a href="{{ route('web.product.show', $product->slug) }}">
								<img src="{{ $product->image_url }}" alt="{{ $product->name }}">
							</a>
						</div>
						<div class="products-desc">
							<h5><a href="{{ route('web.product.show', $product->slug) }}">{{ $product->name }}</a></h5>
							@if($product->brand)
								<p class="text-muted mb-2"><small>Marca:{{ $product->brand }}</small></p>
							@endif
							@if($product->category)
								<p class="text-muted mb-2"><small>Categoria: {{$product->category->name }}</small></p>
							@endif

							<div class="add-to-cart pt-3">
								<a href="{{ route('web.product.show', $product->slug) }}" class="cart-btn">Ver Detalles</a>
							</div>
						</div>
					</div>
				@empty
					<div class="col-12 text-center">
						<p class="text-muted">No se encontraron productos con los filtros seleccionados.</p>
						<a href="{{ route('web.products') }}" class="btn btn-primary">Ver Todos los Productos</a>
					</div>
				@endforelse
			</div>

			{{-- Paginación --}}
			@if($products->hasPages())
				<div class="row mt-4">
					<div class="col-12">
						<div class="d-flex justify-content-center">
							{{ $products->appends(request()->query())->links() }}
						</div>
					</div>
				</div>
			@endif
		</div>
	</div>

	@include('web.components.contact-info-strip')
@endsection
