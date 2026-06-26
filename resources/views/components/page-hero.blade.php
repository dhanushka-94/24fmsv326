@props(['label' => null, 'title', 'quote' => null, 'description' => null, 'compact' => false, 'index' => null])

<section {{ $attributes->merge(['class' => 'page-hero relative overflow-hidden border-b border-[#f4f0ea]/10']) }}>
  <div class="absolute inset-0 ken-burns-bg opacity-30" style="background-image: url('{{ asset(config('frames.hero_background')) }}');" aria-hidden="true"></div>
  <div class="absolute inset-0 bg-[#080808]/88" aria-hidden="true"></div>
  @if ($index)
    <p class="page-hero-index absolute top-8 right-4 sm:right-8 lg:right-12" aria-hidden="true">{{ $index }}</p>
  @endif
  <div class="relative z-10 mx-auto max-w-7xl px-4 py-24 sm:px-6 sm:py-28 lg:px-12 {{ $compact ? 'lg:py-24' : 'lg:py-32' }}">
    <div class="reveal max-w-4xl space-y-6">
      @if ($label)
        <p class="section-label">{{ $label }}</p>
      @endif
      @if ($quote)
        <p class="art-quote">{{ $quote }}</p>
      @endif
      <h1 class="hero-display text-4xl sm:text-6xl lg:text-7xl">{!! $title !!}</h1>
      @if ($description)
        <p class="max-w-2xl border-l-2 border-[#ff4d3d] pl-5 text-sm leading-relaxed text-body sm:text-base">{{ $description }}</p>
      @endif
      {{ $slot }}
    </div>
  </div>
</section>
