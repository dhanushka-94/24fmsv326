@php
    $duration = (int) config('frames.loader.duration_ms', 4000);
@endphp

@if (config('frames.hero.youtube_id') && config('frames.loader.enabled', true))
    <div
        x-data="logoLoader({{ $duration }})"
        x-show="visible"
        x-transition:leave="transition-all duration-[1100ms] ease-[cubic-bezier(0.4,0,0.2,1)]"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="logo-loader fixed inset-0 z-[200] flex items-center justify-center bg-black"
    >
        <div
            class="logo-loader-backdrop absolute inset-0"
            :class="leaving && 'logo-loader-backdrop-exit'"
            aria-hidden="true"
        >
            <div class="hero-video-wrap">
                <x-youtube-background />
            </div>
            <div class="absolute inset-0 bg-black/50"></div>
        </div>

        <div
            class="logo-loader-reveal relative z-10 w-[min(92vw,44rem)] px-4 sm:w-[min(88vw,52rem)]"
            :class="leaving && 'logo-loader-exit'"
        >
            <x-site-logo size="loader" class="w-full" :animate="true" />
        </div>
    </div>
@endif
