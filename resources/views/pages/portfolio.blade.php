@extends('layouts.site')

@section('title', 'Portfolio | 24 Frames')
@section('description', 'Selected films, commercials, and motion work from 24 Frames — Sri Lanka production company.')

@section('content')
@php
    use App\Support\AccentText;

    $portfolioCopy = config('frames.portfolio');
    $portfolioSubheading = AccentText::highlight($portfolioCopy['headline'], ['Proven', 'Executed', 'precision']);
@endphp
<x-page-shell>
    <x-page-hero
        title="Portfolio"
        :subheading-html="$portfolioSubheading"
    />

    <main class="mx-auto max-w-7xl px-4 pb-20 pt-16 sm:px-6 lg:px-12 lg:pt-20">
        <x-portfolio-showcase :items="$portfolio" />
    </main>
</x-page-shell>
@endsection
