{{--
    ============================================
    COMPONENTE: BREADCRUMB SCHEMA (JSON-LD)
    ============================================
    
    Genera el structured data (Schema.org) para breadcrumbs.
    Mejora la navegación en los resultados de búsqueda de Google.
    
    USO:
    @include('web.components.seo.breadcrumb-schema', [
        'items' => [
            ['name' => 'Inicio', 'url' => route('web.home')],
            ['name' => 'Productos', 'url' => route('web.products')],
            ['name' => $product->name, 'url' => route('web.product.show', $product->slug)]
        ]
    ])
--}}

@php
    $baseUrl = config('app.url', 'https://www.impeercol.com');
    $position = 1;
@endphp

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        @foreach($items as $item)
        {
            "@type": "ListItem",
            "position": {{ $position }},
            "name": "{{ addslashes($item['name']) }}",
            "item": "{{ $baseUrl }}{{ $item['url'] }}"
        }@if(!$loop->last),@endif
        @php $position++; @endphp
        @endforeach
    ]
}
</script>

