@php
    $navItems = [
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
    <div class="flex w-full items-center justify-between gap-6 px-4 py-4 sm:px-8 sm:py-5 lg:px-12 xl:px-16">
        <a href="{{ route('home') }}" class="group flex shrink-0 items-center justify-start">
            <x-site-logo size="sm" class="transition-opacity group-hover:opacity-90" />
        </a>

        <div class="ml-auto flex items-center justify-end gap-4">
            <nav class="hidden items-center justify-end gap-6 md:flex lg:gap-10 xl:gap-12" aria-label="Main">
                @foreach ($navItems as $item)
                    <a
                        href="{{ route($item['route']) }}"
                        class="nav-link {{ request()->routeIs($item['route']) ? 'nav-link-active' : '' }}"
                    >
                        {{ $item['label'] }}
                    </a>
                @endforeach
            </nav>

            <button
                type="button"
                class="inline-flex items-center justify-center border-2 border-[#f4f0ea]/40 p-2 text-[#f4f0ea] md:hidden"
                :aria-expanded="menuOpen"
                aria-controls="mobile-navigation"
                :aria-label="menuOpen ? 'Close menu' : 'Open menu'"
                @click="toggle()"
            >
                <i data-lucide="menu" class="size-5" x-show="!menuOpen"></i>
                <i data-lucide="x" class="size-5" x-show="menuOpen" x-cloak></i>
            </button>
        </div>
    </div>

    <div x-show="menuOpen" x-cloak class="md:hidden">
        <button type="button" aria-hidden tabindex="-1" class="fixed inset-0 z-40 bg-[#080808]/97" @click="close()"></button>
        <div id="mobile-navigation" class="relative z-50 border-t-2 border-[#f4f0ea]/10 bg-[#080808] px-6 py-10 sm:px-8">
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
