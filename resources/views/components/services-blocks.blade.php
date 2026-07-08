@props(['pillars' => [], 'roster' => null])

@php
    $icons = [
        'production' => 'video',
        'creative' => 'lightbulb',
        'digital' => 'cpu',
        'roster' => 'clapperboard',
    ];
@endphp

<section class="services-blocks reveal">
    <div class="services-blocks-grid">
        @foreach ($pillars as $pillar)
            <article class="services-block" data-stagger-item>
                <div class="services-block-icon" aria-hidden="true">
                    <i data-lucide="{{ $icons[$pillar['key']] ?? 'circle' }}" class="size-8"></i>
                </div>
                <h2 class="services-block-title">{{ $pillar['title'] }}</h2>
                <p class="services-block-body">{{ $pillar['body'] }}</p>
            </article>
        @endforeach

        @if ($roster)
            <article class="services-block" data-stagger-item>
                <div class="services-block-icon" aria-hidden="true">
                    <i data-lucide="{{ $icons['roster'] }}" class="size-8"></i>
                </div>
                <h2 class="services-block-title">{{ $roster['title'] }}</h2>
                <p class="services-block-body">{{ $roster['body'] }}</p>
            </article>
        @endif
    </div>
</section>
