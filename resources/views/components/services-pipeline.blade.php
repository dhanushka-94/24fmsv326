@props(['stages' => [], 'title' => null, 'subtitle' => null])

<section {{ $attributes->merge(['class' => 'services-pipeline reveal space-y-10 lg:space-y-14']) }}>
    <div class="space-y-4">
        @if ($title)
            <h2 class="services-section-title">{{ $title }}</h2>
        @endif
        @if ($subtitle)
            <p class="services-pipeline-subtitle">
                Built for seamless <span class="services-script-accent">Production</span>, from concept to <span class="services-script-accent">Final cut.</span>
            </p>
        @endif
    </div>

    <div class="services-pipeline-stages space-y-12 lg:space-y-16">
        @foreach ($stages as $stage)
            <article class="services-pipeline-stage">
                <h3 class="services-pipeline-phase">{{ strtoupper($stage['title']) }}</h3>
                <ul class="services-pipeline-list">
                    @foreach ($stage['items'] as $item)
                        <li @class(['services-pipeline-item--highlight' => str_starts_with($item, 'AI')])>{{ $item }}</li>
                    @endforeach
                </ul>
            </article>
        @endforeach
    </div>
</section>
