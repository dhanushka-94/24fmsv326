@extends('layouts.site')

@section('title', 'About Us | 24 Frames')
@section('description', 'Learn about 24 Frames — Sri Lanka’s motion picture production house since 2008.')

@section('content')
<x-page-shell>
    <main class="about-page">
        <section class="about-page-body reveal reveal-slow">
            <h1 class="about-page-title">
                <span class="about-page-about">ABOUT</span>
                <span class="about-page-num" aria-hidden="true">
                    <span class="about-page-two">2</span><span class="about-page-four">4</span>
                </span>
            </h1>

            <div class="about-page-copy">
                @foreach ($aboutCopy['body_lines'] ?? [] as $line)
                    <p>{{ $line }}</p>
                @endforeach
            </div>
        </section>
    </main>
</x-page-shell>
@endsection
