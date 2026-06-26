@props([
    'role',
    'name',
    'imdb' => null,
    'bio' => null,
    'photo' => null,
    'instagram' => null,
    'linkedin' => null,
])

<article class="card-surface group flex flex-col justify-between p-5 transition hover:border-[#ff4d3d]/40">
    <div class="space-y-3">
        @if ($photo)
            <div class="overflow-hidden border border-[#f4f0ea]/10">
                <img src="{{ $photo }}" alt="{{ $name }}" class="h-40 w-full object-cover grayscale transition duration-500 group-hover:scale-105 group-hover:grayscale-[0.3]" loading="lazy" />
            </div>
        @endif
        <p class="section-label">{{ $role }}</p>
        <p class="font-display text-lg font-bold uppercase tracking-wide text-[#f4f0ea]">{{ $name }}</p>
        @if ($bio)
            <p class="text-xs leading-relaxed text-muted">{{ $bio }}</p>
        @endif
    </div>
    @if ($imdb || $instagram || $linkedin)
        <div class="mt-4 flex flex-wrap gap-3 border-t border-[#f4f0ea]/10 pt-4 text-[10px] font-bold uppercase tracking-[0.2em]">
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
        <a href="{{ $imdb }}" target="_blank" rel="noreferrer" class="mt-4 inline-block text-[10px] font-bold uppercase tracking-[0.2em] text-accent hover:underline">IMDb</a>
    @endif
</article>
