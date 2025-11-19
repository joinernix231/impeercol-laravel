@extends('admin.layout')

@section('title', 'Editar Artículo de Blog - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Artículo de Blog</h2>
    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
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

        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Título *</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $blog->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug (URL amigable)</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $blog->slug) }}" placeholder="Se genera automáticamente si se deja vacío">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Resumen</label>
                        <textarea class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" name="excerpt" rows="3" maxlength="500">{{ old('excerpt', $blog->excerpt) }}</textarea>
                        <small class="form-text text-muted">Máximo 500 caracteres</small>
                        @error('excerpt')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Contenido *</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="15" required>{{ old('content', $blog->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen Principal</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image', $blog->image) }}" placeholder="Ruta de la imagen o sube una nueva">
                            <button type="button" class="btn btn-outline-secondary" id="btn-upload-image">
                                <i class="bi bi-upload"></i> Subir Imagen
                            </button>
                        </div>
                        <small class="form-text text-muted">Puedes escribir una ruta manualmente o usar el botón para subir</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="image-preview" class="mt-2">
                            @if($blog->image)
                                <img src="{{ $blog->image_url }}" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 300px; object-fit: cover;">
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label">Thumbnail (Vista Previa)</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail" name="thumbnail" value="{{ old('thumbnail', $blog->thumbnail) }}" placeholder="Ruta del thumbnail o sube una nueva">
                            <button type="button" class="btn btn-outline-secondary" id="btn-upload-thumbnail">
                                <i class="bi bi-upload"></i> Subir Thumbnail
                            </button>
                        </div>
                        <small class="form-text text-muted">Imagen pequeña para vistas previas (opcional)</small>
                        @error('thumbnail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="thumbnail-preview" class="mt-2">
                            @if($blog->thumbnail)
                                <img src="{{ $blog->thumbnail_url }}" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Galería de Imágenes</label>
                        <input type="file" class="form-control" id="gallery-images" multiple accept="image/*">
                        <button type="button" class="btn btn-sm btn-primary mt-2" id="btn-upload-gallery">
                            <i class="bi bi-upload"></i> Subir Imágenes
                        </button>
                        <small class="form-text text-muted">Puedes subir múltiples imágenes a la vez</small>
                        <div id="gallery-preview" class="mt-2 row">
                            @if($blog->gallery && count($blog->gallery) > 0)
                                @foreach($blog->gallery_urls as $url)
                                    <div class="col-md-3 mb-2">
                                        <img src="{{ $url }}" alt="Preview" class="img-thumbnail w-100" style="height: 150px; object-fit: cover;">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <input type="hidden" id="gallery" name="gallery" value="{{ old('gallery', json_encode($blog->gallery ?? [])) }}">
                    </div>

                    <hr class="my-4">
                    <h5 class="mb-3">Información Adicional</h5>

                    <div class="mb-3">
                        <label for="video_url" class="form-label">URL del Video</label>
                        <input type="url" class="form-control @error('video_url') is-invalid @enderror" id="video_url" name="video_url" value="{{ old('video_url', $blog->video_url) }}" placeholder="https://www.youtube.com/watch?v=... o https://vimeo.com/...">
                        <small class="form-text text-muted">URL de YouTube, Vimeo u otro servicio de video</small>
                        @error('video_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="featured_quote" class="form-label">Cita Destacada</label>
                        <textarea class="form-control @error('featured_quote') is-invalid @enderror" id="featured_quote" name="featured_quote" rows="2" maxlength="500" placeholder="Una frase importante o cita destacada del artículo">{{ old('featured_quote', $blog->featured_quote) }}</textarea>
                        <small class="form-text text-muted">Máximo 500 caracteres</small>
                        @error('featured_quote')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tips" class="form-label">Tips / Consejos Prácticos</label>
                        <textarea class="form-control @error('tips') is-invalid @enderror" id="tips" name="tips" rows="4" placeholder="Consejos prácticos, tips o recomendaciones importantes">{{ old('tips', $blog->tips) }}</textarea>
                        @error('tips')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="difficulty" class="form-label">Dificultad del Proyecto</label>
                            <select class="form-select @error('difficulty') is-invalid @enderror" id="difficulty" name="difficulty">
                                <option value="">Seleccionar...</option>
                                <option value="básico" {{ old('difficulty', $blog->difficulty) == 'básico' ? 'selected' : '' }}>Básico</option>
                                <option value="intermedio" {{ old('difficulty', $blog->difficulty) == 'intermedio' ? 'selected' : '' }}>Intermedio</option>
                                <option value="avanzado" {{ old('difficulty', $blog->difficulty) == 'avanzado' ? 'selected' : '' }}>Avanzado</option>
                            </select>
                            @error('difficulty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="estimated_time" class="form-label">Tiempo Estimado</label>
                            <input type="text" class="form-control @error('estimated_time') is-invalid @enderror" id="estimated_time" name="estimated_time" value="{{ old('estimated_time', $blog->estimated_time) }}" placeholder="Ej: 2-3 horas, 1 día">
                            <small class="form-text text-muted">Ej: "2-3 horas", "1 día"</small>
                            @error('estimated_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="materials" class="form-label">Materiales Necesarios</label>
                        <textarea class="form-control @error('materials') is-invalid @enderror" id="materials" name="materials" rows="3" placeholder="Lista de materiales necesarios para el proyecto">{{ old('materials', $blog->materials) }}</textarea>
                        @error('materials')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tools" class="form-label">Herramientas Necesarias</label>
                        <textarea class="form-control @error('tools') is-invalid @enderror" id="tools" name="tools" rows="3" placeholder="Lista de herramientas necesarias para el proyecto">{{ old('tools', $blog->tools) }}</textarea>
                        @error('tools')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="author" class="form-label">Autor</label>
                        <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author', $blog->author) }}">
                        @error('author')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="published_at" class="form-label">Fecha de Publicación</label>
                        <input type="date" class="form-control @error('published_at') is-invalid @enderror" id="published_at" name="published_at" value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d') : '') }}">
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="tags" class="form-label">Tags</label>
                        <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags" value="{{ old('tags', is_array($blog->tags) ? implode(', ', $blog->tags) : '') }}" placeholder="Separar por comas: tag1, tag2, tag3">
                        <small class="form-text text-muted">Ej: impermeabilización, techos, acrílicos</small>
                        @error('tags')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="reading_time" class="form-label">Tiempo de Lectura (minutos)</label>
                        <input type="number" class="form-control @error('reading_time') is-invalid @enderror" id="reading_time" name="reading_time" value="{{ old('reading_time', $blog->reading_time) }}" min="1" max="120" placeholder="Se calcula automáticamente si se deja vacío">
                        <small class="form-text text-muted">Se calculará automáticamente si se deja vacío</small>
                        @error('reading_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="order" class="form-label">Orden</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $blog->order) }}">
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $blog->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                Artículo Destacado
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $blog->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Activo
                            </label>
                        </div>
                    </div>

                    <hr>

                    <h5>SEO</h5>
                    <div class="mb-3">
                        <label for="meta_title" class="form-label">Meta Título</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ old('meta_title', $blog->meta_title) }}" maxlength="255">
                        <small class="form-text text-muted">Título para motores de búsqueda</small>
                    </div>

                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Descripción</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" maxlength="500">{{ old('meta_description', $blog->meta_description) }}</textarea>
                        <small class="form-text text-muted">Descripción para motores de búsqueda (máx. 500 caracteres)</small>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Actualizar Artículo
                </button>
                <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
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
    @include('admin.components.image-upload-scripts')
    <script>
        document.getElementById('btn-upload-thumbnail')?.addEventListener('click', function() {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = function(e) {
                const file = e.target.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('images[]', file);
                formData.append('type', 'blogs');

                fetch('{{ route("admin.upload.images") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.files && data.files.length > 0) {
                        const uploadedFile = data.files[0];
                        document.getElementById('thumbnail').value = uploadedFile.path;
                        const preview = document.getElementById('thumbnail-preview');
                        preview.innerHTML = `
                            <img src="${uploadedFile.url}" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                        `;
                    } else {
                        alert('Error al subir el thumbnail');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al subir el thumbnail');
                });
            };
            input.click();
        });

        document.getElementById('btn-upload-image')?.addEventListener('click', function() {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = 'image/*';
            input.onchange = function(e) {
                const file = e.target.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('images[]', file);
                formData.append('type', 'blogs');

                fetch('{{ route("admin.upload.images") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.files && data.files.length > 0) {
                        const uploadedFile = data.files[0];
                        document.getElementById('image').value = uploadedFile.path;
                        const preview = document.getElementById('image-preview');
                        preview.innerHTML = `
                            <img src="${uploadedFile.url}" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 300px; object-fit: cover;">
                        `;
                    } else {
                        alert('Error al subir la imagen');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al subir la imagen');
                });
            };
            input.click();
        });

        document.getElementById('btn-upload-gallery')?.addEventListener('click', function() {
            const input = document.getElementById('gallery-images');
            if (!input.files || input.files.length === 0) {
                alert('Por favor selecciona al menos una imagen');
                return;
            }

            const formData = new FormData();
            for (let i = 0; i < input.files.length; i++) {
                formData.append('images[]', input.files[i]);
            }
            formData.append('type', 'blogs');

            fetch('{{ route("admin.upload.images") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.files && data.files.length > 0) {
                    const currentGallery = JSON.parse(document.getElementById('gallery').value || '[]');
                    const preview = document.getElementById('gallery-preview');
                    
                    data.files.forEach(file => {
                        currentGallery.push(file.path);
                        const col = document.createElement('div');
                        col.className = 'col-md-3 mb-2';
                        col.innerHTML = `
                            <img src="${file.url}" alt="Preview" class="img-thumbnail w-100" style="height: 150px; object-fit: cover;">
                        `;
                        preview.appendChild(col);
                    });
                    
                    document.getElementById('gallery').value = JSON.stringify(currentGallery);
                } else {
                    alert('Error al subir las imágenes');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al subir las imágenes');
            });
        });

        document.getElementById('image')?.addEventListener('input', function(e) {
            const preview = document.getElementById('image-preview');
            const path = e.target.value;
            
            if (path && preview) {
                let imageUrl = path;
                if (!path.startsWith('http://') && !path.startsWith('https://')) {
                    if (path.startsWith('storage/')) {
                        imageUrl = '{{ asset("") }}' + path;
                    } else if (!path.startsWith('assets/')) {
                        imageUrl = '{{ asset("storage/") }}' + path;
                    } else {
                        imageUrl = '{{ asset("") }}' + path;
                    }
                }
                
                preview.innerHTML = `
                    <img src="${imageUrl}" alt="Preview" class="img-thumbnail" style="max-width: 300px; max-height: 300px; object-fit: cover;" onerror="this.parentElement.innerHTML=''">
                `;
            } else if (preview && !path) {
                preview.innerHTML = '';
            }
        });
    </script>
@endpush

