@extends('layouts.site')

@section('title', 'About | 24 Frames')
@section('description', 'Learn about 24 Frames — Sri Lanka’s motion picture production house since 2004.')

@section('content')
<x-page-shell>
    <main class="mx-auto flex max-w-4xl flex-col gap-8 px-6 pb-20 pt-28 sm:px-8 lg:px-12">
        <header class="space-y-3">
            <p class="section-label">About 24Frames</p>
            <h1 class="hero-display text-4xl sm:text-5xl">Stories need precision.<br><span class="text-accent-strong">We deliver.</span></h1>
            <p class="max-w-2xl text-sm text-muted sm:text-base">
                Sri Lanka’s premier motion pictures production house — built to take productions from concept to final cut with clarity, control, and craft.
            </p>
        </header>

        @if (!empty($sampleImages['about_banner']))
            <div class="card-surface overflow-hidden">
                <img src="{{ $sampleImages['about_banner'] }}" alt="24 Frames production studio" class="h-48 w-full object-cover sm:h-64" loading="lazy" />
            </div>
        @endif

        <section class="space-y-4 text-sm leading-relaxed text-body sm:text-base">
            <p>Founded in 2004, 24 Frames is a full-service motion picture production company based in Sri Lanka. We specialize in delivering high-quality commercials, films, documentaries, television, and digital content from concept to final cut.</p>
            <p>With a strong blend of global experience and local insight, we are built for seamless production across all scales. What sets us apart is clarity under pressure. We manage complex productions with confidence, ensuring smooth execution at every stage.</p>
            <p>Backed by a trusted network of global partners and acclaimed directors, we assemble teams tailored to each project — creatively and technically. Smart budgets. Top talent. No compromises.</p>
            <p class="pt-2 text-sm font-medium uppercase tracking-[0.22em] text-muted">Let’s make something unforgettable.</p>
        </section>
    </main>
</x-page-shell>
@endsection
