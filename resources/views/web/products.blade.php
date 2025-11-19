@extends('layouts.main')

@section('title', 'Productos - IMPEERCOL')

@section('styles')
    {{-- Enlace al archivo CSS de productos --}}
    <link href="{{ asset('assets/css/products.css') }}" rel="stylesheet">
    <style>
        .no-products-message {
            grid-column: 1 / -1;
            text-align: center;
            padding: 6rem 2rem;
            margin: 2rem 0;
        }

        .no-products-icon {
            font-size: 6rem;
            color: var(--clr-def, #e63946);
            margin-bottom: 2rem;
            opacity: 0.6;
        }

        .no-products-message h3 {
            font-size: 2.4rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1rem;
        }

        .no-products-message p {
            font-size: 1.6rem;
            color: #666;
            line-height: 1.6;
            max-width: 600px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .no-products-message {
                padding: 4rem 1.5rem;
            }

            .no-products-icon {
                font-size: 4.5rem;
            }

            .no-products-message h3 {
                font-size: 2rem;
            }

            .no-products-message p {
                font-size: 1.4rem;
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
            @include('web.components.product-filters', [
                'categories' => $categories,
                'brands' => $brands,
                'filtersString' => $filtersString ?? ''
            ])

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
                            @if($product->brand_name)
                                <p class="text-muted mb-2"><small>Marca: {{ $product->brand_name }}</small></p>
                            @endif
                            @if($product->category)
                                <p class="text-muted mb-2"><small>Categoria: {{ $product->category->name }}</small></p>
                            @endif

                            <div class="add-to-cart pt-3">
                                <a href="{{ route('web.product.show', $product->slug) }}" class="cart-btn">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="no-products-message">
                        <div class="no-products-icon">
                            <i class="icofont-box"></i>
                        </div>
                        <h3>No se encontraron productos</h3>
                        <p>No hay productos disponibles con los filtros seleccionados. Intenta ajustar tus criterios de búsqueda.</p>
                    </div>
                @endforelse
            </div>

            {{-- Paginación --}}
            @if($products->hasPages())
                @php
                    $currentPage = $products->currentPage();
                    $lastPage = $products->lastPage();
                    $startPage = max(1, $currentPage - 2);
                    $endPage = min($lastPage, $currentPage + 2);
                @endphp
                <div class="tb-pagination mt-70">
                    <ul>
                        {{-- Botón Anterior --}}
                        @if($products->onFirstPage())
                            <li><span class="disabled"><i class="fas fa-angle-left"></i></span></li>
                        @else
                            <li><a href="{{ $products->appends(request()->query())->previousPageUrl() }}"><i class="fas fa-angle-left"></i></a></li>
                        @endif

                        {{-- Primera página si no está en el rango --}}
                        @if($startPage > 1)
                            <li><a href="{{ $products->appends(request()->query())->url(1) }}">1</a></li>
                            @if($startPage > 2)
                                <li><span class="disabled">...</span></li>
                            @endif
                        @endif

                        {{-- Números de página en el rango --}}
                        @for($page = $startPage; $page <= $endPage; $page++)
                            @if($page == $currentPage)
                                <li><a href="#" class="active">{{ $page }}</a></li>
                            @else
                                <li><a href="{{ $products->appends(request()->query())->url($page) }}">{{ $page }}</a></li>
                            @endif
                        @endfor

                        {{-- Última página si no está en el rango --}}
                        @if($endPage < $lastPage)
                            @if($endPage < $lastPage - 1)
                                <li><span class="disabled">...</span></li>
                            @endif
                            <li><a href="{{ $products->appends(request()->query())->url($lastPage) }}">{{ $lastPage }}</a></li>
                        @endif

                        {{-- Botón Siguiente --}}
                        @if($products->hasMorePages())
                            <li><a href="{{ $products->appends(request()->query())->nextPageUrl() }}"><i class="fas fa-angle-right"></i></a></li>
                        @else
                            <li><span class="disabled"><i class="fas fa-angle-right"></i></span></li>
                        @endif
                    </ul>
                </div>
            @endif
        </div>
    </div>

    @include('web.components.contact-info-strip')
@endsection

@section('scripts')
    {{-- Script para la lógica de filtros de productos --}}
    <script src="{{ asset('assets/js/products.js') }}"></script>
@endsection
