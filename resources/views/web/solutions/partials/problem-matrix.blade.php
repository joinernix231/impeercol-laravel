{{-- Matriz: problema → orientación de producto ($matrix como array de filas) --}}
@php
    $matrix = $matrix ?? [];
@endphp
@if(count($matrix) > 0)
<section class="service-2-area de-padding pt-0">
    <div class="container">
        <div class="row mb-40">
            <div class="col-xl-10">
                <h2 class="hero-title mb-20">¿Qué producto necesitas según tu problema?</h2>
                <p class="mb-0">
                    No se trata solo de “pintar el techo”: cada filtración tiene contexto. Esta guía resume
                    <strong>qué tipo de solución suele evaluarse</strong>; en tienda afinamos referencia y consumo según fotos y medidas.
                </p>
            </div>
        </div>
        <div class="service-2-wpr grid-3">
            @foreach($matrix as $row)
                <div class="service-2-box">
                    <div class="service-2-icon"><i class="icofont-bullseye"></i></div>
                    <div class="service-2-desc">
                        <h3>{{ $row['title'] }}</h3>
                        <p class="mb-2">{{ $row['body'] }}</p>
                        @if(!empty($row['hint']))
                            <p class="mb-0"><small class="text-muted"><strong>Productos frecuentes:</strong> {{ $row['hint'] }}</small></p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
