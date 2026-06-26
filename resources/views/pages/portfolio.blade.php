@extends('layouts.site')

@section('title', 'Portfolio | 24 Frames')
@section('description', 'Selected films, commercials, and motion work from 24 Frames — Sri Lanka production company.')

@section('content')
@php $portfolioCopy = config('frames.portfolio'); @endphp
<x-page-shell>
    <x-page-hero
        label="Portfolio"
        index="03"
        :quote="$portfolioCopy['headline']"
        title="Work That<br>Travels"
        :description="$portfolioCopy['intro']"
    />

    <main class="mx-auto max-w-7xl px-4 pb-20 pt-16 sm:px-6 lg:px-12 lg:pt-20">
        <x-portfolio-showcase :items="$portfolio" />
        <x-client-marquee :brands="$brands" class="mt-20" />
    </main>
</x-page-shell>
@endsection
