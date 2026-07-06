@php
    $socialLinks = config('frames.contact.social', []);
@endphp

<footer class="site-footer reveal reveal-slow">
    <div class="site-footer-inner">
        <div class="site-footer-start">
            <a href="{{ route('home') }}" class="site-footer-logo" aria-label="24 Frames home">
                <x-site-logo size="sm" :animate="false" />
            </a>
            <p class="site-footer-copy">&copy; {{ date('Y') }} 24 Frames</p>
        </div>

        <div class="site-footer-end">
            @if (!empty($socialLinks))
                <x-social-icons :links="$socialLinks" variant="accent" />
            @endif

            <p class="site-footer-credit">
                Developed by
                <a href="#" class="site-footer-credit-link">Olexto Digital Solutions</a>
            </p>
        </div>
    </div>
</footer>
