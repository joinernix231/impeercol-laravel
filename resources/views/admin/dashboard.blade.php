@extends('admin.layout')

@section('title', 'Dashboard - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard</h2>
    <div class="text-muted">
        <i class="bi bi-calendar3"></i> {{ now()->format('d/m/Y H:i') }}
    </div>
</div>

<div class="row g-4">
    {{-- Tarjeta de Proyectos --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Proyectos</h6>
                        <h2 class="mb-0">{{ $stats['projects'] }}</h2>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-folder text-primary" style="font-size: 2rem;"></i>
                    </div>
                </div>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-sm btn-outline-primary mt-3 w-100">
                    <i class="bi bi-arrow-right"></i> Ver Proyectos
                </a>
            </div>
        </div>
    </div>

    {{-- Tarjeta de Productos --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Productos</h6>
                        <h2 class="mb-0">{{ $stats['products'] }}</h2>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-box-seam text-success" style="font-size: 2rem;"></i>
                    </div>
                </div>
                <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-success mt-3 w-100">
                    <i class="bi bi-arrow-right"></i> Ver Productos
                </a>
            </div>
        </div>
    </div>

    {{-- Tarjeta de Categorías --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Categorías</h6>
                        <h2 class="mb-0">{{ $stats['categories'] }}</h2>
                    </div>
                    <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-tags text-info" style="font-size: 2rem;"></i>
                    </div>
                </div>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-info mt-3 w-100">
                    <i class="bi bi-arrow-right"></i> Ver Categorías
                </a>
            </div>
        </div>
    </div>

    {{-- Tarjeta de Marcas --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Marcas</h6>
                        <h2 class="mb-0">{{ $stats['brands'] }}</h2>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-award text-warning" style="font-size: 2rem;"></i>
                    </div>
                </div>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-sm btn-outline-warning mt-3 w-100">
                    <i class="bi bi-arrow-right"></i> Ver Marcas
                </a>
            </div>
        </div>
    </div>

    {{-- Tarjeta de Blog --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Artículos de Blog</h6>
                        <h2 class="mb-0">{{ $stats['blogs'] }}</h2>
                    </div>
                    <div class="bg-purple bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-journal-text text-purple" style="font-size: 2rem;"></i>
                    </div>
                </div>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-sm btn-outline-purple mt-3 w-100">
                    <i class="bi bi-arrow-right"></i> Ver Blog
                </a>
            </div>
        </div>
    </div>

    {{-- Tarjeta de Banners --}}
    <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Banners</h6>
                        <h2 class="mb-0">{{ $stats['banners'] }}</h2>
                        <small class="text-muted">{{ $stats['active_banners'] }} activos</small>
                    </div>
                    <div class="bg-danger bg-opacity-10 p-3 rounded-circle">
                        <i class="bi bi-images text-danger" style="font-size: 2rem;"></i>
                    </div>
                </div>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-sm btn-outline-danger mt-3 w-100">
                    <i class="bi bi-arrow-right"></i> Ver Banners
                </a>
            </div>
        </div>
    </div>
</div>

{{-- Acciones Rápidas --}}
<div class="row mt-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-4">
                    <i class="bi bi-lightning-charge"></i> Acciones Rápidas
                </h5>
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary w-100">
                            <i class="bi bi-plus-circle"></i> Nuevo Proyecto
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-success w-100">
                            <i class="bi bi-plus-circle"></i> Nuevo Producto
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.blogs.create') }}" class="btn btn-info w-100">
                            <i class="bi bi-plus-circle"></i> Nuevo Artículo
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.banners.create') }}" class="btn btn-danger w-100">
                            <i class="bi bi-plus-circle"></i> Nuevo Banner
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .text-purple {
        color: #6f42c1 !important;
    }
    .btn-outline-purple {
        color: #6f42c1;
        border-color: #6f42c1;
    }
    .btn-outline-purple:hover {
        background-color: #6f42c1;
        color: white;
    }
    .bg-purple {
        background-color: #6f42c1;
    }
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.15) !important;
    }
</style>
@endsection

