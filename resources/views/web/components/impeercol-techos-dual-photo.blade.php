{{--
  IMP-GALLERY-REVEAL
  Bloque 100% independiente (sin .about-photo): dos fotos verticales,
  crossfade + zoom en hover, esquinas animadas y pill de hint.
  Imágenes reales del almacén IMPEERCOL.
--}}
@php
    $frontUrl = asset('assets/img/Productos%20techos%202.jpeg');
    $backUrl  = asset('assets/img/Productos%20techoss.jpeg');
    $label    = $alt ?? 'Productos para impermeabilización de techos en Bogotá';
@endphp

<div class="imp-gallery-reveal" tabindex="0" aria-label="{{ $label }}">

    {{-- Marco principal con altura fija --}}
    <div class="imp-gallery-reveal__track">

        {{-- Foto de fondo (segunda): se revela al hacer hover --}}
        <img class="imp-gallery-reveal__img imp-gallery-reveal__img--b"
             src="{{ $backUrl }}"
             alt=""
             aria-hidden="true"
             loading="lazy"
             decoding="async">

        {{-- Foto principal (primera): visible por defecto --}}
        <img class="imp-gallery-reveal__img imp-gallery-reveal__img--f"
             src="{{ $frontUrl }}"
             alt="{{ $label }}"
             loading="lazy"
             decoding="async">

        {{-- Pill: instrucción de interacción --}}
        <div class="imp-gallery-reveal__hint" aria-hidden="true">
            <svg viewBox="0 0 24 24" aria-hidden="true">
                <path d="M5 12h14M12 5l7 7-7 7"/>
            </svg>
            <span>Hover para ver</span>
        </div>

    </div>{{-- /.imp-gallery-reveal__track --}}

    {{-- Esquinas decorativas (fuera del track para no quedar recortadas) --}}
    <span class="imp-gallery-reveal__corner imp-gallery-reveal__corner--tl" aria-hidden="true"></span>
    <span class="imp-gallery-reveal__corner imp-gallery-reveal__corner--tr" aria-hidden="true"></span>
    <span class="imp-gallery-reveal__corner imp-gallery-reveal__corner--bl" aria-hidden="true"></span>
    <span class="imp-gallery-reveal__corner imp-gallery-reveal__corner--br" aria-hidden="true"></span>

</div>{{-- /.imp-gallery-reveal --}}
