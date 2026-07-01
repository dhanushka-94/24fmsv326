@props(['stages' => [], 'title' => null, 'subtitle' => null])

<section class="pipeline-views space-y-10" x-data="{ active: 0 }">
    <div class="reveal space-y-4">
        @if ($title)
            <h2 class="section-heading">{{ $title }}</h2>
        @endif
        @if ($subtitle)
            <p class="text-lead max-w-3xl">{{ $subtitle }}</p>
        @endif
    </div>

    {{-- Mobile & tablet: stage tabs + single panel --}}
    <div class="lg:hidden">
        <div class="reveal pipeline-tabs" role="tablist" aria-label="Production stages">
            @foreach ($stages as $index => $stage)
                <button
                    type="button"
                    role="tab"
                    class="pipeline-tab"
                    :class="{ 'pipeline-tab-active': active === {{ $index }} }"
                    :aria-selected="active === {{ $index }}"
                    @click="active = {{ $index }}"
                >
                    <span class="pipeline-tab-num">{{ $stage['stage'] }}</span>
                    <span class="pipeline-tab-title">{{ $stage['title'] }}</span>
                </button>
            @endforeach
        </div>

        <div class="reveal mt-4">
            @foreach ($stages as $index => $stage)
                <article
                    x-show="active === {{ $index }}"
                    x-cloak
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-3"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="pipeline-panel"
                    role="tabpanel"
                >
                    <x-pipeline-stage-card :stage="$stage" />
                </article>
            @endforeach
        </div>
    </div>

    {{-- Desktop: three panels side by side --}}
    <div class="pipeline-three-grid reveal hidden lg:grid">
        @foreach ($stages as $index => $stage)
            <article class="pipeline-panel pipeline-panel-{{ $index + 1 }}">
                <x-pipeline-stage-card :stage="$stage" />
            </article>
        @endforeach
    </div>
</section>
