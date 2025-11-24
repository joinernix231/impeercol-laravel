<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Blog\BlogRepository;
use App\Repositories\Banner\BannerRepository;
use App\Models\Project;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Blog;
use App\Models\Banner;

/**
 * ============================================
 * CONTROLADOR ADMIN: DashboardController
 * ============================================
 *
 * Gestiona el dashboard principal del panel administrativo.
 */
class DashboardController extends Controller
{
    protected $projectRepository;
    protected $productRepository;
    protected $categoryRepository;
    protected $brandRepository;
    protected $blogRepository;
    protected $bannerRepository;

    public function __construct(
        ProjectRepository $projectRepository,
        ProductRepository $productRepository,
        CategoryRepository $categoryRepository,
        BrandRepository $brandRepository,
        BlogRepository $blogRepository,
        BannerRepository $bannerRepository
    ) {
        $this->projectRepository = $projectRepository;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->brandRepository = $brandRepository;
        $this->blogRepository = $blogRepository;
        $this->bannerRepository = $bannerRepository;
    }

    /**
     * Muestra el dashboard principal
     */
    public function index()
    {
        // Obtener estadísticas usando los modelos directamente
        $stats = [
            'projects' => Project::count(),
            'products' => Product::count(),
            'categories' => Category::count(),
            'brands' => Brand::count(),
            'blogs' => Blog::count(),
            'banners' => Banner::count(),
            'active_banners' => $this->bannerRepository->getAllActive()->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}

