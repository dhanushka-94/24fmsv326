@props(['title' => null, 'description' => null, 'anchored' => false])

<div {{ $attributes->merge(['class' => 'bloom-surface art-canvas relative min-h-screen'.($anchored ? ' page-shell--anchored' : '')]) }}>
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

    <div @class(['site-chrome', 'flex min-h-screen flex-col' => $anchored])>
        @include('partials.header')

        <div @class(['site-body relative z-10', 'flex flex-1 flex-col' => $anchored])>
            {{ $slot }}
        </div>

        @include('partials.footer')

        <x-client-marquee :clients="$siteClients ?? collect()" />

        <x-floating-actions />
    </div>
</div>
