<?php

namespace App\Services;

use App\Repositories\Product\ProductRepository;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Blog\BlogRepository;
use Illuminate\Support\Facades\Route;

/**
 * ============================================
 * SERVICIO: SitemapService
 * ============================================
 *
 * Servicio responsable de generar el sitemap XML del sitio web.
 * Sigue el principio de Single Responsibility: solo genera sitemaps.
 *
 * DEPENDENCIAS:
 * - ProductRepository: Para obtener productos activos
 * - ProjectRepository: Para obtener proyectos activos
 * - BlogRepository: Para obtener artículos publicados
 */
class SitemapService
{
    protected ProductRepository $productRepository;
    protected ProjectRepository $projectRepository;
    protected BlogRepository $blogRepository;

    /**
     * Constructor con inyección de dependencias
     *
     * @param ProductRepository $productRepository
     * @param ProjectRepository $projectRepository
     * @param BlogRepository $blogRepository
     */
    public function __construct(
        ProductRepository $productRepository,
        ProjectRepository $projectRepository,
        BlogRepository $blogRepository
    ) {
        $this->productRepository = $productRepository;
        $this->projectRepository = $projectRepository;
        $this->blogRepository = $blogRepository;
    }

    /**
     * Genera el sitemap XML completo
     *
     * @return string XML del sitemap
     */
    public function generate(): string
    {
        $urls = [];

        // Agregar páginas estáticas
        $urls = array_merge($urls, $this->getStaticPages());

        // Agregar productos dinámicos
        $urls = array_merge($urls, $this->getProductUrls());

        // Agregar proyectos dinámicos
        $urls = array_merge($urls, $this->getProjectUrls());

        // Agregar artículos del blog
        $urls = array_merge($urls, $this->getBlogUrls());

        return $this->buildXml($urls);
    }

    /**
     * Obtiene las URLs de las páginas estáticas
     *
     * @return array
     */
    protected function getStaticPages(): array
    {
        $urls = [
            [
                'loc' => route('web.home'),
                'priority' => '1.0',
                'changefreq' => 'daily',
                'lastmod' => now()->toAtomString(),
            ],
            [
                'loc' => route('web.about'),
                'priority' => '0.8',
                'changefreq' => 'monthly',
                'lastmod' => now()->toAtomString(),
            ],
            [
                'loc' => route('web.services'),
                'priority' => '0.8',
                'changefreq' => 'monthly',
                'lastmod' => now()->toAtomString(),
            ],
            [
                'loc' => route('web.contact'),
                'priority' => '0.7',
                'changefreq' => 'monthly',
                'lastmod' => now()->toAtomString(),
            ],
            [
                'loc' => route('web.products'),
                'priority' => '0.9',
                'changefreq' => 'weekly',
                'lastmod' => now()->toAtomString(),
            ],
            [
                'loc' => route('web.projects'),
                'priority' => '0.9',
                'changefreq' => 'weekly',
                'lastmod' => now()->toAtomString(),
            ],
            [
                'loc' => route('web.blog'),
                'priority' => '0.9',
                'changefreq' => 'weekly',
                'lastmod' => now()->toAtomString(),
            ],
        ];

        // Páginas de servicios SEO específicas
        $serviceSeoRoutes = [
            'web.services.roofs.bogota',
            'web.services.terraces.bogota',
            'web.services.industrial.bogota',
        ];

        foreach ($serviceSeoRoutes as $routeName) {
            if (Route::has($routeName)) {
                $urls[] = [
                    'loc' => route($routeName),
                    'priority' => '0.9',
                    'changefreq' => 'monthly',
                    'lastmod' => now()->toAtomString(),
                ];
            }
        }

        return $urls;
    }

    /**
     * Obtiene las URLs de los productos activos
     *
     * @return array
     */
    protected function getProductUrls(): array
    {
        $products = $this->productRepository->getAllActive();
        $urls = [];

        foreach ($products as $product) {
            $urls[] = [
                'loc' => route('web.product.show', $product->slug),
                'priority' => '0.8',
                'changefreq' => 'weekly',
                'lastmod' => $product->updated_at->toAtomString(),
            ];
        }

        return $urls;
    }

    /**
     * Obtiene las URLs de los proyectos activos
     *
     * @return array
     */
    protected function getProjectUrls(): array
    {
        $projects = $this->projectRepository->getAllActive();
        $urls = [];

        foreach ($projects as $project) {
            $urls[] = [
                'loc' => route('web.project.show', $project->slug),
                'priority' => '0.8',
                'changefreq' => 'monthly',
                'lastmod' => $project->updated_at->toAtomString(),
            ];
        }

        return $urls;
    }

    /**
     * Obtiene las URLs de los artículos del blog publicados
     *
     * @return array
     */
    protected function getBlogUrls(): array
    {
        $blogs = $this->blogRepository->getAllPublished();
        $urls = [];

        foreach ($blogs as $blog) {
            $urls[] = [
                'loc' => route('web.blog.show', $blog->slug),
                'priority' => '0.7',
                'changefreq' => 'monthly',
                'lastmod' => $blog->updated_at->toAtomString(),
            ];
        }

        return $urls;
    }

    /**
     * Construye el XML del sitemap a partir de un array de URLs
     *
     * @param array $urls
     * @return string
     */
    protected function buildXml(array $urls): string
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $xml .= "    <url>\n";
            $xml .= "        <loc>" . htmlspecialchars($url['loc'], ENT_XML1, 'UTF-8') . "</loc>\n";
            $xml .= "        <lastmod>" . htmlspecialchars($url['lastmod'], ENT_XML1, 'UTF-8') . "</lastmod>\n";
            $xml .= "        <changefreq>" . htmlspecialchars($url['changefreq'], ENT_XML1, 'UTF-8') . "</changefreq>\n";
            $xml .= "        <priority>" . htmlspecialchars($url['priority'], ENT_XML1, 'UTF-8') . "</priority>\n";
            $xml .= "    </url>\n";
        }

        $xml .= '</urlset>';

        return $xml;
    }
}

