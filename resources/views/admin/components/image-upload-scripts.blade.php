<script>
    // Namespace para evitar conflictos globales
    const ImageUploader = {
        uploadRoute: '{{ route("admin.upload.images") }}',
        csrfToken: '{{ csrf_token() }}',
        
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
            const self = this; // Guardar referencia al contexto
            const fileInput = document.getElementById('image-upload-input');
            const file = fileInput?.files[0];
            
            if (!file) {
                alert('Por favor selecciona una imagen');
                return;
            }

            const formData = new FormData();
            formData.append('images[]', file);

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
                    
                    // Mostrar preview usando la URL del servidor
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
        
        // Subir imágenes de galería
        uploadGalleryImages: function() {
            const self = this; // Guardar referencia al contexto
            const fileInput = document.getElementById('gallery-images');
            const files = fileInput?.files;
            
            if (!files || files.length === 0) {
                alert('Por favor selecciona al menos una imagen');
                return;
            }

            const formData = new FormData();
            for (let i = 0; i < files.length; i++) {
                formData.append('images[]', files[i]);
            }

            fetch(self.uploadRoute, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': self.csrfToken
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Obtener galería actual
                    const galleryInput = document.getElementById('gallery');
                    let gallery = JSON.parse(galleryInput?.value || '[]');
                    
                    // Agregar nuevas imágenes
                    data.files.forEach(file => {
                        gallery.push(file.path);
                    });
                    
                    // Actualizar campo hidden
                    if (galleryInput) {
                        galleryInput.value = JSON.stringify(gallery);
                    }
                    
                    // Mostrar previews
                    self.updateGalleryPreview(gallery);
                    
                    // Limpiar input
                    if (fileInput) fileInput.value = '';
                    
                    alert(data.message || 'Imágenes subidas correctamente');
                } else {
                    alert('Error al subir las imágenes: ' + (data.message || 'Error desconocido'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al subir las imágenes');
            });
        },
        
        // Actualizar preview de galería
        updateGalleryPreview: function(gallery) {
            const preview = document.getElementById('gallery-preview');
            if (!preview) return;
            
            preview.innerHTML = '';
            
            gallery.forEach((path, index) => {
                // Construir URL desde el path
                const url = this.buildImageUrl(path);
                const col = document.createElement('div');
                col.className = 'col-md-3 mb-2';
                col.innerHTML = `
                    <div class="position-relative">
                        <img src="${url}" alt="Gallery" class="img-thumbnail w-100" style="height: 100px; object-fit: cover;" 
                             onerror="this.onerror=null; this.style.display='none'; console.error('Error cargando imagen:', '${path}');">
                        <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" onclick="ImageUploader.removeFromGallery(${index})">
                            <i class="bi bi-x"></i>
                        </button>
                    </div>
                `;
                preview.appendChild(col);
            });
        },
        
        // Remover imagen de galería
        removeFromGallery: function(index) {
            const galleryInput = document.getElementById('gallery');
            if (!galleryInput) return;
            
            let gallery = JSON.parse(galleryInput.value || '[]');
            gallery.splice(index, 1);
            galleryInput.value = JSON.stringify(gallery);
            this.updateGalleryPreview(gallery);
        },
        
        // Construir URL de imagen desde un path
        buildImageUrl: function(path) {
            if (!path) return '';
            
            // Si ya es una URL completa (http:// o https://)
            if (path.startsWith('http://') || path.startsWith('https://')) {
                return path;
            }
            
            // Si empieza con /, es una ruta absoluta
            if (path.startsWith('/')) {
                return path;
            }
            
            // Si empieza con storage/, usar /storage/
            if (path.startsWith('storage/')) {
                return '/' + path;
            }
            
            // Si empieza con assets/, usar /assets/
            if (path.startsWith('assets/')) {
                return '/' + path;
            }
            
            // Si es una ruta de storage (projects/images/...), usar /storage/
            if (path.startsWith('projects/')) {
                return '/storage/' + path;
            }
            
            // Por defecto, asumir que es una ruta de storage
            return '/storage/' + path;
        },
        
        // Mostrar preview de imagen principal
        showImagePreview: function(path, url) {
            const preview = document.getElementById('image-preview');
            if (!preview) return;
            
            // Construir URL desde el path (siempre usar ruta relativa)
            let imageUrl = this.buildImageUrl(path);
            
            // Si se proporciona una URL del servidor, extraer solo la ruta relativa si es necesario
            if (url) {
                // Si la URL es completa (http:// o https://), extraer solo el pathname
                if (url.startsWith('http://') || url.startsWith('https://')) {
                    try {
                        const urlObj = new URL(url);
                        imageUrl = urlObj.pathname; // Usar solo la ruta relativa
                    } catch (e) {
                        // Si falla el parseo, usar la URL construida desde el path
                        imageUrl = this.buildImageUrl(path);
                    }
                } else if (url.startsWith('/')) {
                    // Si ya es relativa, usarla directamente
                    imageUrl = url;
                } else {
                    // Si no empieza con /, construir desde el path
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
    
    function uploadGalleryImages() {
        ImageUploader.uploadGalleryImages();
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
        
        // Botón para subir galería
        const btnUploadGallery = document.getElementById('btn-upload-gallery');
        if (btnUploadGallery) {
            btnUploadGallery.addEventListener('click', function() {
                ImageUploader.uploadGalleryImages();
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

