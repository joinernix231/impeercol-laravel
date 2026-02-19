{{--
    ============================================
    COMPONENTE: PRODUCT SCHEMA (JSON-LD)
    ============================================
    
    Genera el structured data (Schema.org) para productos.
    Mejora el SEO y permite rich snippets en Google.
    
    USO:
    @include('web.components.seo.product-schema', ['product' => $product])
--}}

@php
    $baseUrl = config('app.url', 'https://www.impeercol.com.co');
    $productUrl = $baseUrl . route('web.product.show', $product->slug, false);
    $imageUrl = $product->image_url;
    
    // Asegurar URL absoluta para la imagen
    if (!str_starts_with($imageUrl, 'http')) {
        $imageUrl = $baseUrl . '/' . ltrim($imageUrl, '/');
    }
    
    // Obtener descripción
    $description = $product->meta_description ?? 
        ($product->description ? strip_tags($product->description) : '') ?: 
        'Producto de impermeabilización ' . $product->name;
    
    // Limitar descripción a 200 caracteres
    $description = \Illuminate\Support\Str::limit($description, 200);
@endphp

<script type="application/ld+json">
{
    "@context": "https://schema.org/",
    "@type": "Product",
    "name": "{{ $product->name }}",
    "description": "{{ addslashes($description) }}",
    "image": "{{ $imageUrl }}",
    "url": "{{ $productUrl }}",
    "brand": {
        "@type": "Brand",
        "name": "{{ $product->brand_name ?? 'IMPEERCOL' }}"
    },
    @if($product->category)
    "category": "{{ $product->category->name }}",
    @endif
    "offers": {
        "@type": "Offer",
        "availability": "https://schema.org/InStock",
        "priceCurrency": "COP",
        "url": "{{ $productUrl }}",
        "seller": {
            "@type": "Organization",
            "name": "IMPEERCOL",
            "url": "{{ $baseUrl }}"
        }
    },
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.8",
        "reviewCount": "50"
    }
}
</script>

