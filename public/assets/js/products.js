/**
 * ============================================
 * LÓGICA DE FILTROS PARA PRODUCTOS
 * ============================================
 * 
 * Maneja la construcción y envío de filtros en la página de productos
 */

/**
 * Construye el string de filtros en formato FiltersCriteria
 * @param {string} categoryId - ID de la categoría seleccionada
 * @param {string} brandId - ID de la marca seleccionada
 * @param {string} brandName - Nombre de la marca seleccionada
 * @returns {string} - String de filtros formateado
 */
function buildFiltersString(categoryId, brandId, brandName) {
    const filterStrings = [];
    
    if (categoryId) {
        filterStrings.push('category_id|=|' + categoryId);
    }
    
    if (brandId) {
        // Lógica especial para marcas que contienen "sika"
        const brandNameLower = brandName.toLowerCase();
        if (brandNameLower.includes('sika')) {
            filterStrings.push('brand.name|like|sika');
        } else {
            filterStrings.push('brand_id|=|' + brandId);
        }
    }
    
    return filterStrings.join(';');
}

/**
 * Actualiza los filtros y envía el formulario
 */
function updateFiltersAndSubmit() {
    const form = document.getElementById('filterForm');
    if (!form) {
        console.error('Formulario de filtros no encontrado');
        return;
    }
    
    const categoryId = document.getElementById('category_id')?.value || '';
    const brandSelect = document.getElementById('brand');
    const brandId = brandSelect?.value || '';
    const filtersInput = document.getElementById('filters');
    
    // Obtener el nombre de la marca desde el option seleccionado
    let brandName = '';
    if (brandId && brandSelect) {
        const brandOption = brandSelect.options[brandSelect.selectedIndex];
        brandName = brandOption.text || '';
    }
    
    // Construir el string de filtros
    const filtersString = buildFiltersString(categoryId, brandId, brandName);
    
    // Actualizar el input hidden
    if (filtersInput) {
        filtersInput.value = filtersString;
    }
    
    // Enviar el formulario
    form.submit();
}

/**
 * Inicializa los event listeners cuando el DOM está listo
 */
document.addEventListener('DOMContentLoaded', function() {
    // Event listener para el input de búsqueda (Enter key)
    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                updateFiltersAndSubmit();
            }
        });
    }
    
    // Los event listeners para los selects se manejan con onchange en el HTML
    // pero también podemos agregarlos aquí si preferimos
    const categorySelect = document.getElementById('category_id');
    const brandSelect = document.getElementById('brand');
    
    if (categorySelect && !categorySelect.hasAttribute('data-listener-added')) {
        categorySelect.addEventListener('change', updateFiltersAndSubmit);
        categorySelect.setAttribute('data-listener-added', 'true');
    }
    
    if (brandSelect && !brandSelect.hasAttribute('data-listener-added')) {
        brandSelect.addEventListener('change', updateFiltersAndSubmit);
        brandSelect.setAttribute('data-listener-added', 'true');
    }
});

