@extends('admin.layout')

@section('title', 'Detalle de Categoría - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">{{ $category->name }}</h2>
        <p class="text-muted mb-0">Información general de la categoría.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body row g-4">
        <div class="col-md-4">
            <h5 class="text-uppercase text-muted">Imagen</h5>
            @if($category->image)
                <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="img-fluid rounded shadow-sm">
                <p class="small text-muted mt-2 mb-0">{{ $category->image }}</p>
            @else
                <p class="text-muted mb-0">No hay imagen asignada.</p>
            @endif
        </div>
        <div class="col-md-8">
            <div class="mb-3">
                <h5 class="text-uppercase text-muted">Slug</h5>
                <p class="fw-semibold mb-0"><code>{{ $category->slug }}</code></p>
            </div>

            <div class="mb-3">
                <h5 class="text-uppercase text-muted">Descripción</h5>
                <p class="mb-0">{{ $category->description ?: 'Sin descripción' }}</p>
            </div>

            <div class="d-flex gap-4 flex-wrap">
                <div>
                    <h5 class="text-uppercase text-muted">Orden</h5>
                    <p class="fw-semibold mb-0">{{ $category->order }}</p>
                </div>
                <div>
                    <h5 class="text-uppercase text-muted">Estado</h5>
                    @if($category->is_active)
                        <span class="badge bg-success">Activa</span>
                    @else
                        <span class="badge bg-danger">Inactiva</span>
                    @endif
                </div>
                <div>
                    <h5 class="text-uppercase text-muted">Fecha de creación</h5>
                    <p class="mb-0">{{ $category->created_at?->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <h5 class="text-uppercase text-muted">Última actualización</h5>
                    <p class="mb-0">{{ $category->updated_at?->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

