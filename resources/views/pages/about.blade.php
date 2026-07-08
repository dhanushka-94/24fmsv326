@extends('layouts.site')

@section('title', 'About Us | 24 Frames')
@section('description', 'Learn about 24 Frames — Sri Lanka’s motion picture production house since 2008.')

@section('content')
@php
    use App\Support\AccentText;

    $aboutHeadline = $aboutCopy['headline'] ?? 'Stories need precision. We deliver.';
    $aboutTagline = AccentText::highlight($aboutHeadline, ['precision', 'deliver'], 'page-tagline-accent');
    $aboutBodyLines = preg_split('/\r\n|\r|\n/', $aboutCopy['body'] ?? '');
    $aboutLogo = $aboutCopy['logo'] ?? '/images/about-logo-24.png';
@endphp
<x-page-shell anchored>
    <div class="page-anchored-layout">
        <x-page-tagline :tagline-html="$aboutTagline" sr-title="About 24 Frames — {{ $aboutHeadline }}" />

        <main class="about-showcase page-anchored-main">
        <div class="about-showcase-inner reveal reveal-slow">
            <div class="about-showcase-brand" data-stagger>
                <p class="about-showcase-word" data-stagger-item>About</p>
                <img
                    src="{{ asset($aboutLogo) }}"
                    alt="24"
                    class="about-showcase-logo"
                    data-stagger-item
                    loading="eager"
                    decoding="async"
                />
            </div>

            <div class="about-showcase-copy" data-stagger>
                @foreach ($aboutBodyLines as $line)
                    @if (trim($line) !== '')
                        <p class="about-showcase-line" data-stagger-item>{{ trim($line) }}</p>
                    @endif
                @endforeach
            </div>
        </div>
        </main>
    </div>
</x-page-shell>
@endsection
