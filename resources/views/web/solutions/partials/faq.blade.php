@php
    $faqs = $faqs ?? [];
    $faqParentId = $faqParentId ?? 'faqSoluciones';
@endphp
@if(count($faqs) > 0)
<section class="faq-area de-padding pt-0">
    <div class="container">
        <div class="row mb-40">
            <div class="col-xl-8 offset-xl-2 text-center">
                <h2 class="hero-title mb-20">Preguntas frecuentes</h2>
                <p class="mb-0">Resolvemos dudas habituales sobre <strong>selección y suministro de productos</strong> para impermeabilizar.</p>
            </div>
        </div>
        <div class="accordion" id="{{ $faqParentId }}">
            @foreach($faqs as $index => $faq)
                @php $i = $index + 1; $show = $index === 0; @endphp
                <div class="accordion-item">
                    <h3 class="accordion-header" id="{{ $faqParentId }}-h{{ $i }}">
                        <button class="accordion-button{{ $show ? '' : ' collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#{{ $faqParentId }}-c{{ $i }}" aria-expanded="{{ $show ? 'true' : 'false' }}" aria-controls="{{ $faqParentId }}-c{{ $i }}">
                            {{ $faq['q'] }}
                        </button>
                    </h3>
                    <div id="{{ $faqParentId }}-c{{ $i }}" class="accordion-collapse collapse{{ $show ? ' show' : '' }}" aria-labelledby="{{ $faqParentId }}-h{{ $i }}" data-bs-parent="#{{ $faqParentId }}">
                        <div class="accordion-body">
                            {!! nl2br(e($faq['a'])) !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
