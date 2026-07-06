@props(['stages' => [], 'title' => null, 'subtitle' => null])

<section class="pipeline-flow space-y-12 lg:space-y-14" x-data="{ active: 0 }">
    <div class="reveal space-y-4">
        @if ($title)
            <h2 class="section-heading" data-animate-text>{{ $title }}</h2>
        @endif
        @if ($subtitle)
            <p class="text-lead max-w-3xl">{{ $subtitle }}</p>
        @endif
    </div>

    {{-- Desktop: horizontal timeline --}}
    <div class="hidden lg:block">
        <div class="reveal pipeline-timeline" aria-hidden="true">
            @foreach ($stages as $index => $stage)
                <div class="pipeline-timeline-node {{ $index < count($stages) - 1 ? 'pipeline-timeline-node--connected' : '' }}">
                    <span class="pipeline-timeline-badge">{{ $stage['stage'] }}</span>
                    <span class="pipeline-timeline-label">{{ $stage['title'] }}</span>
                </div>
            @endforeach
        </div>

        <div class="pipeline-flow-grid reveal mt-10">
            @foreach ($stages as $stage)
                <article class="pipeline-flow-card">
                    <x-pipeline-stage-card :stage="$stage" variant="flow" />
                </article>
            @endforeach
        </div>
    </div>

    {{-- Mobile & tablet: accordion --}}
    <div class="space-y-3 lg:hidden">
        @foreach ($stages as $index => $stage)
            <article class="reveal pipeline-accordion" :class="{ 'pipeline-accordion-open': active === {{ $index }} }">
                <button
                    type="button"
                    class="pipeline-accordion-trigger"
                    :aria-expanded="active === {{ $index }}"
                    @click="active = active === {{ $index }} ? -1 : {{ $index }}"
                >
                    <span class="pipeline-accordion-badge">{{ $stage['stage'] }}</span>
                    <span class="pipeline-accordion-title">{{ $stage['title'] }}</span>
                    <i data-lucide="chevron-down" class="pipeline-accordion-icon size-5 shrink-0"></i>
                </button>
                <div
                    x-show="active === {{ $index }}"
                    x-cloak
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="pipeline-accordion-body"
                >
                    <x-pipeline-stage-card :stage="$stage" variant="compact" />
                </div>
            </article>
        @endforeach
    </div>
</section>
