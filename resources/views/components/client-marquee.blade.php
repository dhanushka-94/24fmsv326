@props(['brands' => []])

@if (count($brands))
    <section {{ $attributes->merge(['class' => 'brand-showcase']) }}>
        <div class="brand-showcase-header reveal">
            <p class="section-label">Our Clients</p>
            <p class="brand-showcase-title text-drift text-animate-loop" data-animate-loop="true">Trusted by global and local brands</p>
        </div>

        <div class="marquee-section">
            <div class="marquee-track">
                <div class="marquee-content">
                    @foreach (array_merge($brands, $brands) as $brand)
                        <span class="marquee-item">{{ $brand }}</span>
                    @endforeach
                </div>
                <div class="marquee-content" aria-hidden="true">
                    @foreach (array_merge($brands, $brands) as $brand)
                        <span class="marquee-item">{{ $brand }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
