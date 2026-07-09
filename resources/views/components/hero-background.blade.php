@php
    $heroVideo = config('frames.hero.video');
    $youtubeId = config('frames.hero.youtube_id');
    $bgUrl = asset(config('frames.hero_background', '/images/hero-background.png'));
@endphp

@if ($heroVideo)
    <div class="hero-video-wrap">
        <x-hero-video-background />
    </div>
@elseif ($youtubeId)
    <div class="hero-video-wrap">
        <x-youtube-background />
    </div>
@else
    <div class="ken-burns-wrap h-full w-full">
        <img
            src="{{ $bgUrl }}"
            alt=""
            class="ken-burns-img h-full w-full object-cover object-center"
            loading="eager"
            fetchpriority="high"
        />
    </div>
@endif
