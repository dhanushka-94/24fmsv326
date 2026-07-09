@props(['background' => null])

@php
    $trustedLine = config('frames.home.trusted_line', 'Trusted by over 1000+ industry leading brands');
    $createWords = config('frames.home.create_words', ['Ads.', 'Documentaries', 'Films', 'AI Contents', 'Reels']);
@endphp

<section id="home" class="hero-section relative flex min-h-[100dvh] items-end justify-center overflow-hidden">
    <div class="absolute inset-0 z-0" aria-hidden="true">
        <x-hero-background />
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
                    <span
                        class="hero-create-word"
                        :class="!visible && 'is-fading'"
                        x-text="current"
                    ></span>
                </span>
            </span>
        </p>
    </div>
</section>
