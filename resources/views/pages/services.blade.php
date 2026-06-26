@extends('layouts.site')

@section('title', 'Services | 24 Frames')
@section('description', 'End-to-end motion picture production services in Sri Lanka — production, creative execution, and digital formats.')

@section('content')
@php
    $services = config('frames.services');
    $serviceImages = $sampleImages['services'] ?? [];
@endphp
<x-page-shell>
    <x-page-hero
        label="Services"
        index="02"
        :quote="$services['headline']"
        title="Full-Service<br>Production"
    />

    <main class="mx-auto flex max-w-7xl flex-col gap-16 px-4 pb-20 pt-16 sm:px-6 lg:gap-24 lg:px-12 lg:pt-20">
        <section class="grid gap-6 lg:grid-cols-3">
            @foreach ($services['pillars'] as $pillar)
                <article class="reveal card-surface group overflow-hidden">
                    @if (!empty($serviceImages[$pillar['key']]))
                        <div class="overflow-hidden">
                            <img
                                src="{{ $serviceImages[$pillar['key']] }}"
                                alt="{{ $pillar['title'] }}"
                                class="h-44 w-full object-cover transition duration-700 group-hover:scale-105"
                                loading="lazy"
                            />
                        </div>
                    @endif
                    <div class="space-y-3 p-6">
                        <h2 class="text-sm font-semibold uppercase tracking-[0.18em] text-white">{{ $pillar['title'] }}</h2>
                        <p class="text-sm leading-relaxed text-body">{{ $pillar['body'] }}</p>
                    </div>
                </article>
            @endforeach
        </section>

        <section class="reveal space-y-4 border-y border-white/10 py-12">
            <p class="section-label">The Directorial Roster</p>
            <p class="max-w-3xl text-sm leading-relaxed text-body sm:text-base">{{ $services['roster_intro'] }}</p>
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
