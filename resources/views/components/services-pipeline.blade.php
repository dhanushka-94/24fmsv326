@props(['stages' => [], 'title' => null, 'subtitle' => null])

@php
    use App\Support\AccentText;

    $pipelineTagline = $subtitle
        ? AccentText::highlight($subtitle, ['Production', 'Final cut'], 'page-tagline-accent')
        : null;

    $formatPipelineItem = static function (string $item): string {
        if (! str_starts_with($item, 'AI') || ! str_contains($item, ':')) {
            return e($item);
        }

        [$label, $body] = explode(':', $item, 2);

        return '<strong class="services-pipeline-item-label">'.e($label).':</strong>'.e($body);
    };
@endphp

<section {{ $attributes->merge(['class' => 'services-pipeline reveal space-y-10 lg:space-y-14']) }}>
    <div class="space-y-4">
        @if ($title)
            <h2 class="services-section-title">{{ $title }}</h2>
        @endif
        @if ($pipelineTagline)
            <p class="page-tagline">{!! $pipelineTagline !!}</p>
        @endif
    </div>

    <div class="services-pipeline-stages space-y-12 lg:space-y-16">
        @foreach ($stages as $stage)
            <article class="services-pipeline-stage">
                <h3 class="services-pipeline-phase">{{ strtoupper($stage['title']) }}</h3>
                <ul class="services-pipeline-list">
                    @foreach ($stage['items'] as $item)
                        <li>{!! $formatPipelineItem($item) !!}</li>
                    @endforeach
                </ul>
            </article>
        @endforeach
    </div>
</section>
