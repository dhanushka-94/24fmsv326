@props(['title' => null, 'description' => null, 'anchored' => false])

<div {{ $attributes->merge(['class' => 'site-shell relative min-h-screen'.($anchored ? ' page-shell--anchored' : '')]) }}>
    @if (request()->routeIs('home') && config('frames.loader.enabled', true) && (config('frames.hero.video') || config('frames.hero.youtube_id')))
        <x-logo-loader />
    @endif

    <div @class(['site-chrome', 'flex min-h-screen flex-col' => $anchored])>
        @include('partials.header')

        <div @class(['site-body relative z-10', 'flex flex-1 flex-col' => $anchored])>
            {{ $slot }}
        </div>

        @if ($showClientCarousel ?? false)
            <x-client-marquee :clients="$siteClients ?? collect()" />
        @endif

        <x-floating-actions />
    </div>
</div>
