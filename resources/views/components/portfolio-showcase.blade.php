@props([
    'items' => [],
    'intro' => null,
    'showreelYoutubeId' => null,
])

@php
    $showreelId = $showreelYoutubeId ?: config('frames.hero.youtube_id');
    $showreelEmbed = $showreelId
        ? "https://www.youtube.com/embed/{$showreelId}?autoplay=1&rel=0"
        : null;
    $showreelThumb = $showreelId
        ? "https://img.youtube.com/vi/{$showreelId}/maxresdefault.jpg"
        : null;
@endphp

<div
    x-data="videoTheater()"
    @open-video.window="open($event.detail)"
    @keydown.escape.window="close()"
    class="portfolio-showcase"
>
    @if ($showreelEmbed)
        <section class="portfolio-hero reveal">
            <button
                type="button"
                class="portfolio-hero-media group"
                @click="open({ url: @js($showreelEmbed), title: @js('Showreel') })"
            >
                @if ($showreelThumb)
                    <img
                        src="{{ $showreelThumb }}"
                        alt="24 Frames showreel"
                        class="portfolio-hero-img"
                        loading="eager"
                        decoding="async"
                    />
                @endif
                <span class="portfolio-hero-overlay" aria-hidden="true"></span>
                <span class="portfolio-hero-play" aria-hidden="true">
                    <i data-lucide="play" class="size-7 text-white"></i>
                </span>
            </button>
        </section>
    @endif

    @if ($intro)
        <p class="portfolio-copy reveal">{{ $intro }}</p>
    @endif

    <div class="portfolio-grid">
        @forelse ($items as $index => $item)
            @php
                $embedUrl = null;
                if ($item->youtube_url && preg_match('/(?:youtu\.be\/|v=|embed\/)([A-Za-z0-9_-]{11})/', $item->youtube_url, $matches)) {
                    $embedUrl = "https://www.youtube.com/embed/{$matches[1]}?autoplay=1&rel=0";
                }
            @endphp
            <article class="reveal portfolio-card group" data-portfolio-index="{{ $index }}">
                @if ($embedUrl)
                    <button
                        type="button"
                        class="portfolio-thumb portfolio-card-shell"
                        @click="open({ url: @js($embedUrl), title: @js($item->title) })"
                    >
                @else
                    <a
                        href="{{ $item->youtube_url }}"
                        target="_blank"
                        rel="noreferrer"
                        class="portfolio-thumb portfolio-card-shell"
                    >
                @endif
                    <div class="portfolio-card-media">
                        @if ($item->thumbnailSrc())
                            <img
                                src="{{ $item->thumbnailSrc() }}"
                                alt="{{ $item->title }}"
                                class="portfolio-card-img"
                                loading="lazy"
                            />
                        @else
                            <div class="portfolio-card-placeholder" aria-hidden="true"></div>
                        @endif
                        <span class="portfolio-card-overlay" aria-hidden="true"></span>
                        <span class="portfolio-card-play" aria-hidden="true">
                            <i data-lucide="play" class="size-5 text-white"></i>
                        </span>
                    </div>
                    <span class="sr-only">{{ $item->title }}</span>
                @if ($embedUrl)
                    </button>
                @else
                    </a>
                @endif
            </article>
        @empty
            <p class="portfolio-empty">No portfolio items published yet.</p>
        @endforelse
    </div>

    @if ($items->isNotEmpty())
        <div class="portfolio-scroll-hint reveal" aria-hidden="true">
            <span class="portfolio-scroll-mouse">
                <i data-lucide="mouse" class="size-5"></i>
                <i data-lucide="chevron-down" class="portfolio-scroll-arrow size-4"></i>
            </span>
        </div>
    @endif

    <div
        x-show="active"
        x-cloak
        class="video-theater fixed inset-0 z-[90] flex items-center justify-center bg-black/95 p-4 backdrop-blur-sm"
        @click.self="close()"
    >
        <button type="button" class="absolute top-6 right-6 text-white/70 hover:text-white" @click="close()" aria-label="Close video">
            <i data-lucide="x" class="size-6"></i>
        </button>
        <div class="w-full max-w-6xl">
            <p class="mb-4 text-center text-sm uppercase tracking-[0.25em] text-white/60" x-text="title"></p>
            <div class="aspect-video overflow-hidden rounded-2xl bg-black shadow-2xl ring-1 ring-white/10">
                <iframe
                    x-show="url"
                    class="h-full w-full"
                    :src="url"
                    title="Portfolio video"
                    allow="autoplay; encrypted-media"
                    allowfullscreen
                ></iframe>
            </div>
        </div>
    </div>
</div>
