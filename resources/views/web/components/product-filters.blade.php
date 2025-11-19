{{-- 
    ============================================
    COMPONENTE: PRODUCT FILTERS
    ============================================
    
    PROPÓSITO:
    Componente reutilizable para la barra de filtros de productos.
    Incluye búsqueda, filtro por categoría y filtro por marca.
    
    PARÁMETROS REQUERIDOS:
    - $categories: Colección de categorías
    - $brands: Colección de marcas
    - $filtersString: String de filtros formateado (desde el controlador)
    
    USO:
    @include('web.components.product-filters', [
        'categories' => $categories,
        'brands' => $brands,
        'filtersString' => $filtersString
    ])
--}}

<div class="modern-filter-bar">
    <form method="GET" action="{{ route('web.products') }}" id="filterForm">
        <input type="hidden" name="filters" id="filters" value="{{ $filtersString ?? '' }}">
        
        <div class="modern-filter-bar-left">
            <div class="modern-search-box">
                <input type="text"
                       name="search"
                       id="search"
                       placeholder="Buscar productos..."
                       value="{{ request('search') }}">
                <i class="bi bi-search modern-search-icon"></i>
            </div>
        </div>
        
        <div class="modern-filter-item">
            <label for="category_id">Categoría</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">Todas las categorías</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="modern-filter-item">
            <label for="brand">Marca</label>
            <select class="form-select" id="brand" name="brand">
                <option value="">Todas las marcas</option>
                @foreach($brands as $brand)
                    <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <a href="{{ route('web.products') }}" class="modern-clear-btn">
            <i class="bi bi-arrow-counterclockwise"></i>
            <span>Limpiar Filtros</span>
        </a>
    </form>
</div>

