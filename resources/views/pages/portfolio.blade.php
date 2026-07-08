@extends('layouts.site')

@section('title', 'Portfolio | 24 Frames')
@section('description', 'Selected films, commercials, and motion work from 24 Frames — Sri Lanka production company.')

@section('content')
@php
    use App\Support\AccentText;

    $portfolioCopy = config('frames.portfolio');
    $portfolioTagline = AccentText::highlight($portfolioCopy['headline'], ['Proven', 'Executed', 'Precision'], 'page-tagline-accent');
@endphp
<x-page-shell>
    <main class="portfolio-page">
        <x-page-tagline :tagline-html="$portfolioTagline" :sr-title="'Portfolio — '.$portfolioCopy['headline']" />

        <div class="portfolio-page-inner page-content mx-auto max-w-7xl px-4 pb-20 sm:px-6 lg:px-12 lg:pb-24">
            <x-portfolio-showcase
                :items="$portfolio"
                :intro="$portfolioCopy['intro']"
                :showreel-youtube-id="$portfolioCopy['showreel_youtube_id'] ?? config('frames.hero.youtube_id')"
            />
        </div>
    </main>
</x-page-shell>
@endsection
