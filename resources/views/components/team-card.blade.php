@props([
    'role',
    'name',
    'imdb' => null,
    'bio' => null,
    'photo' => null,
    'instagram' => null,
    'linkedin' => null,
])

<article class="card-surface group flex flex-col justify-between p-6 transition hover:border-[#ff4d3d]/40 sm:p-7">
    <div class="space-y-4">
        @if ($photo)
            <div class="overflow-hidden border border-[#f4f0ea]/10">
                <img src="{{ $photo }}" alt="{{ $name }}" class="h-44 w-full object-cover grayscale transition duration-500 group-hover:scale-105 group-hover:grayscale-[0.3]" loading="lazy" />
            </div>
        @endif
        <p class="role-label">{{ $role }}</p>
        <p class="font-display text-xl font-semibold uppercase tracking-wide text-[#f4f0ea] sm:text-2xl">{{ $name }}</p>
        @if ($bio)
            <p class="text-body text-base sm:text-lg">{{ $bio }}</p>
        @endif
    </div>
    @if ($imdb || $instagram || $linkedin)
        <div class="mt-5 flex flex-wrap gap-4 border-t border-[#f4f0ea]/10 pt-5 text-xs font-medium uppercase tracking-[0.18em]">
            @if ($imdb)
                <a href="{{ $imdb }}" target="_blank" rel="noreferrer" class="text-accent hover:underline">IMDb</a>
            @endif
            @if ($instagram)
                <a href="{{ $instagram }}" target="_blank" rel="noreferrer" class="text-accent hover:underline">Instagram</a>
            @endif
            @if ($linkedin)
                <a href="{{ $linkedin }}" target="_blank" rel="noreferrer" class="text-accent hover:underline">LinkedIn</a>
            @endif
        </div>
    @elseif ($imdb)
        <a href="{{ $imdb }}" target="_blank" rel="noreferrer" class="mt-5 inline-block text-xs font-medium uppercase tracking-[0.18em] text-accent hover:underline">IMDb</a>
    @endif
</article>
