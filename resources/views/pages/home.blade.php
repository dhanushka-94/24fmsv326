@extends('layouts.site')

@section('content')
<x-page-shell>
    <x-hero-section />

    <main class="mx-auto flex max-w-7xl flex-col px-4 pb-20 sm:px-6 lg:px-12">
        <section class="border-b border-[#f4f0ea]/10 py-16 lg:py-28">
            <div class="reveal mb-12 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <h2 class="hero-display text-5xl sm:text-7xl lg:text-8xl">{{ config('frames.home.about_headline') }}</h2>
                <p class="section-label sm:pb-2">Est. 2008</p>
            </div>

            <div class="grid gap-10 lg:grid-cols-12 lg:gap-8">
                <div class="reveal lg:col-span-7 lg:pr-8">
                    <p class="art-quote mb-8 text-xl sm:text-2xl">{{ config('frames.home.quote') }}</p>
                    <p class="text-sm leading-[1.8] text-body sm:text-base">{{ config('frames.home.main_copy') }}</p>
                </div>
                <div class="reveal lg:col-span-5">
                    <div class="art-frame h-full bg-[#111111]">
                        <p class="section-label mb-5">The Operational Edge</p>
                        <p class="text-sm leading-[1.8] text-body sm:text-base">{{ config('frames.home.operational_edge') }}</p>
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
