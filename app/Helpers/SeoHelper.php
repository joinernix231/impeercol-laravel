<?php

namespace App\Helpers;

use Illuminate\Support\Str;

/**
 * Helper para funciones relacionadas con SEO
 */
class SeoHelper
{
    /**
     * URL base del sitio (debe configurarse en .env como APP_URL)
     */
    private static function baseUrl(): string
    {
        return config('app.url', 'https://www.impeercol.com.co');
    }

    /**
     * Genera la URL canónica para SEO
     *
     * Reglas según recomendaciones de Google:
     * - Si page=1, lo remueve (la primera página es la URL base sin parámetros)
     * - Si page=2+, lo mantiene (páginas reales deben indexarse)
     * - Mantiene todos los demás parámetros de query string (filtros, búsqueda, etc.)
     *
     * @return string URL canónica completa
     */
    public static function canonicalUrl(): string
    {
        $url = request()->url();
        $queryParams = request()->query();

        // Remover page=1 ya que es equivalente a la URL base
        // Google recomienda que la primera página no tenga parámetro page
        if (isset($queryParams['page']) && (int)$queryParams['page'] === 1) {
            unset($queryParams['page']);
        }

        // Si hay parámetros de query, reconstruir la URL
        if (!empty($queryParams)) {
            $url .= '?' . http_build_query($queryParams);
        }

        return $url;
    }

    /**
     * Genera meta tags Open Graph para redes sociales
     *
     * @param string $title Título de la página
     * @param string $description Descripción
     * @param string|null $image URL de la imagen (opcional)
     * @param string|null $type Tipo de contenido (website, article, product, etc.)
     * @return array Array con los meta tags Open Graph
     */
    public static function openGraphTags(
        string $title,
        string $description,
        ?string $image = null,
        ?string $type = 'website'
    ): array {
        $url = self::canonicalUrl();
        $siteName = 'IMPEERCOL';

        // Si no hay imagen, usar una por defecto
        if (!$image) {
            $image = self::baseUrl() . '/assets/img/logo.png';
        } else {
            // Asegurar URL absoluta
            if (!str_starts_with($image, 'http')) {
                $image = self::baseUrl() . '/' . ltrim($image, '/');
            }
        }

        return [
            'og:type' => $type,
            'og:url' => $url,
            'og:title' => $title,
            'og:description' => Str::limit($description, 200),
            'og:image' => $image,
            'og:site_name' => $siteName,
            'og:locale' => 'es_CO',
        ];
    }

    /**
     * Genera meta tags Twitter Card
     *
     * @param string $title Título de la página
     * @param string $description Descripción
     * @param string|null $image URL de la imagen (opcional)
     * @param string $cardType Tipo de card (summary, summary_large_image)
     * @return array Array con los meta tags Twitter
     */
    public static function twitterCardTags(
        string $title,
        string $description,
        ?string $image = null,
        string $cardType = 'summary_large_image'
    ): array {
        // Si no hay imagen, usar una por defecto
        if (!$image) {
            $image = self::baseUrl() . '/assets/img/logo.png';
        } else {
            // Asegurar URL absoluta
            if (!str_starts_with($image, 'http')) {
                $image = self::baseUrl() . '/' . ltrim($image, '/');
            }
        }

        return [
            'twitter:card' => $cardType,
            'twitter:title' => $title,
            'twitter:description' => Str::limit($description, 200),
            'twitter:image' => $image,
        ];
    }

    /**
     * Genera meta tag robots
     *
     * @param string $content Contenido del meta robots (index, noindex, follow, nofollow, etc.)
     * @return string
     */
    public static function robotsMeta(string $content = 'index, follow'): string
    {
        return $content;
    }

    /**
     * Genera meta tags hreflang para internacionalización
     *
     * @param array $languages Array con códigos de idioma y sus URLs ['es' => 'url', 'en' => 'url']
     * @return array Array con los meta tags hreflang
     */
    public static function hreflangTags(array $languages = []): array
    {
        $tags = [];
        
        // Si no se proporcionan idiomas, usar español por defecto
        if (empty($languages)) {
            $languages = ['es' => self::canonicalUrl()];
        }

        foreach ($languages as $lang => $url) {
            $tags[] = [
                'rel' => 'alternate',
                'hreflang' => $lang,
                'href' => $url,
            ];
        }

        // Agregar x-default
        $tags[] = [
            'rel' => 'alternate',
            'hreflang' => 'x-default',
            'href' => $languages['es'] ?? self::canonicalUrl(),
        ];

        return $tags;
    }

    /**
     * Genera keywords meta tag desde un array
     *
     * @param array $keywords Array de palabras clave
     * @return string String con keywords separadas por comas
     */
    public static function keywordsMeta(array $keywords = []): string
    {
        if (empty($keywords)) {
            $keywords = [
                'impermeabilización',
                'impermeabilizantes',
                'Bogotá',
                'Colombia',
                'Sika',
                'Texsa',
                'Metic',
                'recubrimientos',
                'techos',
                'muros',
                'protección',
                'humedad',
            ];
        }

        return implode(', ', array_unique($keywords));
    }

    /**
     * Genera structured data JSON-LD para WebSite
     *
     * @param string|null $searchAction URL del formulario de búsqueda (opcional)
     * @return array Array con el structured data
     */
    public static function websiteSchema(?string $searchAction = null): array
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'IMPEERCOL',
            'url' => self::baseUrl(),
            'description' => 'IMPEERCOL es tu aliado en impermeabilización en Bogotá. Más de 15 años de experiencia ofreciendo productos de alta calidad.',
            'inLanguage' => 'es-CO',
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => self::baseUrl() . '/productos?search={search_term_string}',
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ];

        return $schema;
    }
}

