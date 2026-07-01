@props(['title' => null, 'description' => null])

<div {{ $attributes->merge(['class' => 'bloom-surface art-canvas relative min-h-screen']) }}>
    <div class="art-grain pointer-events-none" aria-hidden="true"></div>
    <div class="art-grid pointer-events-none" aria-hidden="true"></div>
    <div class="art-ambient" aria-hidden="true">
        <span class="art-ambient-shape art-ambient-shape--one"></span>
        <span class="art-ambient-shape art-ambient-shape--two"></span>
        <span class="art-ambient-shape art-ambient-shape--three"></span>
    </div>

    @if (request()->routeIs('home') && config('frames.loader.enabled', true) && config('frames.hero.youtube_id'))
        <x-logo-loader />
    @endif

    <div class="site-chrome">
        @include('partials.header')

        <div class="relative z-10">
            {{ $slot }}
        </div>

        @include('partials.footer')

        <x-floating-actions />
    </div>
</div>
