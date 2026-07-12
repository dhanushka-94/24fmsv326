@props(['clients' => []])

@if ($clients->count())
    <aside
        {{ $attributes->merge(['class' => 'client-carousel-fixed']) }}
        aria-label="Our clients"
        x-data="clientCarousel()"
    >
        <div class="client-carousel-viewport" x-ref="viewport">
            <div class="client-carousel-track" x-ref="track">
                @foreach ([1, 2] as $loopPass)
                    @foreach ($clients as $client)
                        <div class="client-carousel-item">
                            @if ($client->logoUrl())
                                <img
                                    src="{{ $client->logoUrl() }}"
                                    alt="{{ $loopPass === 1 ? $client->name : '' }}"
                                    class="client-carousel-logo"
                                    loading="lazy"
                                    decoding="async"
                                />
                            @else
                                <span class="client-carousel-name">{{ $client->name }}</span>
                            @endif
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </aside>
@endif
