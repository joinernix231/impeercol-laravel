<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Blog\BlogRepository;
use App\Repositories\Product\ProductRepository;
use App\Models\Brand;
use App\Models\Blog;
use Illuminate\Http\Request;

/**
 * ============================================
 * CONTROLADOR: HomeController
 * ============================================
 *
 * Controla la página principal (home) del sitio web.
 * Usa Repository para obtener proyectos destacados.
 */
class HomeController extends Controller
{
    protected $projectRepository;
    protected $blogRepository;
    protected $productRepository;

    public function __construct(
        ProjectRepository $projectRepository,
        BlogRepository $blogRepository,
        ProductRepository $productRepository
    ) {
        $this->projectRepository = $projectRepository;
        $this->blogRepository = $blogRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * Muestra la página principal del sitio web
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Obtener proyectos destacados para mostrar en home (máximo 3)
        $featuredProjects = $this->projectRepository->getFeatured(10);
        
        // Obtener los últimos 3 artículos del blog publicados
        $latestBlogs = Blog::published()
            ->ordered()
            ->limit(3)
            ->get();
        
        // Obtener productos destacados para el slider
        $featuredProducts = $this->productRepository->getFeatured(8);
        
        // Obtener marcas para los logos (mapear nombres a IDs)
        $brandsMap = $this->getBrandsMap();

        return view('web.home', compact('featuredProjects', 'brandsMap', 'latestBlogs', 'featuredProducts'));
    }
    
    /**
     * Obtiene un mapa de nombres de marcas a sus IDs para los logos
     *
     * @return array
     */
    private function getBrandsMap()
    {
        $brands = Brand::active()->get();
        $map = [];
        
        foreach ($brands as $brand) {
            // Normalizar el nombre para hacer coincidencias más flexibles
            $normalizedName = strtolower(trim($brand->name));
            $map[$normalizedName] = $brand->id;
            
            // Mapear variaciones y nombres comunes de las marcas
            // Sika (puede ser "SIKA" o "SIKA constructor")
            if (strpos($normalizedName, 'sika') !== false) {
                $map['sika'] = $brand->id;
                // Si es "SIKA constructor", también mapear como "sika"
                if (strpos($normalizedName, 'constructor') !== false) {
                    $map['sika constructor'] = $brand->id;
                }
            }
            
            // Texsa
            if (strpos($normalizedName, 'texsa') !== false) {
                $map['texsa'] = $brand->id;
            }
            
            // Metic
            if (strpos($normalizedName, 'metic') !== false) {
                $map['metic'] = $brand->id;
            }
            
            // FiberGlass / Isover (puede ser "FiberGlass isober")
            if (strpos($normalizedName, 'fiberglass') !== false || strpos($normalizedName, 'isover') !== false || strpos($normalizedName, 'isober') !== false) {
                $map['fiberglass'] = $brand->id;
                $map['fiverglass'] = $brand->id;
                $map['isover'] = $brand->id;
            }
            
            // Kaudal
            if (strpos($normalizedName, 'kaudal') !== false) {
                $map['kaudal'] = $brand->id;
            }
            
            // Tekbond
            if (strpos($normalizedName, 'tekbond') !== false) {
                $map['tekbond'] = $brand->id;
            }
            
            // MAPEI
            if (strpos($normalizedName, 'mapei') !== false) {
                $map['mapei'] = $brand->id;
            }
            
            // Holsim
            if (strpos($normalizedName, 'holsim') !== false) {
                $map['holsim'] = $brand->id;
            }
            
            // AquaStop
            if (strpos($normalizedName, 'aquastop') !== false) {
                $map['aquastop'] = $brand->id;
            }
            
            // NovaFlex
            if (strpos($normalizedName, 'novaflex') !== false) {
                $map['novaflex'] = $brand->id;
            }
            
            // Soudal
            if (strpos($normalizedName, 'soudal') !== false) {
                $map['soudal'] = $brand->id;
            }
            
            // Top Cement
            if (strpos($normalizedName, 'top cement') !== false || strpos($normalizedName, 'topcement') !== false) {
                $map['top cement'] = $brand->id;
            }
        }
        
        return $map;
    }
}
