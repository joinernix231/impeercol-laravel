<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

/**
 * ============================================
 * CONTROLADOR: PageController
 * ============================================
 * 
 * PROPÓSITO:
 * Controla las páginas estáticas del sitio web:
 * - Sobre Nosotros (about)
 * - Servicios (services)
 * - Contacto (contact)
 * 
 * CÓMO FUNCIONA:
 * Cada método retorna su vista Blade correspondiente.
 * 
 * INSTRUCCIONES PARA DESARROLLADORES:
 * 1. Para agregar lógica a una página, modifica su método correspondiente
 * 2. Para pasar datos dinámicos, agrega parámetros al return view()
 */
class PageController extends Controller
{
    /**
     * Muestra la página "Sobre Nosotros"
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        // Obtener marcas para los logos (mapear nombres a IDs)
        $brandsMap = $this->getBrandsMap();
        
        return view('web.about', compact('brandsMap'));
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

    /**
     * Muestra la página de servicios
     *
     * @return \Illuminate\View\View
     */
    public function services()
    {
        return view('web.services');
    }

    /**
     * Página SEO: Impermeabilización de techos en Bogotá
     *
     * @return \Illuminate\View\View
     */
    public function serviceRoofsBogota()
    {
        return view('web.services-impermeabilizacion-techos-bogota');
    }

    /**
     * Página SEO: Impermeabilización de terrazas en Bogotá
     *
     * @return \Illuminate\View\View
     */
    public function serviceTerracesBogota()
    {
        return view('web.services-impermeabilizacion-terrazas-bogota');
    }

    /**
     * Página SEO: Impermeabilización industrial en Bogotá
     *
     * @return \Illuminate\View\View
     */
    public function serviceIndustrialBogota()
    {
        return view('web.services-impermeabilizacion-industrial-bogota');
    }

    /**
     * Muestra la página de contacto
     *
     * @return \Illuminate\View\View
     */
    public function contact()
    {
        return view('web.contact');
    }
}

