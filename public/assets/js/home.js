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
			var $slider = $('.featured-products-slider');
			var isMobile = $(window).width() <= 767;
			
			$slider.owlCarousel({
				loop: true,
				margin: 30,
				nav: true,
				dots: !isMobile, // Desactivar dots en mobile
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
						margin: 15,
						dots: false // Sin dots en mobile
					},
					576: {
						items: 2,
						margin: 20,
						dots: false // Sin dots en mobile
					},
					768: {
						items: 2,
						margin: 25,
						dots: true
					},
					992: {
						items: 3,
						margin: 30,
						dots: true
					},
					1200: {
						items: 3,
						margin: 30,
						dots: true
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

