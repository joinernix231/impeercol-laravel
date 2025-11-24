@extends('admin.layout')

@section('title', 'Editar Banner - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Banner</h2>
    <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
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

        <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Título *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $banner->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="subtitle" class="form-label">Subtítulo</label>
                        <textarea class="form-control @error('subtitle') is-invalid @enderror" id="subtitle" name="subtitle" rows="2" maxlength="500">{{ old('subtitle', $banner->subtitle) }}</textarea>
                        <small class="form-text text-muted">Máximo 500 caracteres</small>
                        @error('subtitle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen de Fondo</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image', $banner->image) }}" placeholder="Ruta de la imagen o sube una nueva">
                            <button type="button" class="btn btn-outline-secondary" id="btn-upload-image">
                                <i class="bi bi-upload"></i> Subir Imagen
                            </button>
                        </div>
                        <small class="form-text text-muted">Puedes escribir una ruta manualmente o usar el botón para subir</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="image-preview" class="mt-2">
                            @if($banner->image)
                                <div class="mt-2">
                                    <img src="{{ $banner->image_url }}" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                                    <p class="mt-2"><small class="text-muted">Ruta: {{ $banner->image }}</small></p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="order" class="form-label">Orden</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $banner->order) }}" min="0">
                        <small class="form-text text-muted">Los banners se mostrarán en este orden (menor número primero)</small>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Activo
                            </label>
                        </div>
                        <small class="form-text text-muted">Solo los banners activos se mostrarán en el sitio</small>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Actualizar Banner
                </button>
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('modals')
    @include('admin.components.image-upload-modal')
@endpush

@push('scripts')
    <script>
        // Namespace para evitar conflictos globales
        const ImageUploader = {
            uploadRoute: '{{ route("admin.upload.images") }}',
            csrfToken: '{{ csrf_token() }}',
            uploadType: 'banners', // Tipo específico para banners
            
            // Abrir modal de subida de imagen
            openModal: function() {
                const modalElement = document.getElementById('imageUploadModal');
                if (modalElement) {
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                }
            },
            
            // Subir imagen principal
            uploadImage: function() {
                const self = this;
                const fileInput = document.getElementById('image-upload-input');
                const file = fileInput?.files[0];
                
                if (!file) {
                    alert('Por favor selecciona una imagen');
                    return;
                }

                const formData = new FormData();
                formData.append('images[]', file);
                formData.append('type', self.uploadType);

                const progressContainer = document.getElementById('upload-progress');
                const progressBar = progressContainer?.querySelector('.progress-bar');
                
                if (progressContainer) progressContainer.style.display = 'block';
                if (progressBar) progressBar.style.width = '0%';

                fetch(self.uploadRoute, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': self.csrfToken
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.files && data.files.length > 0) {
                        const uploadedFile = data.files[0];
                        
                        // Actualizar el campo de imagen
                        const imageInput = document.getElementById('image');
                        if (imageInput) {
                            imageInput.value = uploadedFile.path;
                        }
                        
                        // Mostrar preview
                        self.showImagePreview(uploadedFile.path, uploadedFile.url);
                        
                        // Cerrar modal
                        const modalElement = document.getElementById('imageUploadModal');
                        if (modalElement) {
                            const modalInstance = bootstrap.Modal.getInstance(modalElement);
                            if (modalInstance) modalInstance.hide();
                        }
                        
                        if (fileInput) fileInput.value = '';
                    } else {
                        alert('Error al subir la imagen: ' + (data.message || 'Error desconocido'));
                    }
                    if (progressContainer) progressContainer.style.display = 'none';
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al subir la imagen');
                    if (progressContainer) progressContainer.style.display = 'none';
                });
            },
            
            // Construir URL de imagen desde un path
            buildImageUrl: function(path) {
                if (!path) return '';
                
                if (path.startsWith('http://') || path.startsWith('https://')) {
                    return path;
                }
                
                if (path.startsWith('/')) {
                    return path;
                }
                
                if (path.startsWith('storage/')) {
                    return '/' + path;
                }
                
                if (path.startsWith('assets/')) {
                    return '/' + path;
                }
                
                if (path.startsWith('banners/')) {
                    return '/storage/' + path;
                }
                
                return '/storage/' + path;
            },
            
            // Mostrar preview de imagen principal
            showImagePreview: function(path, url) {
                const preview = document.getElementById('image-preview');
                if (!preview) return;
                
                let imageUrl = this.buildImageUrl(path);
                
                if (url) {
                    if (url.startsWith('http://') || url.startsWith('https://')) {
                        try {
                            const urlObj = new URL(url);
                            imageUrl = urlObj.pathname;
                        } catch (e) {
                            imageUrl = this.buildImageUrl(path);
                        }
                    } else if (url.startsWith('/')) {
                        imageUrl = url;
                    } else {
                        imageUrl = this.buildImageUrl(path);
                    }
                }
                
                preview.innerHTML = `
                    <div class="mt-2">
                        <img src="${imageUrl}" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px; object-fit: cover;" 
                             onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <p class="text-danger mt-2" style="display: none;"><small>No se pudo cargar la imagen. Verifica que la ruta sea correcta.</small></p>
                        <p class="mt-2"><small class="text-muted">Ruta: ${path}</small></p>
                    </div>
                `;
            },
            
            // Actualizar preview cuando el usuario escribe manualmente
            updatePreviewFromInput: function() {
                const imageInput = document.getElementById('image');
                if (!imageInput) return;
                
                const path = imageInput.value.trim();
                if (path) {
                    const url = this.buildImageUrl(path);
                    this.showImagePreview(path, url);
                } else {
                    const preview = document.getElementById('image-preview');
                    if (preview) {
                        preview.innerHTML = '';
                    }
                }
            }
        };
        
        // Funciones globales para compatibilidad con onclick
        function openImageUploader() {
            ImageUploader.openModal();
        }
        
        // Event listeners cuando el DOM esté listo
        document.addEventListener('DOMContentLoaded', function() {
            // Botón para subir imagen principal
            const btnUploadImage = document.getElementById('btn-upload-image');
            if (btnUploadImage) {
                btnUploadImage.addEventListener('click', function() {
                    ImageUploader.openModal();
                });
            }
            
            // Mostrar preview cuando el usuario escribe manualmente en el campo de imagen
            const imageInput = document.getElementById('image');
            if (imageInput) {
                // Mostrar preview si ya hay un valor (al cargar la página)
                if (imageInput.value) {
                    ImageUploader.updatePreviewFromInput();
                }
                
                // Mostrar preview cuando el usuario escribe o pega
                imageInput.addEventListener('input', function() {
                    ImageUploader.updatePreviewFromInput();
                });
                
                // También cuando pierde el foco
                imageInput.addEventListener('blur', function() {
                    ImageUploader.updatePreviewFromInput();
                });
            }
        });
    </script>
@endpush

