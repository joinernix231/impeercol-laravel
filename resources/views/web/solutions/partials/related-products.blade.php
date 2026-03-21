{{-- $relatedProducts: colección de Product --}}
@if(isset($relatedProducts) && $relatedProducts->isNotEmpty())
<section class="de-padding pt-0">
    <div class="container">
        <div class="row mb-40">
            <div class="col-xl-10">
                <h2 class="hero-title mb-20">Productos relacionados en catálogo</h2>
                <p class="mb-0">
                    Referencias reales de nuestro portafolio (Sika, Texsa, Metic y otras marcas según disponibilidad).
                    Entra al detalle para ver variantes, fichas y cotización.
                </p>
            </div>
        </div>
        <div class="products-wpr grid-4">
            @foreach($relatedProducts as $product)
                <div class="products-box">
                    <div class="products-pic">
                        <a href="{{ route('web.product.show', $product->slug) }}">
                            @php
                                $optimizedUrl = \App\Helpers\ImageHelper::optimizedImageUrl($product->image ?? '', 300, 300);
                                $srcset = $product->image ? \App\Helpers\ImageHelper::srcset($product->image, [300, 600, 900]) : '';
                            @endphp
                            <img src="{{ $optimizedUrl }}"
                                 @if($srcset) srcset="{{ $srcset }}" sizes="(max-width: 768px) 300px, (max-width: 1200px) 400px, 300px" @endif
                                 alt="{{ $product->name }} - {{ $product->brand_name ?? 'IMPEERCOL' }}"
                                 loading="lazy"
                                 decoding="async"
                                 width="300"
                                 height="300"
                                 style="width: 100%; height: auto; aspect-ratio: 1/1; object-fit: cover;">
                        </a>
                    </div>
                    <div class="products-desc">
                        <h3 class="h5"><a href="{{ route('web.product.show', $product->slug) }}">{{ $product->name }}</a></h3>
                        @if($product->brand_name)
                            <p class="text-muted mb-2"><small>Marca: {{ $product->brand_name }}</small></p>
                        @endif
                        <div class="add-to-cart pt-2 d-flex flex-column gap-2">
                            <a href="{{ route('web.product.show', $product->slug) }}" class="cart-btn">Ver producto</a>
                            <a href="{{ $product->whatsapp_url }}" class="btn-whatsapp-primary text-center" target="_blank" rel="noopener noreferrer" data-conv>
                                <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                <span>Cotizar</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-40">
            <a href="{{ route('web.products') }}" class="btn-2">Ver todos los productos <i class="icofont-long-arrow-right"></i></a>
        </div>
    </div>
</section>
@endif
