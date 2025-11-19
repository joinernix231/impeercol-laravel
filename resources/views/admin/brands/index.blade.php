@extends('admin.layout')

@section('title', 'Marcas - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Marcas</h2>
        <p class="text-muted mb-0">Crea y organiza las marcas disponibles para los productos.</p>
    </div>
    <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nueva Marca
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Logo</th>
                        <th>Nombre</th>
                        <th>Slug</th>
                        <th>Orden</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>
                                @if($brand->logo)
                                    <img src="{{ $brand->logo_url }}" alt="{{ $brand->name }}" style="width:60px;height:60px;object-fit:contain;border-radius:6px;background:#f8f9fa;">
                                @else
                                    <span class="text-muted">Sin logo</span>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $brand->name }}</td>
                            <td><code>{{ $brand->slug }}</code></td>
                            <td>{{ $brand->order }}</td>
                            <td>
                                @if($brand->is_active)
                                    <span class="badge bg-success">Activa</span>
                                @else
                                    <span class="badge bg-danger">Inactiva</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.brands.show', $brand) }}" class="btn btn-sm btn-outline-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-sm btn-outline-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.brands.destroy', $brand) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Deseas eliminar esta marca?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Aún no hay marcas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

