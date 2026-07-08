@props(['links' => [], 'variant' => 'default', 'size' => 'md'])

@if (count($links))
    @php
        $btnClass = match ($variant) {
            'accent' => 'social-icon-btn social-icon-btn--accent',
            'brand' => 'social-icon-btn social-icon-btn--brand',
            default => 'social-icon-btn',
        };
        $sizeClass = $size === 'lg' ? 'social-icon-btn--lg' : '';
        $iconClass = $size === 'lg' ? 'social-icon-svg social-icon-svg--lg' : 'social-icon-svg';
    @endphp
    <div class="social-icons-row {{ $size === 'lg' ? 'social-icons-row--lg' : '' }}">
        @foreach ($links as $link)
            <a
                href="{{ $link['url'] }}"
                target="_blank"
                rel="noreferrer"
                class="{{ trim("{$btnClass} {$sizeClass}") }}"
                @if ($variant === 'brand') data-social="{{ $link['icon'] ?? 'link' }}" @endif
                aria-label="{{ $link['label'] }}"
                title="{{ $link['label'] }}"
            >
                <x-social-icon :name="$link['icon'] ?? 'link'" :class="$iconClass" />
            </a>
        @endforeach
    </div>
@endif
