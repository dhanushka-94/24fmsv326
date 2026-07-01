@props(['items' => []])

<div
    x-data="videoTheater()"
    @open-video.window="open($event.detail)"
    @keydown.escape.window="close()"
>
    <div class="portfolio-stack space-y-20 lg:space-y-28">
        @forelse ($items as $index => $item)
            @php
                $embedUrl = null;
                if ($item->youtube_url && preg_match('/(?:youtu\.be\/|v=|embed\/)([A-Za-z0-9_-]{11})/', $item->youtube_url, $matches)) {
                    $embedUrl = "https://www.youtube.com/embed/{$matches[1]}?autoplay=1&rel=0";
                }
            @endphp
            <article
                class="reveal portfolio-feature group"
                data-portfolio-index="{{ $index }}"
            >
                @if ($embedUrl)
                    <button
                        type="button"
                        class="portfolio-thumb relative block w-full overflow-hidden text-left"
                        @click="open({ url: @js($embedUrl), title: @js($item->title) })"
                    >
                @else
                    <a
                        href="{{ $item->youtube_url }}"
                        target="_blank"
                        rel="noreferrer"
                        class="portfolio-thumb relative block w-full overflow-hidden"
                    >
                @endif
                    @if ($item->thumbnailSrc())
                        <img
                            src="{{ $item->thumbnailSrc() }}"
                            alt="{{ $item->title }}"
                            class="h-[50vh] min-h-[280px] w-full object-cover transition duration-700 group-hover:scale-[1.03] sm:h-[60vh] lg:h-[70vh]"
                            loading="lazy"
                        />
                    @else
                        <div class="flex h-[50vh] min-h-[280px] items-center justify-center bg-white/5 sm:h-[60vh] lg:h-[70vh]">
                            <i data-lucide="play" class="size-12 text-white/40"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/20 to-transparent"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 transition group-hover:opacity-100">
                        <span class="flex size-16 items-center justify-center rounded-full border border-white/40 bg-black/50 backdrop-blur-sm">
                            <i data-lucide="play" class="size-7 text-white"></i>
                        </span>
                    </div>
                    <div class="absolute bottom-0 left-0 p-6 sm:p-10 lg:p-12">
                        @if ($item->category)
                            <p class="role-label mb-3 !text-base sm:!text-lg">{{ $item->category }}</p>
                        @endif
                        <h3 class="portfolio-feature-title">{{ $item->title }}</h3>
                        @if ($item->description)
                            <p class="mt-3 max-w-2xl text-base leading-relaxed text-white/80 sm:text-lg">{{ $item->description }}</p>
                        @endif
                    </div>
                @if ($embedUrl)
                    </button>
                @else
                    </a>
                @endif
            </article>
        @empty
            <p class="text-sm text-muted">No portfolio items published yet.</p>
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
