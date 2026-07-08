@extends('layouts.site')

@section('title', 'Services | 24 Frames')
@section('description', 'End-to-end motion picture production services in Sri Lanka — production, creative execution, and digital formats.')

@section('content')
@php
    use App\Support\AccentText;

    $services = config('frames.services');
    $servicesTagline = AccentText::highlight($services['headline'], ['Big', 'Small', 'Shoot-ready.'], 'page-tagline-accent');
@endphp
<x-page-shell>
    <x-page-tagline :tagline-html="$servicesTagline" :sr-title="'Services — '.$services['headline']" />

    <main class="services-page page-content mx-auto max-w-7xl space-y-20 px-4 pb-20 sm:px-6 lg:space-y-28 lg:px-12">
        <x-services-blocks
            :pillars="$services['pillars']"
            :roster="['title' => 'The Directorial Roster', 'body' => $services['roster_intro']]"
        />

        <x-services-director-grid
            :directors="$directors"
            :title="strtoupper($services['directors_title'])"
        />

        <x-services-pipeline
            :stages="$pipeline"
            :title="$services['pipeline_title']"
            :subtitle="$services['pipeline_subtitle']"
        />
    </main>
</x-page-shell>
@endsection
