@props([
    'items' => [],
    'featured' => null,
    'intro' => null,
])

<div
    x-data="videoTheater()"
    @open-video.window="open($event.detail)"
    @keydown.escape.window="close()"
    class="portfolio-showcase"
>
    @if ($featured)
        <section class="portfolio-hero reveal">
            @if ($featured->embedUrl())
                <button
                    type="button"
                    class="portfolio-hero-media group"
                    @click="open({ url: @js($featured->embedUrl()), title: @js($featured->title) })"
                >
                    @if ($featured->heroThumbnailSrc())
                        <img
                            src="{{ $featured->heroThumbnailSrc() }}"
                            alt="{{ $featured->title }}"
                            class="portfolio-hero-img"
                            loading="eager"
                            decoding="async"
                        />
                    @endif
                    <span class="portfolio-hero-overlay" aria-hidden="true"></span>
                    <span class="portfolio-hero-play" aria-hidden="true">
                        <i data-lucide="play" class="size-7 text-white"></i>
                    </span>
                    <span class="sr-only">{{ $featured->title }}</span>
                </button>
            @else
                <div class="portfolio-hero-media portfolio-hero-media--static">
                    @if ($featured->heroThumbnailSrc())
                        <img
                            src="{{ $featured->heroThumbnailSrc() }}"
                            alt="{{ $featured->title }}"
                            class="portfolio-hero-img"
                            loading="eager"
                            decoding="async"
                        />
                    @endif
                    <span class="sr-only">{{ $featured->title }}</span>
                </div>
            @endif
        </section>
    @endif

    @if ($intro)
        <p class="portfolio-copy reveal">{{ $intro }}</p>
    @endif

    <div class="portfolio-grid">
        @forelse ($items as $index => $item)
            <article class="reveal portfolio-card group" data-portfolio-index="{{ $index }}">
                @if ($item->embedUrl())
                    <button
                        type="button"
                        class="portfolio-thumb portfolio-card-shell"
                        @click="open({ url: @js($item->embedUrl()), title: @js($item->title) })"
                    >
                        <div class="portfolio-card-media">
                            @if ($item->heroThumbnailSrc())
                                <img
                                    src="{{ $item->heroThumbnailSrc() }}"
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
                    </button>
                @else
                    <div class="portfolio-thumb portfolio-card-shell portfolio-card-shell--static">
                        <div class="portfolio-card-media">
                            @if ($item->heroThumbnailSrc())
                                <img
                                    src="{{ $item->heroThumbnailSrc() }}"
                                    alt="{{ $item->title }}"
                                    class="portfolio-card-img"
                                    loading="lazy"
                                />
                            @else
                                <div class="portfolio-card-placeholder" aria-hidden="true"></div>
                            @endif
                        </div>
                        <span class="sr-only">{{ $item->title }}</span>
                    </div>
                @endif
            </article>
        @empty
            @unless ($featured)
                <p class="portfolio-empty">No portfolio items published yet.</p>
            @endunless
        @endforelse
    </div>

    @if ($items->isNotEmpty() || $featured)
        <div class="portfolio-scroll-hint reveal" aria-hidden="true">
            <i data-lucide="chevron-down" class="portfolio-scroll-arrow size-6"></i>
        </div>
    @endif

    <template x-teleport="body">
        <div
            x-show="active"
            x-cloak
            class="video-theater fixed inset-0 z-[100] flex items-center justify-center bg-black/95 p-4 backdrop-blur-sm"
            @click.self="close()"
            role="dialog"
            aria-modal="true"
            :aria-label="title || 'Portfolio video'"
        >
            <button
                type="button"
                class="video-theater-close absolute top-5 right-5 z-[110] inline-flex size-12 items-center justify-center rounded-full border border-white/20 bg-black/70 text-white backdrop-blur-sm transition hover:border-white/40 hover:bg-black hover:text-white sm:top-6 sm:right-6"
                @click.stop="close()"
                aria-label="Close video"
            >
                <i data-lucide="x" class="size-6 pointer-events-none"></i>
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
    </template>
</div>
