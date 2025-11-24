<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Brand\BrandRepository;
use App\Repositories\Blog\BlogRepository;
use App\Repositories\Banner\BannerRepository;

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
        // Obtener estadísticas usando count() directamente en el modelo
        $stats = [
            'projects' => $this->projectRepository->model->count(),
            'products' => $this->productRepository->model->count(),
            'categories' => $this->categoryRepository->model->count(),
            'brands' => $this->brandRepository->model->count(),
            'blogs' => $this->blogRepository->model->count(),
            'banners' => $this->bannerRepository->model->count(),
            'active_banners' => $this->bannerRepository->getAllActive()->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}

