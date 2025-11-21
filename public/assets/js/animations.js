/**
 * ============================================
 * ANIMACIONES REUTILIZABLES
 * IntersectionObserver para scroll reveal
 * ============================================
 */

(function() {
	'use strict';

	/**
	 * Activar animaciones sutiles cuando los elementos entran en viewport
	 * Solo funciona si el navegador soporta IntersectionObserver
	 */
	function initScrollRevealAnimations() {
		if ('IntersectionObserver' in window) {
			const animateObserver = new IntersectionObserver(function(entries) {
				entries.forEach(function(entry) {
					if (entry.isIntersecting) {
						entry.target.style.animationPlayState = 'running';
						animateObserver.unobserve(entry.target);
					}
				});
			}, {
				threshold: 0.1,
				rootMargin: '0px 0px -30px 0px'
			});

			// Observar todos los elementos con animaciones fade-in
			document.querySelectorAll('[class*="fade-in-"]').forEach(function(el) {
				el.style.animationPlayState = 'paused';
				animateObserver.observe(el);
			});
		}
	}

	// Inicializar cuando el DOM esté listo
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initScrollRevealAnimations);
	} else {
		initScrollRevealAnimations();
	}

})();

