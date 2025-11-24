/**
 * ============================================
 * JAVASCRIPT ESPECÍFICO DE BLOG DETAILS
 * Función para compartir artículos
 * ============================================
 */

(function() {
	'use strict';

	/**
	 * Función para compartir artículos usando Web Share API o fallback
	 * Los datos se obtienen de data attributes o del objeto window.blogData
	 */
	window.shareArticle = function() {
		// Obtener datos del blog desde data attributes o window.blogData
		const shareBtn = document.querySelector('[data-blog-title]');
		const title = shareBtn ? shareBtn.getAttribute('data-blog-title') : (window.blogData && window.blogData.title ? window.blogData.title : '');
		const text = shareBtn ? shareBtn.getAttribute('data-blog-text') : (window.blogData && window.blogData.text ? window.blogData.text : '');
		const url = window.location.href;

		if (navigator.share) {
			navigator.share({
				title: title,
				text: text || '',
				url: url
			}).catch(function(err) {
				console.log('Error al compartir', err);
			});
		} else {
			// Fallback: copiar al portapapeles
			if (navigator.clipboard && navigator.clipboard.writeText) {
				navigator.clipboard.writeText(url).then(function() {
					alert('Enlace copiado al portapapeles');
				}).catch(function(err) {
					// Fallback más antiguo
					copyToClipboardFallback(url);
				});
			} else {
				// Fallback más antiguo
				copyToClipboardFallback(url);
			}
		}
	};

	/**
	 * Fallback para copiar al portapapeles en navegadores antiguos
	 * @param {string} text - Texto a copiar
	 */
	function copyToClipboardFallback(text) {
		const textArea = document.createElement('textarea');
		textArea.value = text;
		textArea.style.position = 'fixed';
		textArea.style.opacity = '0';
		document.body.appendChild(textArea);
		textArea.select();
		try {
			document.execCommand('copy');
			alert('Enlace copiado al portapapeles');
		} catch (err) {
			console.error('Error al copiar:', err);
		}
		document.body.removeChild(textArea);
	}

})();

