@extends('admin.layout')

@section('title', 'Detalle de Marca - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">{{ $brand->name }}</h2>
        <p class="text-muted mb-0">Resumen de la marca seleccionada.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body row g-4">
        <div class="col-md-4">
            <h5 class="text-uppercase text-muted">Logo</h5>
            @if($brand->logo)
                <div class="p-3 bg-light rounded text-center">
                    <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}" class="img-fluid" style="max-height:160px; object-fit:contain;">
                </div>
                <p class="small text-muted mt-2 mb-0">{{ $brand->logo }}</p>
            @else
                <p class="text-muted mb-0">No hay logo asignado.</p>
            @endif
        </div>
        <div class="col-md-8">
            <div class="mb-3">
                <h5 class="text-uppercase text-muted">Slug</h5>
                <p class="fw-semibold mb-0"><code>{{ $brand->slug ?? '—' }}</code></p>
            </div>

            <div class="mb-3">
                <h5 class="text-uppercase text-muted">Descripción</h5>
                <p class="mb-0">{{ $brand->description ?: 'Sin descripción' }}</p>
            </div>

            <div class="d-flex gap-4 flex-wrap">
                <div>
                    <h5 class="text-uppercase text-muted">Orden</h5>
                    <p class="fw-semibold mb-0">{{ $brand->order }}</p>
                </div>
                <div>
                    <h5 class="text-uppercase text-muted">Estado</h5>
                    @if($brand->is_active)
                        <span class="badge bg-success">Activa</span>
                    @else
                        <span class="badge bg-danger">Inactiva</span>
                    @endif
                </div>
                <div>
                    <h5 class="text-uppercase text-muted">Fecha de creación</h5>
                    <p class="mb-0">{{ $brand->created_at?->format('d/m/Y H:i') }}</p>
                </div>
                <div>
                    <h5 class="text-uppercase text-muted">Última actualización</h5>
                    <p class="mb-0">{{ $brand->updated_at?->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

