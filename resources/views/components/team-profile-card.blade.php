@props(['name', 'role', 'photo' => null])

<article class="team-profile">
    <div class="team-profile-photo">
        @if ($photo)
            <img
                src="{{ $photo }}"
                alt="{{ $name }}"
                class="team-profile-img"
                loading="lazy"
            />
        @else
            <div class="team-profile-placeholder" aria-hidden="true">
                <i data-lucide="user" class="size-16 text-white/25 sm:size-20"></i>
            </div>
        @endif
    </div>
    <p class="team-profile-name">{{ $name }}</p>
    <p class="team-profile-role">{{ $role }}</p>
</article>
