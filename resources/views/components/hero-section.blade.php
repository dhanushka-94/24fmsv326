@props(['background' => null])

@php
    $bgUrl = $background ?? asset(config('frames.hero_background', '/images/hero-background.png'));
    $youtubeId = config('frames.hero.youtube_id');
    $trustedLine = config('frames.home.trusted_line', 'Trusted by over 1000+ industry leading brands');
    $createWords = config('frames.home.create_words', ['Ads.', 'Documentaries', 'Films', 'AI Contents', 'Reels']);
@endphp

<section id="home" class="hero-section relative flex min-h-[100dvh] items-end justify-center overflow-hidden">
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

    <div class="hero-bottom-copy reveal reveal-slow relative z-10 w-full px-4 pb-16 pt-28 text-center sm:px-6 sm:pb-20 lg:pb-24">
        <h1 class="sr-only">24 Frames — We Create Ads, Documentaries, Films, AI Contents, and Reels</h1>
        <p class="hero-bottom-line" data-stagger-item>{{ $trustedLine }}</p>
        <p class="hero-bottom-line" data-stagger-item>
            We Create
            <span
                class="hero-create-rotator"
                x-data="heroCreateRotator(@js($createWords))"
                aria-live="polite"
            >
                <span class="hero-create-track">
                    <span class="hero-create-word" :class="leaving && 'is-out'" x-text="current"></span>
                    <span
                        class="hero-create-word is-next"
                        :class="leaving && 'is-in'"
                        x-show="leaving"
                        x-cloak
                        x-text="upcoming"
                    ></span>
                </span>
            </span>
        </p>
    </div>
</section>
