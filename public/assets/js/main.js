/* ===================================================================
    
    Author          : Kazi Sahiduzzaman
    Template Name   : Indust - Construction HTML Template
    Version         : 1.0
    
* ================================================================= */
(function($) {
    "use strict";

    $(document).ready( function() {

		/* ==================================================
			Preloader Init
		===============================================*/
		
		$(window).on('load', function() {
		// Animate loader off screen
			$(".preloader").fadeOut("slow");
		});
		
		// Fallback para ocultar el preloader después de 3 segundos
		setTimeout(function(){
			$(".preloader").fadeOut("slow");
		}, 3000);
		
		/* ==================================================
			# Data Background
		 ===============================================*/

		$("[data-background]").each(function(){
			$(this).css("background-image","url(" + $(this).attr("data-background") +")");
		});
		
		/* ==================================================
			# Fun Factor Init
		===============================================*/
			$('.timer').countTo();
			$('.fun-fact').appear(function() {
				$('.timer').countTo();
			}, {
				accY: -100
			});
		
		
		/* ==================================================
		# Quantity
		===============================================*/
		
		function wcqib_refresh_quantity_increments() {
			jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
				var c = jQuery(b);
				c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
			})
		}
		String.prototype.getDecimals || (String.prototype.getDecimals = function() {
			var a = this,
				b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
			return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
		}), jQuery(document).ready(function() {
			wcqib_refresh_quantity_increments()
		}), jQuery(document).on("updated_wc_div", function() {
			wcqib_refresh_quantity_increments()
		}), jQuery(document).on("click", ".plus, .minus", function() {
			var a = jQuery(this).closest(".quantity").find(".qty"),
				b = parseFloat(a.val()),
				c = parseFloat(a.attr("max")),
				d = parseFloat(a.attr("min")),
				e = a.attr("step");
			b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
		});

		
		/* ==================================================
			# Wow Init
		 ===============================================*/
		
		var wow = new WOW({
			boxClass: 'wow', // animated element css class (default is wow)
			animateClass: 'animated', // animation css class (default is animated)
			offset: 0, // distance to the element when triggering the animation (default is 0)
			mobile: true, // trigger animations on mobile devices (default is true)
			live: true // act on asynchronously loaded content (default is true)
		});
		wow.init();

		/* ==================================================
			# Smooth Scroll
		 =============================================== */

		$('a.smooth-menu').on('click', function(event) {
			var $anchor = $(this);
			var headerH = '85';
			$('html, body').stop().animate({
				scrollTop: $($anchor.attr('href')).offset().top - headerH + "px"
			}, 1500, 'easeInOutExpo');
			event.preventDefault();
		});
		
		
		/* ==================================================
			# Accordion Menu
		 =============================================== */

		$(document).on('click','.panel-group .panel',function(e) {
			e.preventDefault();
			$(this).addClass('panel-active').siblings().removeClass('panel-active');
		});

		/* ==================================================
			# imagesLoaded active
		===============================================*/
		
		$('.filter-active').imagesLoaded(function () {
			var $filter = '.filter-active',
			$filterItem = '.filter-item',
			$filterMenu = '.filter-menu-active';

			if ($($filter).length > 0) {
				var $grid = $($filter).isotope({
				itemSelector: $filterItem,
				filter: '*',
				masonry: {
						// use outer width of grid-sizer for columnWidth
						columnWidth: 1
					}
				});

				// filter items on button click
				$($filterMenu).on('click', 'button', function () {
					var filterValue = $(this).attr('data-filter');
					$grid.isotope({
						filter: filterValue
					});
				});

				// Menu Active Class 
				$($filterMenu).on('click', 'button', function (event) {
					event.preventDefault();
					$(this).addClass('active');
					$(this).siblings('.active').removeClass('active');
				});
			}
		})

		/* ==================================================
			# MixitUp 
		 =============================================== */
		
		$('#portfolio').mixItUp({  
			selectors: {
			target: '.tile',
			filter: '.filter',
			sort: '.sort-btn'
			},

			animation: {
			animateResizeContainer: false,
			effects: 'fade scale'
			}

		});
		
		
		/* ==================================================
			# Magnific popup init
		 ===============================================*/
		
		$(".popup-link").magnificPopup({
			type: 'image',
			// other options
		});

		$(".popup-gallery").magnificPopup({
			type: 'image',
			gallery: {
				enabled: true
			},
			// other options
		});

		$("#videoLink").magnificPopup({
			type: "inline",
			midClick:true
		});
		
		$(".popup-youtube, .popup-vimeo, .popup-gmaps").magnificPopup({
			type: "iframe",
			mainClass: "mfp-fade",
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false
		});

		$('.magnific-mix-gallery').each(function() {
			var $container = $(this);
			var $imageLinks = $container.find('.item');

			var items = [];
			$imageLinks.each(function() {
				var $item = $(this);
				var type = 'image';
				if ($item.hasClass('magnific-iframe')) {
					type = 'iframe';
				}
				var magItem = {
					src: $item.attr('href'),
					type: type
				};
				magItem.title = $item.data('title');
				items.push(magItem);
			});

			$imageLinks.magnificPopup({
				mainClass: 'mfp-fade',
				items: items,
				gallery: {
					enabled: true,
					tPrev: $(this).data('prev-text'),
					tNext: $(this).data('next-text')
				},
				type: 'image',
				callbacks: {
					beforeOpen: function() {
						var index = $imageLinks.index(this.st.el);
						if (-1 !== index) {
							this.goTo(index);
						}
					}
				}
			});
		});
		
		/* ==================================================
            # Typed Js
         ===============================================*/
		
		$(".typed").typed({
			strings: ["IT Company ", "Software Company ", "Digital Marketplace "],
			// Optionally use an HTML element to grab strings from (must wrap each string in a <p>)
			stringsElement: null,
			// typing speed
			typeSpeed: 100,
			// time before typing starts
			startDelay: 1200,
			// backspacing speed
			backSpeed: 10,
			// time before backspacing
			backDelay: 600,
			// loop
			loop: true,
			// false = infinite
			loopCount: Infinity,
			// show cursor
			showCursor: false,
			// character for cursor
			cursorChar: "|",
			// attribute to type (null == text)
			attr: null,
			// either html or text
			contentType: 'html',
			// call when done callback function
			callback: function() {},
			// starting callback function before each string
			preStringTyped: function() {},
			//callback for every typed string
			onStringTyped: function() {},
			// callback for reset
			resetCallback: function() {}
		});
		
		/* ==================================================
            # Gallery  Slider
         ===============================================*/
		
        $('.gallery-sldr').owlCarousel({
            loop: true,
            margin:30,
            nav: false,
            navText: [
                "<i class='icofont-long-arrow-left'></i>",
                "<i class='icofont-long-arrow-right'></i>"
            ],
            dots: true,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 3
                }
            }
        });
		
		/* ==================================================
            # Project Details Carousel
         ===============================================*/
		
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
		
        /* ==================================================
            # Partner Carousel
         ===============================================*/
		
        $('.partner-sldr').owlCarousel({
            loop: true,
            margin:30,
            nav: false,
            navText: [
                "<i class='icofont-long-arrow-left'></i>",
                "<i class='icofont-long-arrow-right'></i>"
            ],
            dots: false,
            autoplay: true,
            responsive: {
                0: {
                    items: 2
                },
                768: {
                    items: 4
                },
                992: {
                    items: 4
                }
            }
        });
        
		/* ==================================================
            # Partner Carousel
         ===============================================*/
		
        $('.partner-sldr-2').owlCarousel({
            loop: true,
            margin:30,
            nav: false,
            navText: [
                "<i class='icofont-long-arrow-left'></i>",
                "<i class='icofont-long-arrow-right'></i>"
            ],
            dots: false,
            autoplay: true,
            responsive: {
                0: {
                    items: 2
                },
                768: {
                    items: 4
                },
                992: {
                    items: 6
                }
            }
        });
		
		/* ==================================================
            # Screenshot Carousel
         ===============================================*/
		
		$('.scr-sldr').owlCarousel({
            loop: true,
            nav: false,
            margin:30,
            dots: true,
            autoplay: false,
            items: 1,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            responsive: {
                1200: {
                    stagePadding: 150,
                }
            }
        });
		
		/* ==================================================
            # Review Carousel
         ===============================================*/
		
        $('.rev-sldr').owlCarousel({
            loop: true,
            margin:30,
            nav: false,
            navText: [
                "<i class='icofont-long-arrow-left'></i>",
                "<i class='icofont-long-arrow-right'></i>"
            ],
            dots: true,
            autoplay: true,
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 2
                },
                992: {
                    items: 2
                }
            }
        });
        
        /* ==================================================
            # Hero Slider Carousel
         ===============================================*/
		
        $('.hero-sldr').owlCarousel({
            loop: true,
            nav: true,
            dots: false,
            autoplay: true,
			autoplayTimeout:9000,
            items: 1,
            navText: [
                "<i class='ti-angle-left'></i>",
                "<i class='ti-angle-right'></i>"
            ],
        });
		
		/* ==================================================
            # Carousel Carousel
         ===============================================*/
		
        $('.cate-carousel').owlCarousel({
            loop: true,
            nav: false,
            margin:30,
            dots: true,
            autoplay: true,
            items: 1,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            responsive: {
                1000: {
                    stagePadding: 100,
                }
            }
        });
		
		/* ==================================================
            # Hero Slider Carousel
         ===============================================*/
		
		var now = new Date();
		var day = now.getDate();
		var month = now.getMonth() + 1;
		var year = now.getFullYear() + 1;

		var nextyear = month + '/' + day + '/' + year + ' 12:43:07';

		$('#example').countdown({
			date: nextyear, // TODO Date format: 07/27/2017 17:00:00
			offset: +6, // TODO Your Timezone Offset
			day: 'Day',
			days: 'Days',
			hideOnComplete: true
		});


        /* ==================================================
           Contact Form - Envío sin hosting (EmailJS opcional + mailto fallback)
       ================================================== */
        (function(){
            var TARGET_EMAIL = 'criss.var09@gmail.com';
            var emailJsLoaded = false;
            function loadEmailJs(cb){
                if (window.emailjs) { emailJsLoaded = true; cb(); return; }
                var s = document.createElement('script');
                s.src = 'https://cdn.jsdelivr.net/npm/emailjs-com@3/dist/email.min.js';
                s.onload = function(){ emailJsLoaded = true; cb(); };
                document.head.appendChild(s);
            }
            function buildBody(params){
                var lines = [
                    'Nombre: ' + (params.name||''),
                    'Email: ' + (params.email||''),
                    'Teléfono: ' + (params.phone||''),
                    'Asunto: ' + (params.subject||''),
                    'Mensaje:',
                    (params.comments||'')
                ];
                return lines.join('\n');
            }
            $('.contact-form').each(function(){
                var $form = $(this);
                var currentAction = ($form.attr('action')||'');
                var isFormSubmit = /formsubmit\.co\//i.test(currentAction) || ($form.data('provider') === 'formsubmit');
                var isFormspree = /formspree\.io\/f\//i.test(currentAction) || ($form.data('provider') === 'formspree');
                if (isFormSubmit) {
                    // Si se ejecuta en http/https, añadir _next para volver con ?sent=1
                    if (location.protocol === 'http:' || location.protocol === 'https:') {
                        var next = window.location.origin + window.location.pathname + (window.location.search ? window.location.search + '&' : '?') + 'sent=1';
                        if (!$form.find('input[name="_next"]').length) {
                            $('<input>', { type:'hidden', name:'_next', value: next }).appendTo($form);
                        } else {
                            $form.find('input[name="_next"]').val(next);
                        }
                    } else {
                        // En local (file://) abrir en nueva pestaña para no perder la vista
                        $form.attr('target','_blank');
                    }
                    // Mostrar mensaje si ?sent=1
                    var params = new URLSearchParams(window.location.search);
                    if (params.get('sent') === '1') {
                        var $msg = $('#message');
                        $msg.hide().html('<div class="alert alert-success">Gracias, tu mensaje fue enviado correctamente.</div>').slideDown('slow');
                    }
                    return; // no interceptar submit
                } else if (isFormspree) {
                    // Enviar con fetch para no salir de la página
                    $form.on('submit', function(e){
                        e.preventDefault();
                        var action = $form.attr('action');
                        var formData = new FormData($form[0]);
                        var $msg = $('#message');
                        $msg.hide().html('');
                        $('#submit').attr('disabled','disabled');
                        fetch(action, {
                            method: 'POST',
                            body: formData,
                            headers: { 'Accept': 'application/json' }
                        }).then(function(resp){
                            if (resp.ok) {
                                $msg.html('<div class="alert alert-success">Gracias, tu mensaje fue enviado correctamente.</div>').slideDown('slow');
                                $form[0].reset();
                            } else {
                                return resp.json().then(function(data){
                                    throw new Error((data && data.error) || 'No fue posible enviar el formulario.');
                                });
                            }
                        }).catch(function(){
                            $msg.html('<div class="alert alert-danger">No fue posible enviar el formulario en este momento. Inténtalo de nuevo.</div>').slideDown('slow');
                        }).finally(function(){
                            $('#submit').removeAttr('disabled');
                        });
                    });
                    return;
                }
                $form.attr('action','#'); // evitar navegación si falla JS cuando no hay proveedor externo
                $form.on('submit', function(e){
                    e.preventDefault();
                    var params = {
                        name: $('#name').val(),
                        email: $('#email').val(),
                        phone: $('#phone').val(),
                        subject: $('#subject').val(),
                        comments: $('#comment').val()
                    };
                    var $msg = $('#message');
                    $msg.hide().html('');
                    $('#submit').attr('disabled','disabled');

                    // Intentar EmailJS si hay configuración global
                    var cfg = window.IMPEERCOL_EMAILJS || null; // {serviceId, templateId, publicKey}
                    function markDone(text, ok){
                        $('#submit').removeAttr('disabled');
                        $msg.html('<div class="'+(ok?'alert alert-success':'alert alert-danger')+'">'+text+'</div>').slideDown('slow');
                    }
                    function useMailto(){
                        var subject = 'Contacto Web - IMPEERCOL: ' + (params.subject || 'Consulta');
                        var body = buildBody(params);
                        window.location.href = 'mailto:'+TARGET_EMAIL+'?subject='+encodeURIComponent(subject)+'&body='+encodeURIComponent(body);
                        markDone('Se abrió tu cliente de correo. Si no se abrió, escríbenos a '+TARGET_EMAIL, true);
                    }

                    if (cfg && cfg.serviceId && cfg.templateId && cfg.publicKey){
                        loadEmailJs(function(){
                            try { window.emailjs.init(cfg.publicKey); } catch(e) {}
                            window.emailjs.send(cfg.serviceId, cfg.templateId, {
                                to_email: TARGET_EMAIL,
                                from_name: params.name,
                                from_email: params.email,
                                phone: params.phone,
                                subject: params.subject,
                                message: params.comments
                            }).then(function(){
                                markDone('Gracias, tu mensaje fue enviado correctamente.', true);
                                $form[0].reset();
                            }).catch(function(){
                                useMailto();
                            });
                        });
                    } else {
                        useMailto();
                    }
                });
            });
        })();


		/* ==================================================
			# Scroll to top
		 =============================================== */
		
        //Get the button
        var mybutton = document.getElementById("scrtop");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
          if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
          } else {
            mybutton.style.display = "none";
          }
        }
		
		/* ==================================================
			# wodryRX
		 =============================================== */
		
		$('.wodryRX').wodry({
			animation: 'rotateX',
			delay: 2000,
			animationDuration: 1600
		});
        
        // (revert) remove promo parallax handler
        
        /* ==================================================
            # WhatsApp Floating Button (multi-opción)
         ===============================================*/
        (function(){
            if (document.querySelector('.whatsapp-wrapper')) return;
            var phoneCentro = '573025069825'; // Centro Corporativo
            var phoneSieteAgosto = '573237313633'; // 7 de Agosto
            function buildMessage(sede){
                var s = (sede || '').toLowerCase();
                if (s.indexOf('7') !== -1) {
                    return '¡Hola!  vi su pagina y quiero más información sobre sus productos y asesorías.\n  Sede: 7 de Agosto.';
                }
                if (s.indexOf('centro') !== -1) {
                    return '¡Hola! Vi su página y quiero más información sobre sus productos y asesorías.\nSede: Centro.';
                }
                return '¡Hola!  Vi su pagina y quiero más información sobre sus productos y asesorías.';
            }

            function buildUrl(phone, message){
                return 'https://wa.me/' + phone + '?text=' + encodeURIComponent(message);
            }

            var wrap = document.createElement('div');
            wrap.className = 'whatsapp-wrapper';

            // Lista de números (puedes agregar/quitar sin tocar el HTML)
            // Para que "Centro" quede más cerca del botón principal (abajo), se agrega de último
            var numbers = [
                { label: '7 de Agosto', phone: phoneSieteAgosto },
                { label: 'Centro', phone: phoneCentro }
            ];

            // Menú de iconos
            var menu = document.createElement('div');
            menu.className = 'wa-menu-icons';
            numbers.forEach(function(n){
                var a = document.createElement('a');
                a.className = 'wa-entry';
                a.href = buildUrl(n.phone, buildMessage(n.label || 'Comercial'));
                a.target = '_blank';
                a.rel = 'noopener';
                a.title = n.label || 'WhatsApp';
                a.setAttribute('aria-label', n.label || 'WhatsApp');
                a.innerHTML = '<span class="wa-mini"><i class="fab fa-whatsapp"></i></span>'+
                              '<span class="wa-text">'+ (n.label || 'WhatsApp') +'</span>';
                menu.appendChild(a);
            });

            var main = document.createElement('a');
            main.className = 'whatsapp-float';
            main.setAttribute('href', buildUrl(phoneCentro, buildMessage('Centro')));
            main.setAttribute('target', '_blank');
            main.setAttribute('rel', 'noopener');
            main.setAttribute('aria-label', 'Escríbenos por WhatsApp');
            main.innerHTML = '<i class="fab fa-whatsapp"></i>';

            wrap.appendChild(menu);
            wrap.appendChild(main);
            document.body.appendChild(wrap);

            // Toggle en móviles por click
            main.addEventListener('click', function(e){
                var isTouch = ('ontouchstart' in window) || navigator.maxTouchPoints > 0;
                if (isTouch) {
                    e.preventDefault();
                    wrap.classList.toggle('wa-open');
                }
            });
            // Abrir/cerrar en desktop por hover explícito
            wrap.addEventListener('mouseenter', function(){ wrap.classList.add('wa-open'); });
            wrap.addEventListener('mouseleave', function(){ wrap.classList.remove('wa-open'); });
            document.addEventListener('click', function(ev){
                if (!wrap.contains(ev.target)) wrap.classList.remove('wa-open');
            });
        })();

		/* ==================================================
			# API WhatsApp Centro - Yeimi Centro Corporativo
			# Número: +57 302 5069825
		 ===============================================*/
        (function(){
            // Función para crear enlace directo de WhatsApp
            function createWhatsAppLink(phone, message) {
                var cleanPhone = phone.replace(/\s+/g, '').replace(/[^0-9]/g, '');
                // Si no tiene código de país, agregar 57 (Colombia)
                if (cleanPhone.length === 10) {
                    cleanPhone = '57' + cleanPhone;
                }
                var defaultMessage = message || '¡Hola! Vi su página y quiero más información sobre sus productos y asesorías.\nSede: Centro.';
                return 'https://wa.me/' + cleanPhone + '?text=' + encodeURIComponent(defaultMessage);
            }

            // API pública para el número del Centro - Yeimi Centro Corporativo
            window.whatsappCentro = {
                contactName: 'Yeimi Centro Corporativo',
                phone: '3025069825', // Número sin espacios
                phoneFormatted: '302 5069825', // Número con formato
                phoneFull: '573025069825', // Número con código de país (+57)
                phoneDisplay: '+57 302 5069825', // Número para mostrar
                sendMessage: function(message) {
                    var url = createWhatsAppLink(this.phoneFull, message);
                    window.open(url, '_blank');
                    return url;
                },
                getLink: function(message) {
                    return createWhatsAppLink(this.phoneFull, message);
                }
            };

            // Función global para usar fácilmente
            window.openWhatsAppCentro = function(message) {
                return window.whatsappCentro.sendMessage(message);
            };
        })();

		/* ==================================================
			# Enlaces: email y Google Maps en tarjetas de info
		 ===============================================*/
		(function(){
            // Enlazar email (texto y toda la tarjeta)
            document.querySelectorAll('.info-card .icofont-email').forEach(function(icon){
                var card = icon.closest('.info-card');
                var bold = card && card.querySelector('.info-text .info-bold');
                if (bold && bold.textContent) {
                    var email = bold.textContent.trim();
                    var mailHref = 'mailto:' + email + '?subject=' + encodeURIComponent('Consulta desde la web IMPEERCOL');
                    if (!bold.querySelector('a')) {
                        var a = document.createElement('a');
                        a.href = mailHref;
                        a.textContent = email;
                        bold.textContent = '';
                        bold.appendChild(a);
                    }
                    if (card) {
                        card.style.cursor = 'pointer';
                        card.addEventListener('click', function(e){
                            if (e.target && e.target.closest('a')) return; // respetar clicks en enlaces
                            window.location.href = mailHref;
                        });
                    }
                }
            });

			// Enlazar direcciones a Google Maps (tarjetas rojas)
			document.querySelectorAll('.info-card .icofont-google-map').forEach(function(icon){
				var card = icon.closest('.info-card');
				var top = card && card.querySelector('.info-text .info-top');
				var bold = card && card.querySelector('.info-text .info-bold');
				if (bold && !bold.querySelector('a')) {
					var address = '';
					if (top) address += top.textContent.trim() + ' ';
					if (bold) address += bold.textContent.trim();
					var a = document.createElement('a');
					a.href = 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(address);
					a.target = '_blank';
					a.rel = 'noopener';
					a.textContent = bold.textContent.trim();
					bold.textContent = '';
					bold.appendChild(a);
				}
			});

			// Enlazar bloques de dirección genéricos
			document.querySelectorAll('.addr-desc p').forEach(function(p){
				if (p.querySelector('a')) return;
				var original = p.innerText || p.textContent;
				if (!original) return;
				var normalized = original.replace(/\s+/g,' ').trim();
				if (!normalized) return;
				var a = document.createElement('a');
				a.href = 'https://www.google.com/maps/search/?api=1&query=' + encodeURIComponent(normalized);
				a.target = '_blank';
				a.rel = 'noopener';
				a.textContent = original.trim();
				p.textContent = '';
				p.appendChild(a);
			});

			// Override específico: cambiar "Pereira, Colombia" a punto Siete de Agosto
			(function(){
				var sieteUrl = 'https://www.google.com/maps/place/MPAEI+Colombia+-+Punto+de+Venta+Siete+de+Agosto/@4.6561246,-74.0651258,15z/data=!4m6!3m5!1s0x8e3f9b94ae5c4787:0xd57d66c6de9f51bf!8m2!3d4.6576662!4d-74.0672042!16s%2Fg%2F11jpl1s_kp?entry=ttu&g_ep=EgoyMDI1MTAyNy4wIKXMDSoASAFQAw%3D%3D';
				// Corregir posibles typos en URL original: usar exactamente el link proporcionado si es distinto
				sieteUrl = 'https://www.google.com/maps/place/MAPEI+Colombia+-+Punto+de+Venta+Siete+de+Agosto/@4.6561246,-74.0651258,15z/data=!4m6!3m5!1s0x8e3f9b94ae5c4787:0xd57d66c6de9f51bf!8m2!3d4.6576662!4d-74.0672042!16s%2Fg%2F11jpl1s_kp?entry=ttu&g_ep=EgoyMDI1MTAyNy4wIKXMDSoASAFQAw%3D%3D';
				var newLabel = 'Siete de Agosto, Bogotá';
				// Info cards
				document.querySelectorAll('.info-card .info-text .info-bold').forEach(function(bold){
					var txt = (bold.innerText || bold.textContent || '').trim();
					if (/pereira\s*,?\s*colombia/i.test(txt)) {
						var a = bold.querySelector('a');
						if (!a) { a = document.createElement('a'); bold.textContent = ''; bold.appendChild(a); }
						a.href = sieteUrl;
						a.target = '_blank';
						a.rel = 'noopener';
						a.textContent = newLabel;
					}
				});
				// Bloques addr-desc
				document.querySelectorAll('.addr-desc p').forEach(function(p){
					var txt = (p.innerText || p.textContent || '').trim();
					if (/pereira\s*,?\s*colombia/i.test(txt)) {
						p.textContent = '';
						var a = document.createElement('a');
						a.href = sieteUrl;
						a.target = '_blank';
						a.rel = 'noopener';
						a.textContent = newLabel;
						p.appendChild(a);
					}
				});
			})();
		})();
        
    }); // end document ready function
})(jQuery); // End jQuery

