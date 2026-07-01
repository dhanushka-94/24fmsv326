@props(['directors' => [], 'title' => null])

<section class="space-y-10">
    @if ($title)
        <h2 class="reveal section-heading text-center sm:text-left">{{ $title }}</h2>
    @endif
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:gap-6">
        @foreach ($directors as $director)
            <article class="reveal director-card group overflow-hidden">
                <div class="director-photo aspect-[3/4] overflow-hidden border border-[#f4f0ea]/10 bg-[#111111]">
                    @if (!empty($director['photo']))
                        <img
                            src="{{ $director['photo'] }}"
                            alt="{{ $director['name'] }}"
                            class="h-full w-full object-cover grayscale transition duration-700 group-hover:scale-105"
                            loading="lazy"
                        />
                    @endif
                </div>
                <p class="mt-4 text-center font-display text-sm font-medium uppercase tracking-[0.14em] text-[#f4f0ea]/90 sm:text-base">{{ $director['name'] }}</p>
            </article>
        @endforeach
    </div>
</section>
