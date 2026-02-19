{{--
    ============================================
    COMPONENTE: LOCAL BUSINESS SCHEMA (JSON-LD)
    ============================================
    
    Genera el structured data (Schema.org) para LocalBusiness.
    Mejora el SEO local y permite rich snippets en Google.
    
    USO:
    @include('web.components.seo.localbusiness-schema')
--}}

@php
    $baseUrl = config('app.url', 'https://www.impeercol.com.co');
@endphp

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "@id": "{{ $baseUrl }}#LocalBusiness",
    "name": "IMPEERCOL",
    "image": "{{ $baseUrl }}/assets/img/logo.png",
    "description": "IMPEERCOL es tu aliado en impermeabilización en Bogotá. Más de 15 años de experiencia ofreciendo productos de alta calidad de las mejores marcas como Sika, Texsa, Metic y más.",
    "url": "{{ $baseUrl }}",
    "telephone": "+573025069825",
    "email": "impeercol@gmail.com",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "Cra. 16 # 12-09",
        "addressLocality": "Bogotá",
        "addressRegion": "Cundinamarca",
        "postalCode": "110111",
        "addressCountry": "CO"
    },
    "geo": {
        "@type": "GeoCoordinates",
        "latitude": "4.6097",
        "longitude": "-74.0817"
    },
    "openingHoursSpecification": [
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": [
                "Monday",
                "Tuesday",
                "Wednesday",
                "Thursday",
                "Friday"
            ],
            "opens": "08:00",
            "closes": "18:00"
        },
        {
            "@type": "OpeningHoursSpecification",
            "dayOfWeek": "Saturday",
            "opens": "08:00",
            "closes": "14:00"
        }
    ],
    "priceRange": "$$",
    "areaServed": {
        "@type": "Country",
        "name": "Colombia"
    },
    "sameAs": [
        "https://www.facebook.com/impeercol",
        "https://www.instagram.com/impeercol",
        "https://www.linkedin.com/company/impeercol"
    ]
}
</script>

