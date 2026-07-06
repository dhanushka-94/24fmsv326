@extends('layouts.site')

@section('title', 'About Us | 24 Frames')
@section('description', config('frames.about.intro', 'Learn about 24 Frames — Sri Lanka’s motion picture production house since 2008.'))

@section('content')
@php
    use App\Support\AccentText;

    $aboutSubheading = AccentText::highlight($aboutCopy['headline'] ?? 'Stories need precision. We deliver.', ['precision', 'deliver']);
@endphp
<x-page-shell>
    <x-page-hero
        title="About Us"
        :subheading-html="$aboutSubheading"
    />

    <main class="mx-auto max-w-7xl px-4 pb-20 pt-16 sm:px-6 lg:px-12 lg:pt-20">
        <div class="grid gap-12 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.1fr)] lg:gap-16">
            @if (!empty($sampleImages['about_banner']))
                <div class="reveal reveal-slow card-surface overflow-hidden lg:sticky lg:top-28 lg:self-start">
                    <img
                        src="{{ $sampleImages['about_banner'] }}"
                        alt="24 Frames production"
                        class="h-56 w-full object-cover sm:h-72 lg:h-full lg:min-h-[28rem]"
                        loading="lazy"
                    />
                </div>
            @endif

            <div class="reveal reveal-slow space-y-6" data-stagger>
                @foreach ($aboutCopy['paragraphs'] ?? [] as $paragraph)
                    <p class="text-body" data-stagger-item>{{ $paragraph }}</p>
                @endforeach
                @if (!empty($aboutCopy['closing']))
                    <p class="role-label pt-4" data-stagger-item>{{ $aboutCopy['closing'] }}</p>
                @endif
                <div class="flex flex-wrap gap-3 pt-4" data-stagger-item>
                    <a href="{{ route('services') }}" class="btn btn-lg btn-outline">Our Services</a>
                    <a href="{{ route('contact') }}" class="btn btn-lg btn-primary">Get in Touch</a>
                </div>
            </div>
        </div>
    </main>
</x-page-shell>
@endsection
