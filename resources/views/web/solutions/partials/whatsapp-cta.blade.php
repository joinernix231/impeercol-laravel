{{-- CTA visible: $whatsappAdvisoryUrl obligatorio
     No usar .contact-right aquí: en style.css es flex en fila y aplasta título + texto + botón. --}}
@isset($whatsappAdvisoryUrl)
<div class="container de-padding pt-0">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-xxl-9">
            <div class="contact-bg-animated solution-whatsapp-cta">
                <div class="solution-whatsapp-cta__inner">
                    <h2 class="hero-title solution-whatsapp-cta__title">{{ $whatsappCtaTitle ?? '¿Listo para elegir el producto correcto?' }}</h2>
                    <p class="solution-whatsapp-cta__lead">{{ $whatsappCtaText ?? 'Cuéntanos tu problema, tipo de cubierta y zona. Te respondemos por WhatsApp con orientación de sistema y referencias.' }}</p>
                    <a href="{{ $whatsappAdvisoryUrl }}" class="btn-whatsapp-primary solution-whatsapp-cta__btn" target="_blank" rel="noopener noreferrer" id="cta-whatsapp-soluciones" data-conv>
                        <i class="fab fa-whatsapp" aria-hidden="true"></i>
                        <span>{{ $whatsappCtaLabel ?? 'Solicitar asesoría por WhatsApp' }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endisset
