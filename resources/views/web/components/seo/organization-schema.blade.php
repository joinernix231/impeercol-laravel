{{--
    ============================================
    COMPONENTE: ORGANIZATION SCHEMA (JSON-LD)
    ============================================
    
    Genera el structured data (Schema.org) para la organización.
    Debe incluirse en la página principal (home).
    
    USO:
    @include('web.components.seo.organization-schema')
--}}

@php
    $baseUrl = config('app.url', 'https://www.impeercol.com');
@endphp

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "name": "IMPEERCOL",
    "url": "{{ $baseUrl }}",
    "logo": "{{ $baseUrl }}/assets/img/logo.png",
    "description": "IMPEERCOL es tu aliado en impermeabilización en Bogotá. Más de 15 años de experiencia ofreciendo productos de alta calidad de las mejores marcas como Sika, Texsa, Metic y más.",
    "address": {
        "@type": "PostalAddress",
        "addressCountry": "CO",
        "addressLocality": "Bogotá",
        "addressRegion": "Cundinamarca"
    },
    "contactPoint": {
        "@type": "ContactPoint",
        "contactType": "customer service",
        "availableLanguage": "Spanish"
    },
    "sameAs": [
        "https://www.facebook.com/impeercol",
        "https://www.instagram.com/impeercol",
        "https://www.linkedin.com/company/impeercol"
    ]
}
</script>

