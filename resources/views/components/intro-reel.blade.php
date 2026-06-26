@php
    $reel = config('frames.show_reel', []);
@endphp

@if (!empty($reel['enabled']))
    <div
        x-data="introReel()"
        x-show="visible"
        x-cloak
        class="intro-reel fixed inset-0 z-[100] flex items-center justify-center bg-black"
        @keydown.escape.window="skip()"
    >
        <template x-if="phase === 'video'">
            <div class="absolute inset-0">
                <iframe
                    class="h-full w-full object-cover"
                    :src="`https://www.youtube.com/embed/{{ $reel['youtube_id'] ?? '' }}?autoplay=1&mute=1&controls=0&rel=0&modestbranding=1&playsinline=1&enablejsapi=1`"
                    title="24 Frames show reel"
                    allow="autoplay; encrypted-media"
                    allowfullscreen
                ></iframe>
                <div class="absolute inset-0 bg-black/30"></div>
                <button type="button" class="absolute top-6 right-6 z-10 text-xs uppercase tracking-[0.2em] text-white/70 hover:text-white" @click="skip()">Skip</button>
            </div>
        </template>

        <template x-if="phase === 'logo'">
            <div class="flex flex-col items-center gap-6 px-6 text-center animate-fade-in">
                <x-site-logo size="xl" class="mx-auto max-w-[20rem] sm:max-w-[24rem]" />
                <p class="text-sm uppercase tracking-[0.45em] text-white/80">{{ $reel['tagline'] ?? 'Art house for films.' }}</p>
            </div>
        </template>
    </div>
@endif
