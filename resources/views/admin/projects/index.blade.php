@extends('admin.layout')

@section('title', 'Proyectos - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Gestión de Proyectos</h2>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nuevo Proyecto
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Imagen</th>
                    <th>Título</th>
                    <th>Cliente</th>
                    <th>Ubicación</th>
                    <th>Destacado</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>
                            @if($project->image)
                                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                            @else
                                <span class="text-muted">Sin imagen</span>
                            @endif
                        </td>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->client ?? 'N/A' }}</td>
                        <td>{{ $project->location ?? 'N/A' }}</td>
                        <td>
                            @if($project->is_featured)
                                <span class="badge bg-success">Sí</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td>
                            @if($project->is_active)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-danger">Inactivo</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este proyecto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No hay proyectos registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

