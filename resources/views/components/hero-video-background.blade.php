@php
    $videoPath = config('frames.hero.video');
    $videoSrc = $videoPath ? asset($videoPath) : null;
@endphp

@if ($videoSrc)
    <div
        class="hero-video-embed"
        x-data="heroVideoBackground()"
        x-init="init()"
    >
        <video
            class="hero-video-media"
            muted
            loop
            playsinline
            preload="auto"
            aria-hidden="true"
            @canplay="onReady()"
            @loadeddata="onReady()"
        >
            <source src="{{ $videoSrc }}" type="video/mp4">
        </video>
        <div class="hero-video-shield" :class="ready && 'hero-video-shield--hidden'" aria-hidden="true"></div>
    </div>
@endif
