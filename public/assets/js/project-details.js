/**
 * ============================================
 * JAVASCRIPT ESPECÍFICO DE PROJECT DETAILS
 * Inicialización del carousel de proyectos
 * ============================================
 */

(function($) {
	'use strict';

	$(document).ready(function() {
		// Asegurar que el carousel se inicialice correctamente
		if ($('.project-details-carousel').length > 0) {
			// Reinicializar el carousel si ya existe
			if ($('.project-details-carousel').data('owl.carousel')) {
				$('.project-details-carousel').trigger('destroy.owl.carousel');
			}
			$('.project-details-carousel').owlCarousel({
				loop: true,
				margin: 0,
				nav: true,
				navText: [
					"<i class='icofont-long-arrow-left'></i>",
					"<i class='icofont-long-arrow-right'></i>"
				],
				dots: false,
				autoplay: false,
				items: 1
			});
		}
	});

})(jQuery);

