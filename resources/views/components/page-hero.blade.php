@props(['label' => null, 'title', 'subheading' => null, 'subheadingHtml' => null, 'description' => null, 'compact' => false])

<section {{ $attributes->merge(['class' => 'page-hero relative overflow-hidden border-b border-[#f4f0ea]/10']) }}>
  <div class="absolute inset-0 ken-burns-bg opacity-25" style="background-image: url('{{ asset(config('frames.hero_background')) }}');" aria-hidden="true"></div>
  <div class="absolute inset-0 bg-[#080808]/92" aria-hidden="true"></div>

  <div class="relative z-10 mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-18 lg:px-12 {{ $compact ? 'lg:py-16' : 'lg:py-22' }}">
    <div class="reveal reveal-slow max-w-4xl space-y-5" data-stagger>
      @if ($label)
        <p class="page-hero-label" data-stagger-item data-animate-text>{{ $label }}</p>
      @endif
      <h1 class="page-hero-title" data-stagger-item data-animate-text>{{ $title }}</h1>
      @if ($subheadingHtml)
        <p class="page-hero-subheading hero-tagline text-drift text-animate-loop" data-stagger-item data-animate-loop="true">{!! $subheadingHtml !!}</p>
      @elseif ($subheading)
        <p class="page-hero-subheading text-animate-loop" data-stagger-item data-animate-loop="true">{{ $subheading }}</p>
      @endif
      @if ($description)
        <p class="page-hero-desc" data-stagger-item>{{ $description }}</p>
      @endif
      {{ $slot }}
    </div>
  </div>
</section>
