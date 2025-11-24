@extends('admin.layout')

@section('title', 'Ver Artículo de Blog - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Artículo: {{ $blog->title }}</h2>
    <div>
        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-warning">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
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
                        <td>{{ $blog->id }}</td>
                    </tr>
                    <tr>
                        <th>Título</th>
                        <td>{{ $blog->title }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $blog->slug }}</td>
                    </tr>
                    <tr>
                        <th>Autor</th>
                        <td>{{ $blog->author ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Fecha de Publicación</th>
                        <td>{{ $blog->published_at ? $blog->published_at->format('d/m/Y') : 'No publicada' }}</td>
                    </tr>
                    <tr>
                        <th>Resumen</th>
                        <td>{{ $blog->excerpt ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Contenido</th>
                        <td>
                            <div style="max-height: 300px; overflow-y: auto;">
                                {!! nl2br(e($blog->content)) !!}
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Estado</th>
                        <td>
                            @if($blog->is_active)
                                <span class="badge bg-success">Activo</span>
                            @else
                                <span class="badge bg-danger">Inactivo</span>
                            @endif
                            @if($blog->is_featured)
                                <span class="badge bg-info">Destacado</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Orden</th>
                        <td>{{ $blog->order }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if($blog->meta_title || $blog->meta_description)
            <div class="card mb-3">
                <div class="card-body">
                    <h4>SEO</h4>
                    <table class="table table-bordered">
                        @if($blog->meta_title)
                            <tr>
                                <th width="200">Meta Título</th>
                                <td>{{ $blog->meta_title }}</td>
                            </tr>
                        @endif
                        @if($blog->meta_description)
                            <tr>
                                <th>Meta Descripción</th>
                                <td>{{ $blog->meta_description }}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="card mb-3">
            <div class="card-body">
                <h4>Imagen Principal</h4>
                @if($blog->image)
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" class="img-fluid rounded">
                @else
                    <p class="text-muted">Sin imagen</p>
                @endif
            </div>
        </div>

        @if($blog->gallery && count($blog->gallery) > 0)
            <div class="card">
                <div class="card-body">
                    <h4>Galería ({{ count($blog->gallery) }})</h4>
                    <div class="row">
                        @foreach($blog->gallery_urls as $url)
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





