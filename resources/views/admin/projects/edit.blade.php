@extends('admin.layout')

@section('title', 'Editar Proyecto - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Proyecto: {{ $project->title }}</h2>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Título *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $project->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug (URL amigable)</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $project->slug) }}">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción *</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $project->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen Principal</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image', $project->image) }}">
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
                        <input type="hidden" id="gallery" name="gallery" value="{{ old('gallery', $project->gallery ? json_encode($project->gallery) : '[]') }}">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="client" class="form-label">Cliente</label>
                        <input type="text" class="form-control" id="client" name="client" value="{{ old('client', $project->client) }}">
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Ubicación</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $project->location) }}">
                    </div>

                    <div class="mb-3">
                        <label for="system" class="form-label">Sistema Utilizado</label>
                        <input type="text" class="form-control" id="system" name="system" value="{{ old('system', $project->system) }}">
                    </div>

                    <div class="mb-3">
                        <label for="project_date" class="form-label">Fecha del Proyecto</label>
                        <input type="date" class="form-control" id="project_date" name="project_date" value="{{ old('project_date', $project->project_date?->format('Y-m-d')) }}">
                    </div>

                    <div class="mb-3">
                        <label for="order" class="form-label">Orden</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $project->order) }}">
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                Proyecto Destacado (aparece en home)
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $project->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Activo
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Actualizar Proyecto
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
    
    <script>
        // Inicializar previews cuando el DOM esté listo y ImageUploader esté disponible
        document.addEventListener('DOMContentLoaded', function() {
            // Esperar un momento para asegurar que ImageUploader esté definido
            setTimeout(function() {
                // Inicializar preview de imagen principal si existe
                const imageInput = document.getElementById('image');
                if (imageInput && imageInput.value && typeof ImageUploader !== 'undefined') {
                    ImageUploader.updatePreviewFromInput();
                }
                
                // Inicializar galería si existe
                const galleryInput = document.getElementById('gallery');
                if (galleryInput && galleryInput.value && typeof ImageUploader !== 'undefined') {
                    try {
                        const gallery = JSON.parse(galleryInput.value);
                        if (Array.isArray(gallery) && gallery.length > 0) {
                            ImageUploader.updateGalleryPreview(gallery);
                        }
                    } catch (e) {
                        console.error('Error al parsear la galería:', e);
                    }
                }
            }, 100);
        });
    </script>
@endpush

