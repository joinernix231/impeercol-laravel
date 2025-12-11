@extends('admin.layout')

@section('title', 'Ver Banner - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Detalles del Banner</h2>
    <div>
        <a href="{{ route('admin.banners.edit', $banner->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <h4 class="mb-3">{{ $banner->title }}</h4>
                
                @if($banner->subtitle)
                    <p class="text-muted mb-3">{{ $banner->subtitle }}</p>
                @endif

                @if($banner->image)
                    <div class="mb-3">
                        <label class="form-label fw-bold">Imagen de Fondo:</label>
                        <div>
                            <img src="{{ $banner->image_url }}" alt="{{ $banner->title }}" class="img-fluid rounded" style="max-height: 400px; object-fit: cover;">
                        </div>
                        <small class="text-muted d-block mt-2">Ruta: {{ $banner->image }}</small>
                    </div>
                @else
                    <p class="text-muted">No hay imagen asignada</p>
                @endif
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Información</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>ID:</strong> {{ $banner->id }}</p>
                        <p><strong>Orden:</strong> {{ $banner->order }}</p>
                        <p>
                            <strong>Estado:</strong> 
                            @if($banner->is_active)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-danger">Inactivo</span>
                            @endif
                        </p>
                        <p><strong>Creado:</strong> {{ $banner->created_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Actualizado:</strong> {{ $banner->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

