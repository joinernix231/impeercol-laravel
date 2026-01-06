{{--
    ============================================
    COMPONENTE: ARTICLE SCHEMA (JSON-LD)
    ============================================
    
    Genera el structured data (Schema.org) para artículos de blog.
    Mejora el SEO y permite rich snippets en Google.
    
    USO:
    @include('web.components.seo.article-schema', ['blog' => $blog])
--}}

@php
    $baseUrl = config('app.url', 'https://www.impeercol.com');
    $articleUrl = $baseUrl . route('web.blog.show', $blog->slug, false);
    $imageUrl = $blog->image_url ?? null;
    
    // Asegurar URL absoluta para la imagen
    if ($imageUrl && !str_starts_with($imageUrl, 'http')) {
        $imageUrl = $baseUrl . '/' . ltrim($imageUrl, '/');
    }
    
    // Obtener descripción
    $description = $blog->meta_description ?? 
        ($blog->excerpt ? strip_tags($blog->excerpt) : '') ?: 
        ($blog->content ? \Illuminate\Support\Str::limit(strip_tags($blog->content), 200) : '');
    
    // Fecha de publicación
    $publishedDate = $blog->published_at ? $blog->published_at->toIso8601String() : $blog->created_at->toIso8601String();
    $modifiedDate = $blog->updated_at->toIso8601String();
@endphp

<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Article",
    "headline": "{{ addslashes($blog->title) }}",
    "description": "{{ addslashes($description) }}",
    @if($imageUrl)
    "image": "{{ $imageUrl }}",
    @endif
    "datePublished": "{{ $publishedDate }}",
    "dateModified": "{{ $modifiedDate }}",
    "author": {
        "@type": "Organization",
        "name": "IMPEERCOL",
        "url": "{{ $baseUrl }}"
    },
    "publisher": {
        "@type": "Organization",
        "name": "IMPEERCOL",
        "url": "{{ $baseUrl }}",
        "logo": {
            "@type": "ImageObject",
            "url": "{{ $baseUrl }}/assets/img/logo.png"
        }
    },
    "mainEntityOfPage": {
        "@type": "WebPage",
        "@id": "{{ $articleUrl }}"
    },
    "url": "{{ $articleUrl }}"
}
</script>

