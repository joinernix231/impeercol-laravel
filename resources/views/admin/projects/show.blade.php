@extends('admin.layout')

@section('title', 'Ver Proyecto - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ $project->title }}</h2>
    <div>
        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Descripción</h5>
                <p class="card-text">{{ $project->description }}</p>
            </div>
        </div>

        @if($project->image)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Imagen Principal</h5>
                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="img-fluid">
            </div>
        </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Información del Proyecto</h5>
                <ul class="list-unstyled">
                    <li><strong>Cliente:</strong> {{ $project->client ?? 'N/A' }}</li>
                    <li><strong>Ubicación:</strong> {{ $project->location ?? 'N/A' }}</li>
                    <li><strong>Sistema:</strong> {{ $project->system ?? 'N/A' }}</li>
                    <li><strong>Fecha:</strong> {{ $project->project_date?->format('d M Y') ?? 'N/A' }}</li>
                    <li><strong>Slug:</strong> {{ $project->slug }}</li>
                    <li><strong>Orden:</strong> {{ $project->order }}</li>
                    <li><strong>Destacado:</strong> 
                        @if($project->is_featured)
                            <span class="badge bg-success">Sí</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </li>
                    <li><strong>Estado:</strong> 
                        @if($project->is_active)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-danger">Inactivo</span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

