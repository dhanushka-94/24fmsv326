<footer class="relative border-t-2 border-[#f4f0ea]/10">
    <div class="relative z-10 mx-auto flex max-w-7xl flex-col gap-8 px-6 py-12 sm:flex-row sm:items-end sm:justify-between sm:px-8 lg:px-12">
        <div class="space-y-5">
            <a href="{{ route('home') }}" class="inline-flex transition-opacity hover:opacity-80">
                <x-site-logo size="md" />
            </a>
            <p class="section-label !tracking-[0.35em] text-[#f4f0ea]/40">
                &copy; {{ date('Y') }} 24 Frames
            </p>
        </div>
        <p class="max-w-xs text-xs leading-relaxed text-muted">
            Art house for films.
            <span class="mt-2 block text-[#f4f0ea]/50">
                Developed by <a href="#" class="underline decoration-[#ff4d3d] underline-offset-4 hover:text-[#f4f0ea]">Olexto Digital Solutions</a>
            </span>
        </p>
    </div>
</footer>
