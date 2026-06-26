@props(['brands' => []])

@if (count($brands))
    <section {{ $attributes->merge(['class' => 'marquee-section border-y border-white/10 py-10']) }}>
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
    </section>
@endif
