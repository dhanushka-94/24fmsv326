@props([
    'tagline' => null,
    'taglineHtml' => null,
    'description' => null,
    'srTitle' => null,
])

<section {{ $attributes->merge(['class' => 'page-tagline-section']) }}>
    <div class="page-tagline-inner">
        <div class="page-tagline-wrap reveal reveal-slow" data-stagger>
            @if ($taglineHtml)
                <p class="page-tagline" data-stagger-item>{!! $taglineHtml !!}</p>
            @elseif ($tagline)
                <p class="page-tagline" data-stagger-item>{{ $tagline }}</p>
            @endif

            @if ($description)
                <p class="page-tagline-desc" data-stagger-item>{{ $description }}</p>
            @endif

            @if ($srTitle)
                <h1 class="sr-only">{{ $srTitle }}</h1>
            @endif

            {{ $slot }}
        </div>
    </div>
</section>
