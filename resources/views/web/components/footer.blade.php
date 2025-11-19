{{-- 
    ============================================
    COMPONENTE: FOOTER (Pie de Página)
    ============================================
    
    PROPÓSITO:
    Este componente contiene el pie de página del sitio web, incluyendo:
    - Redes sociales
    - Información de copyright
    - Logo de la empresa
    
    CÓMO FUNCIONA:
    Este archivo se incluye en el layout principal (main.blade.php) usando @include.
    Las rutas de assets se convierten usando {{ asset() }}.
    
    QUÉ REEMPLAZA:
    Reemplaza las líneas 730-761 del archivo index.html original (footer completo).
    
    INSTRUCCIONES PARA DESARROLLADORES:
    1. Para modificar los enlaces de redes sociales, edita los href en la sección footer-social
    2. Para cambiar el texto de copyright, modifica el contenido dentro de .copyright-text
    3. El año se puede hacer dinámico usando {{ date('Y') }} si se desea
--}}

<!-- Start Footer
============================================= -->
<footer style="background-image: url('{{ asset('assets/img/gallery/Impeercol.jpg') }}');">
	<div class="footer-overlay"></div>
	<div class="top-shape"></div>
	<div class="footer-widget de-pb">
		{{-- Redes sociales --}}
		<div class="footer-social-bar">
			<div class="container">
				<ul class="footer-social big">
					<li class="wow fadeInUp" data-wow-delay=".05s">
						<a href="https://www.facebook.com/people/Impeercol/61552354370157/?_rdr&checkpoint_src=any" target="_blank" rel="noopener noreferrer">
							<i class="fab fa-facebook-f"></i>
						</a>
					</li>
					<li class="wow fadeInUp" data-wow-delay=".1s">
						<a href="https://www.instagram.com/expertos.impeercol?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer">
							<i class="fab fa-instagram"></i>
						</a>
					</li>
					<li class="wow fadeInUp" data-wow-delay=".2s">
						<a href="https://www.tiktok.com/@expertos.impeercol?_t=ZS-90xyPSVNMFM&_r=1" target="_blank" rel="noopener noreferrer">
							<i class="bi bi-tiktok"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	{{-- Copyright --}}
	<div class="copyright">
		<div class="container">
			<div class="copyright-row">
				<div class="copy-left">
					<img src="{{ asset('assets/img/logo/logo-white.png') }}" alt="IMPEERCOL" class="footer-logo-mini">
				</div>
				<div class="copy-center"></div>
				<div class="copy-right">
					<p class="copyright-text mb-0">Copyright © {{ date('Y') }} IMPEERCOL. Todos los derechos reservados.</p>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- End Footer-->

{{-- Botón de scroll hacia arriba --}}
<!-- Start Scroll top
============================================= -->
<a href="#bdy" id="scrtop" class="smooth-menu"><i class="ti-arrow-up"></i></a>
<!-- End Scroll top-->

