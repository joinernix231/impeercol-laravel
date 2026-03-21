{{--
    ============================================
    COMPONENTE: NAVBAR — Rediseño Industrial Premium
    ============================================
    Diseño moderno para sector impermeabilización / construcción.
    Tecnología: CSS custom (imp-*) + Vanilla JS inline.
    Sin dependencia de Bootstrap-collapse para el menú móvil.
--}}

<header class="header imp-header" id="imp-header">

    {{-- ═══════════════════════════════════════════════
         NAV PRINCIPAL
    ═══════════════════════════════════════════════ --}}
    <nav class="imp-nav" id="imp-nav" role="navigation" aria-label="Navegación principal">
        <div class="imp-nav__inner">

            {{-- Logo --}}
            <a class="imp-nav__logo" href="{{ route('web.home') }}" aria-label="IMPEERCOL — Ir al inicio">
                <img src="{{ asset('assets/img/logo/logo-white.png') }}"
                     class="imp-logo imp-logo--light"
                     alt="IMPEERCOL Logo"
                     width="190" height="50">
                <img src="{{ asset('assets/img/logo/logo.png') }}"
                     class="imp-logo imp-logo--dark"
                     alt="IMPEERCOL Logo"
                     width="190" height="50">
            </a>

            {{-- Menú de navegación desktop --}}
            <ul class="imp-nav__menu" role="list">
                <li class="imp-nav__item">
                    <a href="{{ route('web.home') }}" class="imp-nav__link">Inicio</a>
                </li>
                <li class="imp-nav__item">
                    <a href="{{ route('web.about') }}" class="imp-nav__link">Sobre nosotros</a>
                </li>
                <li class="imp-nav__item">
                    <a href="{{ route('web.projects') }}" class="imp-nav__link">Proyectos</a>
                </li>
                <li class="imp-nav__item">
                    <a href="{{ route('web.products') }}" class="imp-nav__link">Productos</a>
                </li>

                {{-- Dropdown: Soluciones --}}
                <li class="imp-nav__item imp-nav__item--has-drop" id="solucionesItem">
                    <button class="imp-nav__link imp-nav__link--drop"
                            type="button"
                            aria-expanded="false"
                            aria-haspopup="true"
                            id="solucionesBtn">
                        Soluciones
                        <svg class="imp-drop-arrow" width="11" height="11" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2.8"
                             stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="6 9 12 15 18 9"/>
                        </svg>
                    </button>

                    <div class="imp-dropdown" id="solucionesDropdown" role="menu" aria-labelledby="solucionesBtn">
                        <a class="imp-dropdown__item" href="{{ route('web.solutions.show', 'techos') }}" role="menuitem">
                            <span class="imp-dropdown__icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 10.5L12 3l9 7.5"/>
                                    <rect x="5" y="10" width="14" height="11" rx="1"/>
                                    <rect x="9" y="14" width="6" height="7"/>
                                </svg>
                            </span>
                            <span class="imp-dropdown__body">
                                <span class="imp-dropdown__title">Impermeabilización de Techos</span>
                                <span class="imp-dropdown__desc">Cubiertas planas e inclinadas de larga duración</span>
                            </span>
                            <svg class="imp-dropdown__chevron" width="13" height="13" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5"
                                 stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="9 18 15 12 9 6"/>
                            </svg>
                        </a>

                        <a class="imp-dropdown__item" href="{{ route('web.solutions.show', 'terrazas') }}" role="menuitem">
                            <span class="imp-dropdown__icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="14" width="20" height="4" rx="1"/>
                                    <line x1="6" y1="14" x2="6" y2="8"/>
                                    <line x1="12" y1="14" x2="12" y2="6"/>
                                    <line x1="18" y1="14" x2="18" y2="8"/>
                                </svg>
                            </span>
                            <span class="imp-dropdown__body">
                                <span class="imp-dropdown__title">Impermeabilización de Terrazas</span>
                                <span class="imp-dropdown__desc">Protección total para espacios transitables</span>
                            </span>
                            <svg class="imp-dropdown__chevron" width="13" height="13" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5"
                                 stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="9 18 15 12 9 6"/>
                            </svg>
                        </a>

                        <a class="imp-dropdown__item" href="{{ route('web.solutions.show', 'muros') }}" role="menuitem">
                            <span class="imp-dropdown__icon" aria-hidden="true">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="4" width="9" height="7" rx="1"/>
                                    <rect x="13" y="4" width="9" height="7" rx="1"/>
                                    <rect x="2" y="13" width="9" height="7" rx="1"/>
                                    <rect x="13" y="13" width="9" height="7" rx="1"/>
                                </svg>
                            </span>
                            <span class="imp-dropdown__body">
                                <span class="imp-dropdown__title">Impermeabilización de Muros</span>
                                <span class="imp-dropdown__desc">Sellado y recubrimiento contra filtraciones</span>
                            </span>
                            <svg class="imp-dropdown__chevron" width="13" height="13" viewBox="0 0 24 24"
                                 fill="none" stroke="currentColor" stroke-width="2.5"
                                 stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polyline points="9 18 15 12 9 6"/>
                            </svg>
                        </a>
                    </div>
                </li>

                <li class="imp-nav__item">
                    <a href="{{ route('web.blog') }}" class="imp-nav__link">Blog</a>
                </li>
                <li class="imp-nav__item">
                    <a href="{{ route('web.contact') }}" class="imp-nav__link">Contacto</a>
                </li>
            </ul>

            {{-- Acciones del lado derecho --}}
            <div class="imp-nav__actions">

                {{-- Botón búsqueda --}}
                <button class="imp-search-trigger" id="impSearchTrigger"
                        type="button" aria-label="Abrir búsqueda">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.2"
                         stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="11" cy="11" r="8"/>
                        <path d="m21 21-4.35-4.35"/>
                    </svg>
                </button>

                {{-- CTA WhatsApp --}}
                <a href="https://wa.me/573025069825?text=Hola%2C%20quiero%20asesor%C3%ADa%20en%20impermeabilizaci%C3%B3n"
                   class="imp-whatsapp-btn"
                   target="_blank"
                   rel="noopener noreferrer"
                   aria-label="Asesoría por WhatsApp"
                   data-conv>
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    <span class="imp-whatsapp-btn__text">Asesoría por WhatsApp</span>
                </a>

                {{-- Hamburger (solo móvil) --}}
                <button class="imp-hamburger" id="impHamburger"
                        type="button"
                        aria-label="Abrir menú"
                        aria-expanded="false"
                        aria-controls="impMobile">
                    <span class="imp-hamburger__bar"></span>
                    <span class="imp-hamburger__bar"></span>
                    <span class="imp-hamburger__bar"></span>
                </button>
            </div>

        </div>
    </nav>

    {{-- ═══════════════════════════════════════════════
         MENÚ MÓVIL (off-canvas, slide desde la derecha)
    ═══════════════════════════════════════════════ --}}
    <div class="imp-mobile" id="impMobile" role="dialog"
         aria-label="Menú de navegación" aria-hidden="true">
        <div class="imp-mobile__panel">

            <div class="imp-mobile__header">
                <a href="{{ route('web.home') }}" aria-label="IMPEERCOL — Inicio">
                    <img src="{{ asset('assets/img/logo/logo.png') }}" alt="IMPEERCOL" height="42" width="auto">
                </a>
                <button class="imp-mobile__close" id="impMobileClose"
                        type="button" aria-label="Cerrar menú">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="2.2"
                         stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>

            <nav class="imp-mobile__nav" aria-label="Menú móvil">
                <ul class="imp-mobile__list" role="list">
                    <li><a href="{{ route('web.home') }}" class="imp-mobile__link">Inicio</a></li>
                    <li><a href="{{ route('web.about') }}" class="imp-mobile__link">Sobre nosotros</a></li>
                    <li><a href="{{ route('web.projects') }}" class="imp-mobile__link">Proyectos</a></li>
                    <li><a href="{{ route('web.products') }}" class="imp-mobile__link">Productos</a></li>

                    <li class="imp-mobile__item--drop">
                        <button class="imp-mobile__link imp-mobile__drop-toggle"
                                id="mobileSolucionesToggle"
                                type="button"
                                aria-expanded="false"
                                aria-controls="mobileSolucionesMenu">
                            Soluciones
                            <svg class="imp-mobile__drop-arrow" width="16" height="16"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                 aria-hidden="true">
                                <polyline points="6 9 12 15 18 9"/>
                            </svg>
                        </button>
                        <ul class="imp-mobile__submenu" id="mobileSolucionesMenu" role="list">
                            <li>
                                <a href="{{ route('web.solutions.show', 'techos') }}" class="imp-mobile__sublink">
                                    <span class="imp-mobile__sublink-icon" aria-hidden="true">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 10.5L12 3l9 7.5"/>
                                            <rect x="5" y="10" width="14" height="11" rx="1"/>
                                        </svg>
                                    </span>
                                    Impermeabilización de Techos
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('web.solutions.show', 'terrazas') }}" class="imp-mobile__sublink">
                                    <span class="imp-mobile__sublink-icon" aria-hidden="true">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="2" y="14" width="20" height="4" rx="1"/>
                                            <line x1="12" y1="14" x2="12" y2="6"/>
                                        </svg>
                                    </span>
                                    Impermeabilización de Terrazas
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('web.solutions.show', 'muros') }}" class="imp-mobile__sublink">
                                    <span class="imp-mobile__sublink-icon" aria-hidden="true">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="2" y="4" width="9" height="7" rx="1"/>
                                            <rect x="13" y="4" width="9" height="7" rx="1"/>
                                        </svg>
                                    </span>
                                    Impermeabilización de Muros
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li><a href="{{ route('web.blog') }}" class="imp-mobile__link">Blog</a></li>
                    <li><a href="{{ route('web.contact') }}" class="imp-mobile__link">Contacto</a></li>
                </ul>
            </nav>

            <div class="imp-mobile__footer">
                <a href="https://wa.me/573025069825?text=Hola%2C%20quiero%20asesor%C3%ADa%20en%20impermeabilizaci%C3%B3n"
                   class="imp-whatsapp-btn imp-whatsapp-btn--block"
                   target="_blank"
                   rel="noopener noreferrer"
                   data-conv>
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    <span>Asesoría por WhatsApp</span>
                </a>
            </div>
        </div>
    </div>

    {{-- Overlay del menú móvil --}}
    <div class="imp-mobile__overlay" id="impMobileOverlay" aria-hidden="true"></div>

    {{-- ═══════════════════════════════════════════════
         OVERLAY DE BÚSQUEDA
    ═══════════════════════════════════════════════ --}}
    <div class="imp-search-overlay" id="impSearchOverlay"
         role="dialog" aria-label="Buscar" aria-hidden="true">
        <div class="imp-search-overlay__inner">
            <form method="GET" action="{{ route('web.products') }}" class="imp-search-form">
                <svg class="imp-search-form__icon" width="20" height="20" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="11" cy="11" r="8"/>
                    <path d="m21 21-4.35-4.35"/>
                </svg>
                <input type="text"
                       name="search"
                       id="impSearchInput"
                       class="imp-search-form__input"
                       placeholder="Buscar productos de impermeabilización..."
                       value="{{ request('search') }}"
                       autocomplete="off">
                <button type="submit" class="imp-search-form__btn">Buscar</button>
            </form>
            <button class="imp-search-overlay__close" id="impSearchClose"
                    type="button" aria-label="Cerrar búsqueda">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2.2"
                     stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>
    </div>

</header>

{{-- ═══════════════════════════════════════════════
     JAVASCRIPT DEL NAVBAR (inline, no dependencias)
═══════════════════════════════════════════════ --}}
<script>
(function () {
    'use strict';

    var nav            = document.getElementById('imp-nav');
    var hamburger      = document.getElementById('impHamburger');
    var mobile         = document.getElementById('impMobile');
    var mobileClose    = document.getElementById('impMobileClose');
    var mobileOverlay  = document.getElementById('impMobileOverlay');
    var searchTrigger  = document.getElementById('impSearchTrigger');
    var searchOverlay  = document.getElementById('impSearchOverlay');
    var searchClose    = document.getElementById('impSearchClose');
    var searchInput    = document.getElementById('impSearchInput');
    var solucionesItem = document.getElementById('solucionesItem');
    var solucionesBtn  = document.getElementById('solucionesBtn');
    var soludrop       = document.getElementById('solucionesDropdown');
    var mobileDropBtn  = document.getElementById('mobileSolucionesToggle');
    var mobileDropMenu = document.getElementById('mobileSolucionesMenu');

    /* ── Scroll: shrink + sombra ── */
    function onScroll() {
        if (window.scrollY > 50) {
            nav.classList.add('imp-nav--scrolled');
        } else {
            nav.classList.remove('imp-nav--scrolled');
        }
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    /* ── Menú móvil ── */
    function openMobile() {
        mobile.classList.add('imp-mobile--open');
        mobileOverlay.classList.add('imp-mobile__overlay--active');
        hamburger.setAttribute('aria-expanded', 'true');
        mobile.removeAttribute('aria-hidden');
        document.body.style.overflow = 'hidden';
    }
    function closeMobile() {
        mobile.classList.remove('imp-mobile--open');
        mobileOverlay.classList.remove('imp-mobile__overlay--active');
        hamburger.setAttribute('aria-expanded', 'false');
        mobile.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
        /* Devolver foco al hamburger al cerrar */
        if (hamburger) hamburger.focus();
    }
    if (hamburger)     hamburger.addEventListener('click', openMobile);
    if (mobileClose)   mobileClose.addEventListener('click', closeMobile);
    if (mobileOverlay) mobileOverlay.addEventListener('click', closeMobile);

    /* ── Submenú móvil: Soluciones ── */
    if (mobileDropBtn) {
        mobileDropBtn.addEventListener('click', function () {
            var open = mobileDropMenu.classList.toggle('imp-mobile__submenu--open');
            this.setAttribute('aria-expanded', String(open));
        });
    }

    /* ── Dropdown desktop: Soluciones ── */
    if (solucionesItem && soludrop) {
        solucionesItem.addEventListener('mouseenter', function () {
            soludrop.classList.add('imp-dropdown--open');
            solucionesBtn.setAttribute('aria-expanded', 'true');
        });
        solucionesItem.addEventListener('mouseleave', function () {
            soludrop.classList.remove('imp-dropdown--open');
            solucionesBtn.setAttribute('aria-expanded', 'false');
        });
        /* Clic en teclado */
        solucionesBtn.addEventListener('click', function () {
            var isOpen = soludrop.classList.contains('imp-dropdown--open');
            soludrop.classList.toggle('imp-dropdown--open', !isOpen);
            this.setAttribute('aria-expanded', String(!isOpen));
        });
        /* Cerrar al hacer clic fuera */
        document.addEventListener('click', function (e) {
            if (!solucionesItem.contains(e.target)) {
                soludrop.classList.remove('imp-dropdown--open');
                solucionesBtn.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /* ── Overlay de búsqueda ── */
    function openSearch() {
        searchOverlay.classList.add('imp-search-overlay--open');
        searchOverlay.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
        setTimeout(function () { if (searchInput) searchInput.focus(); }, 280);
    }
    function closeSearch() {
        searchOverlay.classList.remove('imp-search-overlay--open');
        searchOverlay.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
    }
    if (searchTrigger) searchTrigger.addEventListener('click', openSearch);
    if (searchClose)   searchClose.addEventListener('click', closeSearch);
    /* Cerrar con Escape */
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') { closeSearch(); closeMobile(); }
    });

})();
</script>
