<x-filament-panels::layout.base :livewire="$livewire">
    <div class="frames-auth-shell">
        <div class="frames-auth-grain" aria-hidden="true"></div>
        <div class="frames-auth-grid" aria-hidden="true"></div>

        <div class="frames-auth-shape frames-auth-shape--one" aria-hidden="true"></div>
        <div class="frames-auth-shape frames-auth-shape--two" aria-hidden="true"></div>

        <header class="frames-auth-top">
            <a href="{{ route('home') }}" class="frames-auth-back">
                <span aria-hidden="true">←</span>
                Back to site
            </a>
        </header>

        <div class="frames-auth-main">
            <main class="frames-auth-panel">
                {{ $slot }}
            </main>
        </div>

        <footer class="frames-auth-footer">
            <span>24 Frames</span>
            <span class="frames-auth-footer-dot" aria-hidden="true"></span>
            <span>Art house for film</span>
        </footer>
    </div>

    @push('styles')
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&family=Syne:wght@600;700;800&display=swap" rel="stylesheet">
        @vite('resources/css/filament-auth.css')
    @endpush
</x-filament-panels::layout.base>
