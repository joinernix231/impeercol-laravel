@extends('admin.layout')

@section('title', 'Crear Proyecto - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Crear Nuevo Proyecto</h2>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5 class="alert-heading"><i class="bi bi-exclamation-triangle me-2"></i>Errores de validación</h5>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('admin.projects.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Título *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug (URL amigable)</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Se genera automáticamente si se deja vacío">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción *</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen Principal</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}" placeholder="Ruta de la imagen o sube una nueva">
                            <button type="button" class="btn btn-outline-secondary" id="btn-upload-image">
                                <i class="bi bi-upload"></i> Subir Imagen
                            </button>
                        </div>
                        <small class="form-text text-muted">Puedes escribir una ruta manualmente o usar el botón para subir</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="image-preview" class="mt-2"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Galería de Imágenes</label>
                        <input type="file" class="form-control" id="gallery-images" multiple accept="image/*">
                        <button type="button" class="btn btn-sm btn-primary mt-2" id="btn-upload-gallery">
                            <i class="bi bi-upload"></i> Subir Imágenes
                        </button>
                        <small class="form-text text-muted">Puedes subir múltiples imágenes a la vez</small>
                        <div id="gallery-preview" class="mt-2 row"></div>
                        <input type="hidden" id="gallery" name="gallery" value="{{ old('gallery', '[]') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="client" class="form-label">Cliente</label>
                        <input type="text" class="form-control" id="client" name="client" value="{{ old('client') }}">
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Ubicación</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}">
                    </div>

                    <div class="mb-3">
                        <label for="system" class="form-label">Sistema Utilizado</label>
                        <input type="text" class="form-control" id="system" name="system" value="{{ old('system') }}">
                    </div>

                    <div class="mb-3">
                        <label for="project_date" class="form-label">Fecha del Proyecto</label>
                        <input type="date" class="form-control" id="project_date" name="project_date" value="{{ old('project_date') }}">
                    </div>

                    <div class="mb-3">
                        <label for="order" class="form-label">Orden</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', 0) }}">
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                Proyecto Destacado (aparece en home)
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Activo
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Guardar Proyecto
                </button>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('modals')
    @include('admin.components.image-upload-modal')
@endpush

@push('scripts')
    @include('admin.components.image-upload-scripts')
@endpush

