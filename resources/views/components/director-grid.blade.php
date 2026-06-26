@props(['directors' => [], 'title' => null])

<section class="space-y-8">
    @if ($title)
        <h2 class="reveal section-label text-center sm:text-left">{{ $title }}</h2>
    @endif
    <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-3 lg:gap-4">
        @foreach ($directors as $director)
            <article class="reveal director-card group overflow-hidden">
                <div class="director-photo aspect-[3/4] overflow-hidden bg-[#111111]">
                    @if (!empty($director['photo']))
                        <img
                            src="{{ $director['photo'] }}"
                            alt="{{ $director['name'] }}"
                            class="h-full w-full object-cover grayscale transition duration-700 group-hover:scale-105"
                            loading="lazy"
                        />
                    @endif
                </div>
                <p class="mt-3 text-center text-[11px] font-medium uppercase tracking-[0.22em] text-white/85 sm:text-xs">{{ $director['name'] }}</p>
            </article>
        @endforeach
    </div>
</section>
