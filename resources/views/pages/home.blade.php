@extends('layouts.site')

@section('content')
<x-page-shell>
    <x-hero-section />

    <main class="mx-auto flex max-w-7xl flex-col px-4 pb-20 sm:px-6 lg:px-12">
        <section class="about-section border-b border-[#f4f0ea]/10">
            <div class="about-grid">
                <div class="about-title-col reveal reveal-slow">
                    <span class="about-index" aria-hidden="true">01</span>
                    <h2 class="about-title">
                        <span>ABOUT</span>
                        <span class="about-title-num">24</span>
                    </h2>
                    <p class="section-label mt-8 hidden lg:block">Est. 2008</p>
                </div>

                <div class="reveal reveal-slow space-y-8 lg:col-start-2" data-stagger>
                    <p class="section-label lg:hidden">Est. 2008</p>
                    <p class="art-quote text-drift text-animate-loop" data-stagger-item data-animate-loop="true">{{ config('frames.home.quote') }}</p>
                    <p class="text-body" data-stagger-item>{{ config('frames.home.main_copy') }}</p>
                </div>

                <div class="reveal lg:col-start-2" data-stagger>
                    <div class="about-edge-panel" data-stagger-item>
                        <p class="section-label mb-5">The Operational Edge</p>
                        <p class="text-lead">{{ config('frames.home.operational_edge') }}</p>
                    </div>
                </div>
            </div>

            <div class="reveal mt-14 flex flex-wrap gap-3">
                <a href="{{ route('services') }}" class="btn btn-lg btn-outline">Services</a>
                <a href="{{ route('team') }}" class="btn btn-lg btn-outline">The Team</a>
            </div>
        </section>

        <x-client-marquee :brands="$brands" />
    </main>
</x-page-shell>
@endsection
