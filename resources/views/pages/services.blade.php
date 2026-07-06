@extends('layouts.site')

@section('title', 'Services | 24 Frames')
@section('description', 'End-to-end motion picture production services in Sri Lanka — production, creative execution, and digital formats.')

@section('content')
@php
    use App\Support\AccentText;

    $services = config('frames.services');
    $serviceImages = $sampleImages['services'] ?? [];
    $servicesSubheading = AccentText::highlight($services['headline'], ['Big', 'Small', 'Shoot-ready.']);
@endphp
<x-page-shell>
    <x-page-hero
        title="Services"
        :subheading-html="$servicesSubheading"
    />

    <main class="mx-auto flex max-w-7xl flex-col gap-20 px-4 pb-20 pt-16 sm:px-6 lg:gap-28 lg:px-12 lg:pt-20">
        <section class="grid gap-8 lg:grid-cols-3">
            @foreach ($services['pillars'] as $pillar)
                <article class="reveal card-surface group overflow-hidden">
                    @if (!empty($serviceImages[$pillar['key']]))
                        <div class="overflow-hidden">
                            <img
                                src="{{ $serviceImages[$pillar['key']] }}"
                                alt="{{ $pillar['title'] }}"
                                class="h-48 w-full object-cover transition duration-700 group-hover:scale-105"
                                loading="lazy"
                            />
                        </div>
                    @endif
                    <div class="space-y-4 p-6 sm:p-8">
                        <h2 class="section-heading text-xl sm:text-2xl">{{ $pillar['title'] }}</h2>
                        <p class="text-body">{{ $pillar['body'] }}</p>
                    </div>
                </article>
            @endforeach
        </section>

        <section class="reveal space-y-6 border-y border-white/10 py-14">
            <h2 class="section-heading">The Directorial Roster</h2>
            <p class="max-w-3xl text-body">{{ $services['roster_intro'] }}</p>
        </section>

        <x-director-grid :directors="$directors" :title="$services['directors_title']" />

        <x-execution-pipeline
            :stages="$pipeline"
            :title="$services['pipeline_title']"
            :subtitle="$services['pipeline_subtitle']"
        />
    </main>
</x-page-shell>
@endsection
