@php
    $navItems = [
        ['route' => 'about', 'label' => 'About Us'],
        ['route' => 'services', 'label' => 'Services'],
        ['route' => 'portfolio', 'label' => 'Portfolio'],
        ['route' => 'team', 'label' => 'Our Team'],
        ['route' => 'contact', 'label' => 'Contact'],
    ];
@endphp

<header
    class="site-header fixed inset-x-0 top-0 z-50 w-full"
    x-data="{
        menuOpen: false,
        scrolled: false,
        toggle() { this.menuOpen = !this.menuOpen },
        close() { this.menuOpen = false },
    }"
    x-init="
        const onScroll = () => { scrolled = window.scrollY > 20 };
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    "
    :class="{ 'site-header--scrolled': scrolled && !menuOpen }"
    x-effect="document.body.style.overflow = menuOpen ? 'hidden' : ''"
    @keydown.escape.window="close()"
>
    <div class="site-header-bar">
        <a href="{{ route('home') }}" class="group flex shrink-0 items-center justify-start">
            <x-site-logo size="sm" class="transition-opacity group-hover:opacity-90" />
        </a>

        <button
            type="button"
            class="site-header-toggle md:hidden"
            :aria-expanded="menuOpen"
            aria-controls="mobile-navigation"
            :aria-label="menuOpen ? 'Close menu' : 'Open menu'"
            @click="toggle()"
        >
            <i data-lucide="menu" class="size-5" x-show="!menuOpen"></i>
            <i data-lucide="x" class="size-5" x-show="menuOpen" x-cloak></i>
        </button>
    </div>

    <nav class="site-side-nav" aria-label="Main">
        @foreach ($navItems as $item)
            <a
                href="{{ route($item['route']) }}"
                class="nav-link {{ request()->routeIs($item['route']) ? 'nav-link-active' : '' }}"
            >
                <span class="nav-link-dot" aria-hidden="true"></span>
                <span class="nav-link-label">{{ $item['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <div x-show="menuOpen" x-cloak class="md:hidden">
        <button type="button" aria-hidden tabindex="-1" class="fixed inset-0 z-40 bg-[#080808]/97" @click="close()"></button>
        <div id="mobile-navigation" class="relative z-50 border-t border-[#f4f0ea]/10 bg-[#080808] px-6 py-10 sm:px-8">
            <nav class="flex flex-col gap-2" aria-label="Mobile">
                <a href="{{ route('home') }}" class="nav-link-mobile {{ request()->routeIs('home') ? 'nav-link-active' : '' }}" @click="close()">Home</a>
                @foreach ($navItems as $item)
                    <a href="{{ route($item['route']) }}" class="nav-link-mobile {{ request()->routeIs($item['route']) ? 'nav-link-active' : '' }}" @click="close()">
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>
        </div>
    </div>
</header>

<style>[x-cloak] { display: none !important; }</style>
