@extends('layouts.main')

@section('title', 'Productos - IMPEERCOL')

@section('styles')
<style>
	/* Barra de filtros moderna horizontal */
	.modern-filter-bar {
		background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
		border-radius: 20px;
		padding: 25px 35px;
		box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12), 0 2px 8px rgba(0, 0, 0, 0.08);
		margin-bottom: 40px;
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 30px;
		flex-wrap: wrap;
		border: 1px solid rgba(0, 0, 0, 0.05);
		backdrop-filter: blur(10px);
	}

	.modern-filter-bar-left {
		display: flex;
		align-items: center;
		gap: 25px;
		flex: 1;
	}

	.modern-filter-bar-right {
		display: flex;
		align-items: center;
		gap: 25px;
		flex-wrap: wrap;
	}

	/* Campo de búsqueda */
	.modern-search-box {
		position: relative;
		min-width: 200px;
		flex: 1;
		max-width: 350px;
	}

	.modern-search-box input {
		width: 100%;
		padding: 12px 50px 12px 18px;
		border: 2px solid #e9ecef;
		border-radius: 12px;
		font-size: 1rem;
		color: #2c3e50;
		background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
		transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
		height: 45px;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
	}

	.modern-search-box input:hover {
		border-color: var(--clr-def, #007bff);
		box-shadow: 0 4px 12px rgba(0, 123, 255, 0.15);
		transform: translateY(-1px);
	}

	.modern-search-box input:focus {
		border-color: var(--clr-def, #007bff);
		box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.2), 0 4px 16px rgba(0, 123, 255, 0.15);
		outline: none;
		background: #ffffff;
		transform: translateY(-2px);
	}

	.modern-search-box input::placeholder {
		color: #adb5bd;
		font-weight: 400;
	}

	.modern-search-icon {
		position: absolute;
		right: 18px;
		top: 50%;
		transform: translateY(-50%);
		color: var(--clr-def, #007bff);
		font-size: 1.2rem;
		pointer-events: none;
		transition: all 0.3s ease;
		opacity: 0.7;
	}

	.modern-search-box input:focus + .modern-search-icon {
		color: var(--clr-def, #007bff);
		opacity: 1;
		transform: translateY(-50%) scale(1.1);
	}

	.modern-filter-item {
		display: flex;
		align-items: center;
		gap: 15px;
		position: relative;
	}

	.modern-filter-item label {
		font-size: 1.4rem;
		font-weight: 700;
		color: #1a1a1a;
		margin: 0;
		white-space: nowrap;
		letter-spacing: 0.3px;
		text-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
		transition: all 0.3s ease;
	}

	.modern-filter-item:hover label {
		color: var(--clr-def, #007bff);
		transform: translateX(2px);
	}

	.modern-filter-item .form-select {
		min-width: 200px;
		padding: 12px 40px 12px 18px;
		border: 2px solid #e9ecef;
		border-radius: 12px;
		font-size: 1rem;
		color: #2c3e50;
		background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
		background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 12 12'%3E%3Cpath fill='%23007bff' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
		background-repeat: no-repeat;
		background-position: right 15px center;
		background-size: 12px;
		appearance: none;
		transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
		cursor: pointer;
		box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
		font-weight: 500;
	}

	.modern-filter-item .form-select:hover {
		border-color: var(--clr-def, #007bff);
		box-shadow: 0 4px 16px rgba(0, 123, 255, 0.2), 0 0 0 3px rgba(0, 123, 255, 0.1);
		transform: translateY(-2px);
		background: #ffffff;
	}

	.modern-filter-item .form-select:focus {
		border-color: var(--clr-def, #007bff);
		box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.2), 0 4px 16px rgba(0, 123, 255, 0.15);
		outline: none;
		background: #ffffff;
		transform: translateY(-2px);
	}

	.modern-clear-btn {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 10px;
		padding: 12px 24px;
		background: linear-gradient(135deg, #ffffff 0%, #fff5f5 100%);
		color: #dc3545;
		border: 2px solid #dc3545;
		border-radius: 12px;
		font-size: 1rem;
		font-weight: 700;
		text-decoration: none;
		transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
		white-space: nowrap;
		box-shadow: 0 2px 8px rgba(220, 53, 69, 0.15);
		position: relative;
		overflow: hidden;
	}

	.modern-clear-btn::before {
		content: '';
		position: absolute;
		top: 50%;
		left: 50%;
		width: 0;
		height: 0;
		border-radius: 50%;
		background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
		transform: translate(-50%, -50%);
		transition: width 0.6s ease, height 0.6s ease;
		z-index: 0;
	}

	.modern-clear-btn:hover::before {
		width: 300px;
		height: 300px;
	}

	.modern-clear-btn span,
	.modern-clear-btn i {
		position: relative;
		z-index: 1;
		transition: all 0.3s ease;
	}

	.modern-clear-btn:hover {
		background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
		color: #ffffff;
		border-color: #dc3545;
		transform: translateY(-3px);
		box-shadow: 0 8px 24px rgba(220, 53, 69, 0.4), 0 0 0 3px rgba(220, 53, 69, 0.1);
		text-decoration: none;
	}

	.modern-clear-btn:hover i {
		transform: rotate(180deg) scale(1.1);
	}

	.modern-clear-btn i {
		font-size: 1.1rem;
		transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
	}

	/* Responsive */
	@media (max-width: 768px) {
		.modern-filter-bar {
			flex-direction: column;
			align-items: stretch;
			gap: 15px;
		}

		.modern-filter-bar-left,
		.modern-filter-bar-right {
			width: 100%;
			flex-direction: column;
			align-items: stretch;
		}

		.modern-search-box {
			min-width: auto;
			max-width: 100%;
		}

		.modern-filter-item {
			flex-direction: column;
			align-items: stretch;
			width: 100%;
		}

		.modern-filter-item label {
			margin-bottom: 8px;
		}

		.modern-filter-item .form-select {
			width: 100%;
			min-width: auto;
		}

		.modern-clear-btn {
			width: 100%;
			justify-content: center;
		}
	}
</style>
@endsection

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

			{{-- Barra de Filtros Moderna --}}
			<div class="modern-filter-bar">
				<form method="GET" action="{{ route('web.products') }}" style="display: contents;">
					<div class="modern-filter-bar-left">
						<div class="modern-search-box">
							<input type="text" 
								   name="search" 
								   id="search" 
								   placeholder="Buscar productos..." 
								   value="{{ request('search') }}"
								   onkeypress="if(event.key === 'Enter') { this.form.submit(); }">
							<i class="bi bi-search modern-search-icon"></i>
						</div>
					</div>
					<div class="modern-filter-bar-right">
						<div class="modern-filter-item">
							<label for="category_id">Categoría</label>
							<select class="form-select" id="category_id" name="category_id" onchange="this.form.submit()">
								<option value="">Todas las categorías</option>
								@foreach($categories as $category)
									<option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
										{{ $category->name }}
									</option>
								@endforeach
							</select>
						</div>
						<div class="modern-filter-item">
							<label for="brand">Marca</label>
							<select class="form-select" id="brand" name="brand" onchange="this.form.submit()">
								<option value="">Todas las marcas</option>
								@foreach($brands as $brand)
									<option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>
										{{ $brand }}
									</option>
								@endforeach
							</select>
						</div>
						<a href="{{ route('web.products') }}" class="modern-clear-btn">
							<i class="bi bi-arrow-counterclockwise"></i>
							<span>Limpiar Filtros</span>
						</a>
					</div>
				</form>
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
