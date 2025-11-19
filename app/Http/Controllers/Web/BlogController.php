<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\Blog\BlogRepository;
use App\Models\Blog;
use Illuminate\Http\Request;

/**
 * ============================================
 * CONTROLADOR WEB: BlogController
 * ============================================
 * 
 * Controla las páginas públicas del blog.
 */
class BlogController extends Controller
{
    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     * Muestra la lista de artículos del blog con paginación
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        if ($search) {
            $blogs = $this->blogRepository->search($search, 12);
        } else {
            $blogs = $this->blogRepository->getPublished(12);
        }

        return view('web.blog', compact('blogs', 'search'));
    }

    /**
     * Muestra el detalle de un artículo de blog por slug
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $blog = $this->blogRepository->findBySlug($slug);

        if (!$blog) {
            abort(404, 'Artículo no encontrado');
        }

        // Obtener artículos relacionados (más recientes, excluyendo el actual)
        $relatedBlogs = Blog::published()
            ->where('id', '!=', $blog->id)
            ->ordered()
            ->limit(3)
            ->get();

        return view('web.blog-details', compact('blog', 'relatedBlogs'));
    }
}

