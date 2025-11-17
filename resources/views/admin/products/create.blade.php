@extends('admin.layout')

@section('title', 'Crear Producto - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Crear Nuevo Producto</h2>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
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

        <form action="{{ route('admin.products.store') }}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Categoría *</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="">Seleccione una categoría</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre del Producto *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
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

                    <div class="mb-3">
                        <label for="brand" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand') }}" placeholder="Ej: Texsa, Sika, etc.">
                    </div>

                    <div class="mb-3">
                        <label for="technical_sheet_file" class="form-label">Ficha Técnica (Archivo PDF)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="technical_sheet_file" name="technical_sheet_file" value="{{ old('technical_sheet_file') }}" placeholder="Ruta del archivo PDF">
                            <button type="button" class="btn btn-outline-secondary" id="btn-upload-document">
                                <i class="bi bi-upload"></i> Subir PDF
                            </button>
                        </div>
                        <small class="form-text text-muted">Puedes escribir una ruta manualmente o usar el botón para subir un PDF</small>
                        <div id="document-preview" class="mt-2"></div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="order" class="form-label">Orden</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', 0) }}">
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                Producto Destacado
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

            {{-- Variantes del Producto --}}
            <div class="row mt-4">
                <div class="col-12">
                    <h4>Variantes del Producto (Máximo 3)</h4>
                    <p class="text-muted">Ej: Cuñete, Galón, etc.</p>
                    <div id="variants-container">
                        <div class="variant-item card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Variante 1</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">Nombre *</label>
                                        <input type="text" class="form-control" name="variants[0][name]" placeholder="Ej: Cuñete">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Precio</label>
                                        <input type="number" step="0.01" class="form-control" name="variants[0][price]" placeholder="0.00">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Orden</label>
                                        <input type="number" class="form-control" name="variants[0][order]" value="0">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Activo</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="variants[0][is_active]" value="1" checked>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="add-variant">
                        <i class="bi bi-plus"></i> Agregar Variante
                    </button>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Guardar Producto
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancelar</a>
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
        // Script para subir documentos PDF
        document.getElementById('btn-upload-document')?.addEventListener('click', function() {
            const input = document.createElement('input');
            input.type = 'file';
            input.accept = '.pdf,.doc,.docx';
            input.onchange = function(e) {
                const file = e.target.files[0];
                if (!file) return;

                const formData = new FormData();
                formData.append('document', file);

                fetch('{{ route("admin.upload.document") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && data.file) {
                        document.getElementById('technical_sheet_file').value = data.file.path;
                        const preview = document.getElementById('document-preview');
                        preview.innerHTML = `
                            <div class="alert alert-success">
                                <i class="bi bi-check-circle"></i> Documento subido: ${data.file.original_name}
                                <br><small>Ruta: ${data.file.path}</small>
                            </div>
                        `;
                    } else {
                        alert('Error al subir el documento');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al subir el documento');
                });
            };
            input.click();
        });
    </script>
    <script>
        let variantCount = 1;
        const maxVariants = 3;

        document.getElementById('add-variant')?.addEventListener('click', function() {
            if (variantCount >= maxVariants) {
                alert('Solo se permiten máximo 3 variantes por producto');
                return;
            }

            const container = document.getElementById('variants-container');
            const newVariant = document.createElement('div');
            newVariant.className = 'variant-item card mb-3';
            newVariant.innerHTML = `
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="card-title mb-0">Variante ${variantCount + 1}</h5>
                        <button type="button" class="btn btn-sm btn-danger remove-variant">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Nombre *</label>
                            <input type="text" class="form-control" name="variants[${variantCount}][name]" placeholder="Ej: Galón" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Precio</label>
                            <input type="number" step="0.01" class="form-control" name="variants[${variantCount}][price]" placeholder="0.00">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Orden</label>
                            <input type="number" class="form-control" name="variants[${variantCount}][order]" value="0">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Activo</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="variants[${variantCount}][is_active]" value="1" checked>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(newVariant);
            variantCount++;

            // Agregar evento para eliminar variante
            newVariant.querySelector('.remove-variant')?.addEventListener('click', function() {
                newVariant.remove();
                variantCount--;
            });

            // Actualizar contador de variantes
            updateVariantNumbers();
        });

        // Eliminar variantes
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-variant')) {
                e.target.closest('.variant-item')?.remove();
                variantCount--;
                updateVariantNumbers();
            }
        });

        function updateVariantNumbers() {
            const variants = document.querySelectorAll('.variant-item');
            variants.forEach((variant, index) => {
                const title = variant.querySelector('.card-title');
                if (title) {
                    title.textContent = `Variante ${index + 1}`;
                }
            });
        }
    </script>
@endpush

