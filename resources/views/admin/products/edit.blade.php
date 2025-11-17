@extends('admin.layout')

@section('title', 'Editar Producto - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Editar Producto: {{ $product->name }}</h2>
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

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Categoría *</label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="">Seleccione una categoría</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug (URL amigable)</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $product->slug) }}">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción *</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Imagen Principal</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image', $product->image) }}">
                            <button type="button" class="btn btn-outline-secondary" id="btn-upload-image">
                                <i class="bi bi-upload"></i> Subir Imagen
                            </button>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="image-preview" class="mt-2">
                            @if($product->image)
                                <img src="{{ $product->image_url }}" alt="Preview" class="img-thumbnail" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Galería de Imágenes</label>
                        <input type="file" class="form-control" id="gallery-images" multiple accept="image/*">
                        <button type="button" class="btn btn-sm btn-primary mt-2" id="btn-upload-gallery">
                            <i class="bi bi-upload"></i> Subir Imágenes
                        </button>
                        <div id="gallery-preview" class="mt-2 row">
                            @if($product->gallery && count($product->gallery) > 0)
                                @foreach($product->gallery_urls as $index => $url)
                                    <div class="col-md-3 mb-2">
                                        <div class="position-relative">
                                            <img src="{{ $url }}" alt="Gallery" class="img-thumbnail w-100" style="height: 100px; object-fit: cover;">
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <input type="hidden" id="gallery" name="gallery" value="{{ old('gallery', json_encode($product->gallery ?? [])) }}">
                    </div>

                    <div class="mb-3">
                        <label for="brand" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $product->brand) }}" placeholder="Ej: Texsa, Sika, etc.">
                    </div>

                    <div class="mb-3">
                        <label for="technical_sheet_file" class="form-label">Ficha Técnica (Archivo PDF)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="technical_sheet_file" name="technical_sheet_file" value="{{ old('technical_sheet_file', $product->technical_sheet_file) }}" placeholder="Ruta del archivo PDF">
                            <button type="button" class="btn btn-outline-secondary" id="btn-upload-document">
                                <i class="bi bi-upload"></i> Subir PDF
                            </button>
                        </div>
                        <small class="form-text text-muted">Puedes escribir una ruta manualmente o usar el botón para subir un PDF</small>
                        <div id="document-preview" class="mt-2">
                            @if($product->technical_sheet_file)
                                <div class="alert alert-info">
                                    <i class="bi bi-file-pdf"></i> Documento actual: {{ basename($product->technical_sheet_file) }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="order" class="form-label">Orden</label>
                        <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $product->order) }}">
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">
                                Producto Destacado
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
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
                    <div id="variants-container">
                        @php
                            $variants = $product->variants ?? collect();
                        @endphp
                        @if($variants->count() > 0)
                            @foreach($variants as $index => $variant)
                                <div class="variant-item card mb-3" data-variant-index="{{ $index }}">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h5 class="card-title mb-0">Variante {{ $index + 1 }}</h5>
                                            <button type="button" class="btn btn-sm btn-danger remove-variant">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label">Nombre *</label>
                                                <input type="text" class="form-control" name="variants[{{ $index }}][name]" value="{{ $variant->name }}" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Imagen</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control variant-image-input" name="variants[{{ $index }}][image]" value="{{ $variant->image ?? '' }}" placeholder="Ruta de la imagen o sube una nueva">
                                                    <button type="button" class="btn btn-outline-secondary btn-upload-variant-image" data-variant-index="{{ $index }}">
                                                        <i class="bi bi-upload"></i> Subir
                                                    </button>
                                                </div>
                                                <div class="variant-image-preview mt-2" data-variant-index="{{ $index }}">
                                                    @if($variant->image)
                                                        <img src="{{ $variant->image_url }}" alt="Preview" class="img-thumbnail" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Orden</label>
                                                <input type="number" class="form-control" name="variants[{{ $index }}][order]" value="{{ $variant->order ?? 0 }}">
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label">Activo</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="variants[{{ $index }}][is_active]" value="1" {{ $variant->is_active ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant->id }}">
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-primary" id="add-variant">
                        <i class="bi bi-plus"></i> Agregar Variante
                    </button>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Actualizar Producto
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
        @php
            $variantsCount = $product->variants ? $product->variants->count() : 0;
        @endphp
        let variantCount = {{ $variantsCount }};
        const maxVariants = 3;
        
        console.log('Variantes cargadas:', {{ $variantsCount }});

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
                        <div class="col-md-4">
                            <label class="form-label">Imagen</label>
                            <div class="input-group">
                                <input type="text" class="form-control variant-image-input" name="variants[${variantCount}][image]" placeholder="Ruta de la imagen o sube una nueva">
                                <button type="button" class="btn btn-outline-secondary btn-upload-variant-image" data-variant-index="${variantCount}">
                                    <i class="bi bi-upload"></i> Subir
                                </button>
                            </div>
                            <div class="variant-image-preview mt-2" data-variant-index="${variantCount}"></div>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Orden</label>
                            <input type="number" class="form-control" name="variants[${variantCount}][order]" value="0">
                        </div>
                        <div class="col-md-2">
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

            newVariant.querySelector('.remove-variant')?.addEventListener('click', function() {
                newVariant.remove();
                variantCount--;
                updateVariantNumbers();
            });

            updateVariantNumbers();
        });

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
                
                // Actualizar los índices de los inputs (excepto el campo hidden del ID)
                const inputs = variant.querySelectorAll('input:not([type="hidden"][name*="[id]"]), select, textarea');
                inputs.forEach(input => {
                    if (input.name && input.name.includes('variants[')) {
                        // Reemplazar el índice en el nombre del input
                        input.name = input.name.replace(/variants\[\d+\]/, `variants[${index}]`);
                    }
                });
                
                // Actualizar el campo hidden del ID también (pero mantener el valor)
                const idInput = variant.querySelector('input[type="hidden"][name*="[id]"]');
                if (idInput) {
                    const currentId = idInput.value;
                    idInput.name = `variants[${index}][id]`;
                    idInput.value = currentId;
                }
            });
        }

        // Cargar preview de imagen si existe
        @if($product->image)
            ImageUploader.updatePreviewFromInput();
        @endif

        // Cargar preview de galería si existe
        @if($product->gallery && count($product->gallery) > 0)
            ImageUploader.updateGalleryPreview({!! json_encode($product->gallery) !!});
        @endif

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

        // Manejar subida de imágenes de variantes
        document.addEventListener('click', function(e) {
            if (e.target.closest('.btn-upload-variant-image')) {
                const button = e.target.closest('.btn-upload-variant-image');
                const variantIndex = button.getAttribute('data-variant-index');
                
                const input = document.createElement('input');
                input.type = 'file';
                input.accept = 'image/*';
                input.onchange = function(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    const formData = new FormData();
                    formData.append('images[]', file);
                    formData.append('type', 'product-variants');

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
                            const imageInput = document.querySelector(`input[name="variants[${variantIndex}][image]"]`);
                            const preview = document.querySelector(`.variant-image-preview[data-variant-index="${variantIndex}"]`);
                            
                            if (imageInput) {
                                imageInput.value = uploadedFile.path;
                            }
                            
                            if (preview) {
                                preview.innerHTML = `
                                    <img src="${uploadedFile.url}" alt="Preview" class="img-thumbnail" style="max-width: 150px; max-height: 150px; object-fit: cover;">
                                `;
                            }
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
            }
        });

        // Actualizar preview cuando se escribe manualmente una ruta
        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('variant-image-input')) {
                const variantIndex = e.target.name.match(/\[(\d+)\]/)[1];
                const preview = document.querySelector(`.variant-image-preview[data-variant-index="${variantIndex}"]`);
                const path = e.target.value;
                
                if (path && preview) {
                    // Si es una URL completa o ruta de storage
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
                        <img src="${imageUrl}" alt="Preview" class="img-thumbnail" style="max-width: 150px; max-height: 150px; object-fit: cover;" onerror="this.parentElement.innerHTML=''">
                    `;
                } else if (preview && !path) {
                    preview.innerHTML = '';
                }
            }
        });
    </script>
@endpush
