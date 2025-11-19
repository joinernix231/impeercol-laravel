@once('simple-image-upload-script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const uploadRoute = '{{ route("admin.upload.images") }}';
        const csrfToken = '{{ csrf_token() }}';

        function buildImageUrl(path) {
            if (!path) return '';
            if (path.startsWith('http://') || path.startsWith('https://')) {
                return path;
            }
            if (path.startsWith('/')) {
                return path;
            }
            if (path.startsWith('storage/') || path.startsWith('assets/')) {
                return '/' + path;
            }
            return '/storage/' + path;
        }

        function updatePreview(inputEl, previewId) {
            if (!inputEl || !previewId) return;
            const preview = document.getElementById(previewId);
            if (!preview) return;

            const value = inputEl.value.trim();
            if (!value) {
                preview.innerHTML = '';
                return;
            }

            const url = buildImageUrl(value);
            preview.innerHTML = `
                <div class="mt-2">
                    <img src="${url}" alt="Vista previa" class="img-thumbnail" style="max-width: 180px; max-height: 180px; object-fit: cover;"
                        onerror="this.closest('div').innerHTML='<p class=\'text-danger small mb-0\'>No se pudo cargar la imagen.</p>';">
                    <p class="text-muted small mb-0 mt-2">${value}</p>
                </div>
            `;
        }

        document.querySelectorAll('.upload-image-btn').forEach(function (button) {
            button.addEventListener('click', function () {
                const targetInputId = button.dataset.targetInput;
                const previewId = button.dataset.targetPreview;
                const inputEl = document.getElementById(targetInputId);

                if (!inputEl) {
                    console.warn('No se encontró el input objetivo para la carga de imagen.');
                    return;
                }

                const fileInput = document.createElement('input');
                fileInput.type = 'file';
                fileInput.accept = 'image/*';
                fileInput.addEventListener('change', function (event) {
                    const files = event.target.files;
                    const file = files && files[0];
                    if (!file) return;

                    const formData = new FormData();
                    formData.append('images[]', file);

                    fetch(uploadRoute, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (!data.success || !Array.isArray(data.files) || !data.files.length) {
                                alert('No se pudo subir la imagen.');
                                return;
                            }

                            const uploadedFile = data.files[0];
                            inputEl.value = uploadedFile.path;
                            updatePreview(inputEl, previewId);
                        })
                        .catch(() => alert('Error al subir la imagen'));
                });

                fileInput.click();
            });
        });

        document.querySelectorAll('[data-preview-input]').forEach(function (input) {
            const previewId = input.dataset.previewInput;
            input.addEventListener('input', function () {
                updatePreview(input, previewId);
            });
            if (input.value) {
                updatePreview(input, previewId);
            }
        });
    });
</script>
@endonce

