@props(['iframeClass' => 'hero-video-iframe'])

@php
    $youtubeId = config('frames.hero.youtube_id');
    $startAt = (int) config('frames.hero.youtube_start', 10);
    $origin = urlencode(config('app.url') ?: config('frames.site_url', 'https://www.24frames.lk'));
    $embedUrl = $youtubeId
        ? 'https://www.youtube-nocookie.com/embed/'.$youtubeId
            .'?autoplay=1&mute=1&controls=0&rel=0&modestbranding=1&playsinline=1'
            .'&loop=1&playlist='.$youtubeId
            .'&start='.$startAt
            .'&iv_load_policy=3&disablekb=1&fs=0&cc_load_policy=0'
            .'&enablejsapi=1&origin='.$origin
        : null;
@endphp

@if ($embedUrl)
    <div
        class="hero-video-embed"
        x-data="heroVideoBackground()"
        x-init="init()"
    >
        <iframe
            {{ $attributes->merge(['class' => $iframeClass]) }}
            src="{{ $embedUrl }}"
            title=""
            allow="autoplay; encrypted-media; picture-in-picture"
            referrerpolicy="strict-origin-when-cross-origin"
            tabindex="-1"
            @load="onReady()"
        ></iframe>
        <div class="hero-video-chrome-cover" aria-hidden="true"></div>
        <div class="hero-video-shield" :class="ready && 'hero-video-shield--hidden'" aria-hidden="true"></div>
    </div>
@endif
