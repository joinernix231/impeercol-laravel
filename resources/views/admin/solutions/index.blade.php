@extends('admin.layout')

@section('title', 'Soluciones - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">Soluciones por tipo de uso</h2>
        <p class="text-muted mb-0">
            Coinciden con las rutas públicas <code>/soluciones/techos</code>, <code>terrazas</code> y <code>muros</code>.
            Asocia productos para el bloque «Productos relacionados en catálogo» del sitio.
        </p>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Orden</th>
                        <th>Nombre</th>
                        <th>Slug (URL)</th>
                        <th>Productos vinculados</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($solutions as $solution)
                        <tr>
                            <td>{{ $solution->sort_order }}</td>
                            <td class="fw-semibold">{{ $solution->name }}</td>
                            <td><code>{{ $solution->slug }}</code></td>
                            <td>
                                <span class="badge bg-{{ $solution->products_count > 0 ? 'success' : 'secondary' }}">
                                    {{ $solution->products_count }} {{ $solution->products_count === 1 ? 'producto' : 'productos' }}
                                </span>
                                @if($solution->products_count === 0)
                                    <small class="text-muted d-block mt-1">Se usará búsqueda automática en el sitio hasta que agregues productos.</small>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.solutions.edit', $solution) }}" class="btn btn-sm btn-primary">
                                    <i class="bi bi-link-45deg"></i> Gestionar productos
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
