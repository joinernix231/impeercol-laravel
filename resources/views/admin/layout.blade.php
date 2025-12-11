<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Admin - IMPEERCOL')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            overflow-x: hidden;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: linear-gradient(180deg, #1e3a5f 0%, #2c5282 100%);
            box-shadow: 2px 0 15px rgba(0,0,0,0.1);
            z-index: 100;
            overflow-y: auto;
            overflow-x: hidden;
        }
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }
        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.5);
        }
        .sidebar h4 {
            color: #fff;
            font-weight: 700;
            font-size: 1.5rem;
            padding: 20px 20px 15px;
            margin: 0;
            border-bottom: 2px solid rgba(255,255,255,0.15);
            text-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .sidebar nav {
            padding: 15px 0;
        }
        .sidebar a {
            color: #e2e8f0;
            text-decoration: none;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            font-weight: 500;
            font-size: 0.95rem;
        }
        .sidebar a i {
            margin-right: 12px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
        }
        .sidebar a:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
            border-left-color: #60a5fa;
            padding-left: 25px;
        }
        .sidebar a.active {
            background: rgba(255,255,255,0.15);
            color: #fff;
            border-left-color: #3b82f6;
            font-weight: 600;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.1);
        }
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
            padding: 0;
            width: calc(100% - 250px);
            max-width: calc(100vw - 250px);
            position: relative;
            z-index: 1;
            background-color: #f8f9fa;
            isolation: isolate;
        }
        .content-wrapper {
            padding: 30px;
            width: 100%;
            max-width: 100%;
            box-sizing: border-box;
            overflow-x: hidden;
            position: relative;
            z-index: 1;
        }
        /* Asegurar que los modales de Bootstrap no interfieran con el sidebar */
        .modal-backdrop {
            z-index: 1040 !important;
        }
        .modal {
            z-index: 1050 !important;
        }
        /* Asegurar que el contenido del formulario esté correctamente posicionado */
        .card {
            position: relative;
            z-index: 1;
        }
        .content-wrapper .row {
            margin-left: -15px;
            margin-right: -15px;
        }
        .content-wrapper .row > [class*="col-"] {
            padding-left: 15px;
            padding-right: 15px;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            border-radius: 10px;
            margin-bottom: 20px;
            background: #fff;
        }
        .card-body {
            padding: 2rem;
        }
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="sidebar">
        <h4>IMPEERCOL Admin</h4>
        <nav>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('admin.projects.index') }}" class="{{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                <i class="bi bi-folder"></i> Proyectos
            </a>
            <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Productos
            </a>
            <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Categorías
            </a>
            <a href="{{ route('admin.brands.index') }}" class="{{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
                <i class="bi bi-award"></i> Marcas
            </a>
            <a href="{{ route('admin.blogs.index') }}" class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i> Blog
            </a>
            <a href="{{ route('admin.banners.index') }}" class="{{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
                <i class="bi bi-images"></i> Banners
            </a>
        </nav>
        
        @auth
        <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 20px; border-top: 1px solid rgba(255,255,255,0.1);">
            <div class="text-white mb-2">
                <small class="d-block text-white-50">Conectado como</small>
                <strong>{{ Auth::user()->name }}</strong>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light w-100">
                    <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                </button>
            </form>
        </div>
        @endauth
    </div>
    
    <div class="main-content">
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
    
    {{-- Modales fuera del content-wrapper para evitar problemas de z-index --}}
    @stack('modals')
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
    @stack('scripts')
</body>
</html>

