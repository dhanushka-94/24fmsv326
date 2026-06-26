@props(['links' => []])

@if (count($links))
    <div class="flex flex-wrap gap-3">
        @foreach ($links as $link)
            <a
                href="{{ $link['url'] }}"
                target="_blank"
                rel="noreferrer"
                class="social-icon-btn"
                aria-label="{{ $link['label'] }}"
                title="{{ $link['label'] }}"
            >
                <i data-lucide="{{ $link['icon'] ?? 'link' }}" class="size-4"></i>
            </a>
        @endforeach
    </div>
@endif
