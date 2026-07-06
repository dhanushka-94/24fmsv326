@props(['items' => []])

<div
    x-data="videoTheater()"
    @open-video.window="open($event.detail)"
    @keydown.escape.window="close()"
>
    <div class="portfolio-grid">
        @forelse ($items as $index => $item)
            @php
                $embedUrl = null;
                if ($item->youtube_url && preg_match('/(?:youtu\.be\/|v=|embed\/)([A-Za-z0-9_-]{11})/', $item->youtube_url, $matches)) {
                    $embedUrl = "https://www.youtube.com/embed/{$matches[1]}?autoplay=1&rel=0";
                }
                $featured = $index === 0;
            @endphp
            <article
                class="reveal portfolio-card group {{ $featured ? 'portfolio-card--featured' : '' }}"
                data-portfolio-index="{{ $index }}"
            >
                @if ($embedUrl)
                    <button
                        type="button"
                        class="portfolio-thumb relative block h-full w-full overflow-hidden text-left"
                        @click="open({ url: @js($embedUrl), title: @js($item->title) })"
                    >
                @else
                    <a
                        href="{{ $item->youtube_url }}"
                        target="_blank"
                        rel="noreferrer"
                        class="portfolio-thumb relative block h-full w-full overflow-hidden"
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
                            <div class="flex h-full min-h-[220px] items-center justify-center bg-white/5">
                                <i data-lucide="play" class="size-10 text-white/40"></i>
                            </div>
                        @endif
                        <div class="portfolio-card-overlay"></div>
                        <div class="portfolio-card-play">
                            <span class="flex size-14 items-center justify-center rounded-full border border-white/40 bg-black/50 backdrop-blur-sm">
                                <i data-lucide="play" class="size-6 text-white"></i>
                            </span>
                        </div>
                    </div>
                    <div class="portfolio-card-body">
                        @if ($item->category)
                            <p class="role-label mb-2">{{ $item->category }}</p>
                        @endif
                        <h3 class="portfolio-card-title" data-animate-text>{{ $item->title }}</h3>
                        @if ($item->description && $featured)
                            <p class="portfolio-card-desc">{{ $item->description }}</p>
                        @endif
                    </div>
                @if ($embedUrl)
                    </button>
                @else
                    </a>
                @endif
            </article>
        @empty
            <p class="col-span-full text-sm text-muted">No portfolio items published yet.</p>
        @endforelse
    </div>

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
            <div class="aspect-video overflow-hidden bg-black shadow-2xl">
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
