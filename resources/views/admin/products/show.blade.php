@extends('admin.layout')

@section('title', 'Ver Producto - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Producto: {{ $product->name }}</h2>
    <div>
        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-body">
                <h4>Información General</h4>
                <table class="table table-bordered">
                    <tr>
                        <th width="200">ID</th>
                        <td>{{ $product->id }}</td>
                    </tr>
                    <tr>
                        <th>Nombre</th>
                        <td>{{ $product->name }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $product->slug }}</td>
                    </tr>
                    <tr>
                        <th>Categoría</th>
                        <td>{{ $product->category->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Marca</th>
                        <td>{{ $product->brand->name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Descripción</th>
                        <td>{{ $product->description }}</td>
                    </tr>
                    <tr>
                        <th>Estado</th>
                        <td>
                            @if($product->is_active)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-danger">Inactivo</span>
                            @endif
                            @if($product->is_featured)
                                <span class="badge bg-info">Destacado</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Orden</th>
                        <td>{{ $product->order }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if($product->technical_sheet_file)
            <div class="card mb-3">
                <div class="card-body">
                    <h4>Ficha Técnica</h4>
                    <a href="{{ asset('storage/' . $product->technical_sheet_file) }}" target="_blank" class="btn btn-outline-primary">
                        <i class="bi bi-file-pdf"></i> Ver Ficha Técnica PDF
                    </a>
                </div>
            </div>
        @endif

        @if($product->variants && $product->variants->count() > 0)
            <div class="card mb-3">
                <div class="card-body">
                    <h4>Variantes ({{ $product->variants->count() }})</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Orden</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($product->variants as $variant)
                                    <tr>
                                        <td>
                                            @if($variant->image)
                                                <img src="{{ $variant->image_url }}" alt="{{ $variant->name }}" class="img-thumbnail" style="max-width: 80px; max-height: 80px; object-fit: cover;">
                                            @else
                                                <span class="text-muted">Sin imagen</span>
                                            @endif
                                        </td>
                                        <td>{{ $variant->name }}</td>
                                        <td>{{ $variant->order }}</td>
                                        <td>
                                            @if($variant->is_active)
                                                <span class="badge bg-success">Activo</span>
                                            @else
                                                <span class="badge bg-danger">Inactivo</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <h4>Imagen Principal</h4>
                @if($product->image)
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid rounded">
                @else
                    <p class="text-muted">Sin imagen</p>
                @endif
            </div>
        </div>

        @if($product->gallery && count($product->gallery) > 0)
            <div class="card">
                <div class="card-body">
                    <h4>Galería ({{ count($product->gallery) }})</h4>
                    <div class="row">
                        @foreach($product->gallery_urls as $url)
                            <div class="col-6 mb-2">
                                <img src="{{ $url }}" alt="Gallery" class="img-thumbnail w-100" style="height: 100px; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
