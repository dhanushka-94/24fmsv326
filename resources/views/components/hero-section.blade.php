@props(['background' => null, 'quote' => null])

@php
    $bgUrl = $background ?? asset(config('frames.hero_background', '/images/hero-background.png'));
    $heroQuote = $quote ?? config('frames.hero.quote', 'Crafting Stories, Frame by Frame');
    $youtubeId = config('frames.hero.youtube_id');
@endphp

<section id="home" class="relative flex min-h-[100dvh] items-end overflow-hidden lg:items-center">
    <div class="absolute inset-0 z-0" aria-hidden="true">
        @if ($youtubeId)
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
        <div class="absolute inset-0 hero-video-overlay"></div>
    </div>

    <div class="relative z-10 mx-auto w-full max-w-7xl px-4 pb-14 pt-28 sm:px-6 sm:pb-16 sm:pt-32 lg:px-12 lg:py-24">
        <div class="reveal max-w-3xl space-y-6">
            <p class="art-quote">{{ $heroQuote }}</p>
            <h1 class="sr-only">24 Frames — Art House For Film</h1>
            <x-site-logo size="xl" class="max-w-none" />
            <p class="max-w-xl text-sm leading-relaxed text-body sm:text-base">
                Sri Lanka’s premier full-service motion picture production house — built for international agencies and global brands.
            </p>
            <div class="flex flex-wrap gap-3 pt-2">
                <a href="{{ route('portfolio') }}" class="btn btn-lg btn-primary">View Work</a>
                <a href="{{ route('contact') }}" class="btn btn-lg btn-outline">Contact</a>
            </div>
        </div>
    </div>
</section>
