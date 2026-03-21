@extends('admin.layout')

@section('title', 'Solución: '.$solution->name.' - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0">{{ $solution->name }}</h2>
        <p class="text-muted mb-0">
            Slug: <code>{{ $solution->slug }}</code> ·
            En el sitio: <a href="{{ route('web.solutions.show', $solution->slug) }}" target="_blank" rel="noopener">ver página pública</a>
        </p>
    </div>
    <a href="{{ route('admin.solutions.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Volver al listado
    </a>
</div>

<div class="card">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <p class="mb-3">
            Los productos en la columna derecha son los que se muestran primero en «Productos relacionados».
            Si no hay ninguno, el sitio usa la búsqueda automática por palabras clave.
        </p>

        <form action="{{ route('admin.solutions.update', $solution) }}" method="POST" id="solution-products-form">
            @csrf
            @method('PUT')

            <div class="row g-2 align-items-stretch">
                <div class="col-md-5">
                    <label class="form-label fw-semibold">Disponibles (activos)</label>
                    <input type="search" class="form-control form-control-sm mb-2" id="filter-available" placeholder="Filtrar por nombre o marca…" autocomplete="off">
                    <select id="available" class="form-select" multiple size="18" style="min-height: 420px;">
                        @foreach($availableProducts as $p)
                            <option value="{{ $p->id }}" data-label="{{ mb_strtolower($p->name.' '.($p->brand_name ?? '')) }}">
                                {{ $p->name }}@if($p->brand_name) — {{ $p->brand_name }}@endif
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex flex-column justify-content-center align-items-center gap-2 py-5">
                    <button type="button" class="btn btn-outline-primary btn-sm w-100" id="btn-add" title="Pasar seleccionados a la derecha">
                        <i class="bi bi-chevron-right"></i> Añadir
                    </button>
                    <button type="button" class="btn btn-outline-primary btn-sm w-100" id="btn-add-all" title="Pasar todos los filtrados">
                        <i class="bi bi-chevron-double-right"></i> Añadir filtrados
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-sm w-100" id="btn-remove" title="Quitar seleccionados de la lista publicada">
                        <i class="bi bi-chevron-left"></i> Quitar
                    </button>
                    <button type="button" class="btn btn-outline-secondary btn-sm w-100" id="btn-remove-all" title="Vaciar lista publicada">
                        <i class="bi bi-chevron-double-left"></i> Quitar todos
                    </button>
                    <hr class="w-100 my-2">
                    <button type="button" class="btn btn-outline-dark btn-sm w-100" id="btn-up" title="Subir en el orden">
                        <i class="bi bi-arrow-up"></i>
                    </button>
                    <button type="button" class="btn btn-outline-dark btn-sm w-100" id="btn-down" title="Bajar en el orden">
                        <i class="bi bi-arrow-down"></i>
                    </button>
                </div>
                <div class="col-md-5">
                    <label class="form-label fw-semibold">Publicados en esta solución <span class="text-danger">*</span></label>
                    <p class="small text-muted mb-2">Orden = orden de aparición en la web (el primero sale primero).</p>
                    <select name="product_ids[]" id="selected" class="form-select" multiple size="20" style="min-height: 460px;">
                        @foreach($assignedProducts as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->name }}@if($p->brand_name) — {{ $p->brand_name }}@endif
                                @if(!$p->is_active) (inactivo) @endif
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Guardar cambios
                </button>
                <a href="{{ route('admin.solutions.index') }}" class="btn btn-light">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    const available = document.getElementById('available');
    const selected = document.getElementById('selected');
    const form = document.getElementById('solution-products-form');
    const filterInput = document.getElementById('filter-available');

    function visibleOptions(select) {
        return Array.from(select.options).filter(function (o) { return o.style.display !== 'none'; });
    }

    filterInput.addEventListener('input', function () {
        const q = this.value.trim().toLowerCase();
        Array.from(available.options).forEach(function (opt) {
            const label = opt.getAttribute('data-label') || opt.textContent.toLowerCase();
            opt.style.display = !q || label.includes(q) ? '' : 'none';
        });
    });

    document.getElementById('btn-add').addEventListener('click', function () {
        Array.from(available.selectedOptions).slice().forEach(function (opt) {
            selected.appendChild(opt);
        });
    });

    document.getElementById('btn-add-all').addEventListener('click', function () {
        const q = filterInput.value.trim();
        const vis = visibleOptions(available);
        if (!q && vis.length > 0) {
            if (!confirm('No hay texto de filtro: se añadirán todos los productos visibles (' + vis.length + '). ¿Continuar?')) {
                return;
            }
        }
        vis.forEach(function (opt) {
            selected.appendChild(opt);
        });
    });

    document.getElementById('btn-remove').addEventListener('click', function () {
        Array.from(selected.selectedOptions).slice().forEach(function (opt) {
            available.appendChild(opt);
        });
        sortAvailable();
    });

    document.getElementById('btn-remove-all').addEventListener('click', function () {
        Array.from(selected.options).forEach(function (opt) {
            available.appendChild(opt);
        });
        sortAvailable();
    });

    function sortAvailable() {
        const opts = Array.from(available.options);
        opts.sort(function (a, b) { return a.text.localeCompare(b.text, 'es'); });
        opts.forEach(function (o) { available.appendChild(o); });
    }

    document.getElementById('btn-up').addEventListener('click', function () {
        const opt = selected.selectedOptions[0];
        if (!opt || !opt.previousElementSibling) return;
        selected.insertBefore(opt, opt.previousElementSibling);
    });

    document.getElementById('btn-down').addEventListener('click', function () {
        const opt = selected.selectedOptions[0];
        if (!opt || !opt.nextElementSibling) return;
        selected.insertBefore(opt.nextElementSibling, opt);
    });

    form.addEventListener('submit', function () {
        Array.from(selected.options).forEach(function (o) { o.selected = true; });
    });
})();
</script>
@endpush
