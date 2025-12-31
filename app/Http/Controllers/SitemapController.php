<?php

namespace App\Http\Controllers;

use App\Services\SitemapService;
use Illuminate\Http\Response;

/**
 * ============================================
 * CONTROLADOR: SitemapController
 * ============================================
 *
 * Controlador responsable de servir el sitemap.xml.
 * Delega la lógica de generación al SitemapService.
 * Sigue el principio de Single Responsibility: solo maneja la petición HTTP.
 */
class SitemapController extends Controller
{
    protected SitemapService $sitemapService;

    /**
     * Constructor con inyección de dependencias
     *
     * @param SitemapService $sitemapService
     */
    public function __construct(SitemapService $sitemapService)
    {
        $this->sitemapService = $sitemapService;
    }

    /**
     * Genera y retorna el sitemap.xml
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        $xml = $this->sitemapService->generate();

        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }
}

