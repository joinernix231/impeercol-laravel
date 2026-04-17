@extends('layouts.main')

@section('title', 'Productos - IMPEERCOL')

@section('description', 'Catálogo completo de impermeabilizantes y recubrimientos en IMPEERCOL. Encuentra productos de las mejores marcas: Sika, Texsa, Metic, FiberGlass, Kaudal y Tekbond. Filtra por categoría, marca o busca el producto ideal para tu proyecto. Asesoría técnica gratuita y envíos a toda Colombia. Protege tus espacios con productos de alta calidad y durabilidad comprobada.')

@section('styles')
    {{-- Archivo CSS externo para mejor rendimiento y organización --}}
    <link href="{{ asset('assets/css/products.css') }}" rel="stylesheet">
@endsection

@section('content')
    <!-- Start Breadcrumb -->
    <div class="site-breadcrumb breadcrumb-bg-default">
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
                    <div class="site-title text-center mb-10">
                        <h2>Nuestros Productos</h2>
                        <p>Impermeabilizantes de alta calidad para proteger tus espacios</p>
                    </div>
                </div>
            </div>

            <div class="de-padding">
                <div class="container">
                    <div class="partner-pic partner-sldr-2 owl-carousel owl-theme carousel mt-10">
                        <a href="{{ route('web.products') }}" aria-label="Ver todos los productos" class="cursor-pointer">
                            <img src="{{ asset('assets/img/gallery/logo-mobile-convertido-de-png.webp') }}" 
                                 alt="Logo IMPEERCOL - Impermeabilizantes y recubrimientos" 
                                 loading="lazy" 
                                 decoding="async"
                                 width="150" 
                                 height="80"
                                 style="max-width: 100%; height: auto;">
                        </a>
                        @php
                            $sikaId = $brandsMap['sika'] ?? null;
                        @endphp
                        <a href="{{ $sikaId ? route('web.products', ['brand' => $sikaId]) : route('web.products') }}" aria-label="Sika" class="cursor-pointer">
                            <img src="{{ asset('assets/img/gallery/Sika_NoClaim_pos_rgb_mobile-convertido-de-webp.webp') }}" 
                                 alt="Sika - Impermeabilizantes de alta calidad" 
                                 loading="lazy" 
                                 decoding="async"
                                 width="150" 
                                 height="80"
                                 style="max-width: 100%; height: auto;">
                        </a>
                        @php
                            $texsaId = $brandsMap['texsa'] ?? null;
                        @endphp
                        <a href="{{ $texsaId ? route('web.products', ['brand' => $texsaId]) : route('web.products') }}" aria-label="Texsa" class="cursor-pointer">
                            <img src="{{ asset('assets/img/gallery/Logo-Texsa-Original.png-convertido-de-webp.webp') }}" 
                                 alt="Texsa - Sistemas de impermeabilización" 
                                 loading="lazy" 
                                 decoding="async"
                                 width="150" 
                                 height="80"
                                 style="max-width: 100%; height: auto;">
                        </a>
                        @php
                            $meticId = $brandsMap['metic'] ?? null;
                        @endphp
                        <a href="{{ $meticId ? route('web.products', ['brand' => $meticId]) : route('web.products') }}" aria-label="Metic" class="cursor-pointer">
                            <img src="{{ asset('assets/img/gallery/Metic (1).webp') }}" 
                                 alt="Metic - Recubrimientos y sellantes" 
                                 loading="lazy" 
                                 decoding="async"
                                 width="150" 
                                 height="80"
                                 style="max-width: 100%; height: auto;">
                        </a>
                        @php
                            $fiberglassId = $brandsMap['fiberglass'] ?? $brandsMap['fiverglass'] ?? null;
                        @endphp
                        <a href="{{ $fiberglassId ? route('web.products', ['brand' => $fiberglassId]) : route('web.products') }}" aria-label="FiberGlass" class="cursor-pointer">
                            <img src="{{ asset('assets/img/gallery/FiverGlass-convertido-de-webp.webp') }}" 
                                 alt="FiberGlass - Materiales de refuerzo" 
                                 loading="lazy" 
                                 decoding="async"
                                 width="150" 
                                 height="80"
                                 style="max-width: 100%; height: auto;">
                        </a>
                        @php
                            $kaudalId = $brandsMap['kaudal'] ?? null;
                        @endphp
                        <a href="{{ $kaudalId ? route('web.products', ['brand' => $kaudalId]) : route('web.products') }}" aria-label="Kaudal" class="cursor-pointer">
                            <img src="{{ asset('assets/img/gallery/Kaudal-convertido-de-webp.webp') }}" 
                                 alt="Kaudal - Impermeabilizantes especializados" 
                                 loading="lazy" 
                                 decoding="async"
                                 width="150" 
                                 height="80"
                                 style="max-width: 100%; height: auto;">
                        </a>
                        @php
                            $tekbondId = $brandsMap['tekbond'] ?? null;
                        @endphp
                        <a href="{{ $tekbondId ? route('web.products', ['brand' => $tekbondId]) : route('web.products') }}" aria-label="Tekbond" class="cursor-pointer">
                            <img src="{{ asset('assets/img/gallery/tekbond-logo-convertido-de-webp.webp') }}" 
                                 alt="Tekbond - Adhesivos y sellantes" 
                                 loading="lazy" 
                                 decoding="async"
                                 width="150" 
                                 height="80"
                                 style="max-width: 100%; height: auto;">
                        </a>
                        @php
                            $sikaIndustryId = $brandsMap['sika'] ?? null;
                        @endphp
                        <a href="{{ $sikaIndustryId ? route('web.products', ['brand' => $sikaIndustryId]) : route('web.products') }}" aria-label="Sika Industry" class="sika-industry-logo cursor-pointer">
                            <img src="{{ asset('assets/img/gallery/sikaind.png') }}" 
                                 alt="Sika Industry - Soluciones industriales" 
                                 loading="lazy" 
                                 decoding="async"
                                 width="150" 
                                 height="80"
                                 style="max-width: 100%; height: auto;">
                        </a>
                    </div>
                </div>
            </div>
            <!-- End IMPEERCOL Brands Section -->

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
                                @php
                                    $optimizedUrl = \App\Helpers\ImageHelper::optimizedImageUrl($product->image ?? '', 300, 300);
                                    $srcset = $product->image ? \App\Helpers\ImageHelper::srcset($product->image, [300, 600, 900]) : '';
                                @endphp
                                <img src="{{ $optimizedUrl }}" 
                                     @if($srcset)srcset="{{ $srcset }}" sizes="(max-width: 768px) 300px, (max-width: 1200px) 400px, 300px"@endif
                                     alt="{{ $product->name }} - {{ $product->brand_name ?? 'IMPEERCOL' }}" 
                                     loading="lazy" 
                                     decoding="async"
                                     width="300" 
                                     height="300"
                                     style="width: 100%; height: auto; aspect-ratio: 1/1; object-fit: cover;">
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
    
    {{-- Structured Data (JSON-LD) para SEO --}}
    @include('web.components.seo.breadcrumb-schema', [
        'items' => [
            ['name' => 'Inicio', 'url' => route('web.home')],
            ['name' => 'Productos', 'url' => route('web.products')]
        ]
    ])
@endsection

@section('scripts')
    {{-- Script para la lógica de filtros de productos --}}
    <script src="{{ asset('assets/js/products.js') }}" defer></script>
@endsection
