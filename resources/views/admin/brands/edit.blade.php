@extends('admin.layout')

@section('title', 'Editar Marca - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0">Editar Marca</h2>
    <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Corrige los siguientes puntos:</strong>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.brands.update', $brand) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name', $brand->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                               id="slug" name="slug" value="{{ old('slug', $brand->slug) }}"
                               placeholder="Se genera automáticamente si lo dejas vacío">
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" name="description" rows="4">{{ old('description', $brand->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('logo') is-invalid @enderror"
                                   id="logo" name="logo" value="{{ old('logo', $brand->logo) }}"
                                   data-preview-input="logo-preview"
                                   placeholder="Ruta o URL del logo">
                            <button type="button" class="btn btn-outline-secondary upload-image-btn"
                                    data-target-input="logo" data-target-preview="logo-preview">
                                <i class="bi bi-upload"></i> Subir
                            </button>
                        </div>
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div id="logo-preview" class="mt-2"></div>
                    </div>

                    <div class="mb-3">
                        <label for="order" class="form-label">Orden</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror"
                               id="order" name="order" value="{{ old('order', $brand->order) }}" min="0">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active"
                               value="1" {{ old('is_active', $brand->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Marca activa</label>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Actualizar
                </button>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-light">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
    @include('admin.components.simple-image-upload-script')
@endpush

