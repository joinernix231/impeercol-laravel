{{--
    ============================================
    COMPONENTE: WEBSITE SCHEMA (JSON-LD)
    ============================================
    
    Genera el structured data (Schema.org) para WebSite.
    Mejora el SEO y permite búsqueda en el sitio desde Google.
    
    USO:
    @include('web.components.seo.website-schema')
--}}

@php
    $baseUrl = config('app.url', 'https://www.impeercol.com.co');
@endphp

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "name": "IMPEERCOL",
    "url": "{{ $baseUrl }}",
    "description": "IMPEERCOL es tu aliado en impermeabilización en Bogotá. Más de 15 años de experiencia ofreciendo productos de alta calidad de las mejores marcas como Sika, Texsa, Metic y más.",
    "inLanguage": "es-CO",
    "potentialAction": {
        "@type": "SearchAction",
        "target": {
            "@type": "EntryPoint",
            "urlTemplate": "{{ $baseUrl }}/productos?search={search_term_string}"
        },
        "query-input": "required name=search_term_string"
    }
}
</script>

