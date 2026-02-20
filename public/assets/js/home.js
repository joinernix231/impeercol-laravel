/**
 * ============================================
 * JAVASCRIPT ESPECÍFICO DE LA PÁGINA HOME
 * Inicialización de sliders y lógica específica
 * ============================================
 */

(function($) {
	'use strict';

	$(document).ready(function() {
		// Reinicializar el carousel con menos margin
		if ($('.gallery-sldr').length > 0) {
			if ($('.gallery-sldr').data('owl.carousel')) {
				$('.gallery-sldr').trigger('destroy.owl.carousel');
			}
			$('.gallery-sldr').owlCarousel({
				loop: true,
				margin: 0,
				nav: false,
				dots: true,
				autoplay: true,
				autoplayTimeout: 5000,
				autoplayHoverPause: true,
				responsive: {
					0: {
						items: 1,
						margin: 10
					},
					768: {
						items: 2,
						margin: 20
					},
					992: {
						items: 3,
						margin: 30
					}
				}
			});
		}

		// Inicializar slider de productos destacados
		if ($('.featured-products-slider').length > 0) {
			$('.featured-products-slider').owlCarousel({
				loop: true,
				margin: 40,
				nav: true,
				dots: true,
				autoplay: true,
				autoplayTimeout: 4000,
				autoplayHoverPause: true,
				navText: [
					'<i class="icofont-long-arrow-left"></i>',
					'<i class="icofont-long-arrow-right"></i>'
				],
				responsive: {
					0: {
						items: 1,
						margin: 20
					},
					576: {
						items: 2,
						margin: 25
					},
					768: {
						items: 2,
						margin: 30
					},
					992: {
						items: 3,
						margin: 40
					},
					1200: {
						items: 3,
						margin: 40
					}
				}
			});
		}

		// Animación del hero slider al cambiar slide
		if ($('.hero-sldr').length > 0) {
			$('.hero-sldr').on('changed.owl.carousel', function(event) {
				var $activeItem = $(event.target).find('.owl-item.active .hero-2-content');
				
				// Reiniciar animaciones suavemente
				$activeItem.find('.fade-in-up, .fade-in-up-delay, .fade-in-up-delay-2').each(function() {
					var $this = $(this);
					$this.css('animation', 'none');
					setTimeout(function() {
						$this.css('animation', '');
					}, 10);
				});
			});
		}
	});

})(jQuery);

