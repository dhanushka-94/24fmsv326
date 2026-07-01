@props(['label' => null, 'title', 'quote' => null, 'description' => null, 'compact' => false, 'index' => null])

<section {{ $attributes->merge(['class' => 'page-hero relative overflow-hidden border-b border-[#f4f0ea]/10']) }}>
  <div class="absolute inset-0 ken-burns-bg opacity-30" style="background-image: url('{{ asset(config('frames.hero_background')) }}');" aria-hidden="true"></div>
  <div class="absolute inset-0 bg-[#080808]/90" aria-hidden="true"></div>
  @if ($index)
    <p class="page-hero-index absolute top-8 right-4 sm:right-8 lg:right-12" aria-hidden="true">{{ $index }}</p>
  @endif
  <div class="relative z-10 mx-auto max-w-7xl px-4 py-14 sm:px-6 sm:py-16 lg:px-12 {{ $compact ? 'lg:py-16' : 'lg:py-20' }}">
    <div class="reveal max-w-3xl space-y-4" data-stagger>
      @if ($label)
        <p class="section-label" data-stagger-item>{{ $label }}</p>
      @endif
      @if ($quote)
        <p class="page-hero-quote text-drift text-animate-loop" data-stagger-item data-animate-loop="true">{{ $quote }}</p>
      @endif
      <h1 class="page-hero-title" data-stagger-item data-animate-text>{!! $title !!}</h1>
      @if ($description)
        <p class="page-hero-desc reveal-fade" data-stagger-item>{{ $description }}</p>
      @endif
      {{ $slot }}
    </div>
  </div>
</section>
