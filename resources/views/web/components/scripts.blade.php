{{-- 
    ============================================
    COMPONENTE: SCRIPTS (JavaScript)
    ============================================
    
    PROPÓSITO:
    Este componente contiene todos los scripts JavaScript necesarios para el funcionamiento
    del sitio web, incluyendo jQuery, Bootstrap, plugins de carrusel, animaciones, etc.
    
    CÓMO FUNCIONA:
    Este archivo se incluye en el layout principal (main.blade.php) usando @include,
    justo antes del cierre de </body>. Todas las rutas de assets se convierten usando {{ asset() }}.
    
    QUÉ REEMPLAZA:
    Reemplaza las líneas 769-792 del archivo index.html original (todos los scripts).
    
    INSTRUCCIONES PARA DESARROLLADORES:
    1. Para agregar un nuevo script, agrega una nueva línea <script> antes del cierre del componente
    2. El orden de los scripts es importante: jQuery primero, luego plugins, luego main.js al final
    3. Para agregar scripts específicos de una vista, usa @section('scripts') en la vista
    4. Los scripts se cargan al final del body para mejorar el rendimiento de la página
--}}

<!-- jQuery Frameworks
============================================= -->
{{-- jQuery debe cargarse sin defer para que otros scripts funcionen --}}
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}" defer></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}" defer></script>
<script src="{{ asset('assets/js/bootstrap-menu.js') }}" defer></script>

{{-- main.js carga después de jQuery pero sin bloquear --}}
<script>
(function() {
    function loadMainJS() {
        if (typeof jQuery !== 'undefined') {
            var script = document.createElement('script');
            script.src = '{{ asset('assets/js/main.js') }}';
            script.async = true;
            document.body.appendChild(script);
        } else {
            setTimeout(loadMainJS, 50);
        }
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', loadMainJS);
    } else {
        loadMainJS();
    }
})();
</script>

{{-- Scripts no críticos - Cargar con defer para no bloquear renderizado --}}
<script src="{{ asset('assets/js/jquery.easing.min.js') }}" defer></script>
<script src="{{ asset('assets/js/jquery.appear.js') }}" defer></script>
<script src="{{ asset('assets/js/modernizr.custom.13711.js') }}" defer></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}" defer></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}" defer></script>
<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}" defer></script>
<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}" defer></script>
<script src="{{ asset('assets/js/wow.min.js') }}" defer></script>
<script src="{{ asset('assets/js/wodry.min.js') }}" defer></script>
<script src="{{ asset('assets/js/count-to.js') }}" defer></script>
<script src="{{ asset('assets/js/progress-bar.min.js') }}" defer></script>
<script src="{{ asset('assets/js/color-option.js') }}" defer></script>
<script src="{{ asset('assets/js/typed.js') }}" defer></script>
<script src="{{ asset('assets/js/YTPlayer.min.js') }}" defer></script>
<script src="{{ asset('assets/js/active-class.js') }}" defer></script>
<script src="{{ asset('assets/js/jquery.mixitup.min.js') }}" defer></script>
<script src="{{ asset('assets/js/jquery.countdown.min.js') }}" defer></script>

{{-- Google Ads — Seguimiento de conversiones
     Se dispara en cualquier enlace con atributo data-conv (WhatsApp, contacto, etc.)
     Sin necesidad de onclick en cada botón. --}}
<script>
(function () {
    function gtag_report_conversion(url) {
        var callback = function () {
            if (typeof url !== 'undefined') {
                window.location = url;
            }
        };
        if (typeof gtag === 'function') {
            gtag('event', 'conversion', {
                'send_to': 'AW-17978852799/bxEgCIjImY0cEL-L_vxC',
                'value': 1.0,
                'currency': 'COP',
                'event_callback': callback
            });
        } else {
            callback();
        }
        return false;
    }

    // Event delegation: captura clics en *cualquier* botón con [data-conv]
    // sin necesidad de añadir onclick manualmente a cada elemento.
    document.addEventListener('click', function (e) {
        var el = e.target.closest('[data-conv]');
        if (!el || !el.href) return;
        e.preventDefault();
        gtag_report_conversion(el.href);
    });
})();
</script>

{{-- Sección para agregar scripts adicionales desde las vistas --}}
@yield('scripts')

