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
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-menu.js') }}"></script>
<script src="{{ asset('assets/js/jquery.easing.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
<script src="{{ asset('assets/js/modernizr.custom.13711.js') }}"></script>
<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/js/wow.min.js') }}"></script>
<script src="{{ asset('assets/js/wodry.min.js') }}"></script>
<script src="{{ asset('assets/js/count-to.js') }}"></script>
<script src="{{ asset('assets/js/progress-bar.min.js') }}"></script>
<script src="{{ asset('assets/js/color-option.js') }}"></script>
<script src="{{ asset('assets/js/typed.js') }}"></script>
<script src="{{ asset('assets/js/YTPlayer.min.js') }}"></script>
<script src="{{ asset('assets/js/active-class.js') }}"></script>
<script src="{{ asset('assets/js/jquery.mixitup.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

{{-- Sección para agregar scripts adicionales desde las vistas --}}
@yield('scripts')

