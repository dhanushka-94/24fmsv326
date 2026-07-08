@props(['directors' => [], 'title' => null])

@php
    $rowOne = collect($directors)->take(5)->all();
    $rowTwo = collect($directors)->slice(5)->values()->all();
@endphp

<section {{ $attributes->merge(['class' => 'services-directors reveal space-y-10']) }}>
    @if ($title)
        <h2 class="services-section-title">{{ $title }}</h2>
    @endif

    <div class="services-directors-rows space-y-6 lg:space-y-8">
        <div class="services-directors-row services-directors-row--five">
            @foreach ($rowOne as $director)
                <article class="director-card group">
                    <div class="director-photo aspect-[3/4] overflow-hidden border border-[#f4f0ea]/10 bg-[#111111]">
                        @if (!empty($director['photo']))
                            <img
                                src="{{ $director['photo'] }}"
                                alt="{{ $director['name'] }}"
                                class="h-full w-full object-cover grayscale transition duration-700 group-hover:scale-105"
                                loading="lazy"
                            />
                        @endif
                    </div>
                    <p class="director-name">{{ $director['name'] }}</p>
                </article>
            @endforeach
        </div>

        @if (count($rowTwo))
            <div class="services-directors-row services-directors-row--four">
                @foreach ($rowTwo as $director)
                    <article class="director-card group">
                        <div class="director-photo aspect-[3/4] overflow-hidden border border-[#f4f0ea]/10 bg-[#111111]">
                            @if (!empty($director['photo']))
                                <img
                                    src="{{ $director['photo'] }}"
                                    alt="{{ $director['name'] }}"
                                    class="h-full w-full object-cover grayscale transition duration-700 group-hover:scale-105"
                                    loading="lazy"
                                />
                            @endif
                        </div>
                        <p class="director-name">{{ $director['name'] }}</p>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>
