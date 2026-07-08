@extends('layouts.site')

@section('title', 'Our Team | 24 Frames')
@section('description', 'Meet the 24 Frames core team — direction, production, and post-production specialists in Sri Lanka.')

@section('content')
@php
    use App\Support\AccentText;

    $teamCopy = config('frames.team');
    $teamHeadline = $teamCopy['subtitle'] ?? 'Built by the best. Driven by Precision.';
    $teamTagline = AccentText::highlight($teamHeadline, ['best', 'Precision'], 'page-tagline-accent');
    $departments = $teamCopy['departments'];
    $departmentLayouts = [
        'direction' => 'team-grid--single',
        'production' => 'team-grid--triple',
        'post' => 'team-grid--duo',
    ];
@endphp
<x-page-shell>
    <x-page-tagline :tagline-html="$teamTagline" :sr-title="'Our Team — '.$teamHeadline" />

    <main class="team-page page-content mx-auto max-w-7xl space-y-16 px-4 pb-20 sm:px-6 lg:space-y-24 lg:px-12">
        @foreach ($departments as $key => $label)
            @php $members = $teamByDepartment[$key] ?? collect(); @endphp
            @if ($members->isNotEmpty())
                <section class="team-department reveal">
                    <h2 class="team-department-title">{{ strtoupper($label) }}</h2>
                    <div class="team-grid {{ $departmentLayouts[$key] ?? 'team-grid--triple' }}">
                        @foreach ($members as $member)
                            <x-team-profile-card
                                :name="$member->name"
                                :role="$member->role"
                                :photo="$member->photoUrl()"
                            />
                        @endforeach
                    </div>
                </section>
            @endif
        @endforeach

        @if ($teamMembers->isEmpty())
            <p class="text-body">No team members available yet.</p>
        @endif
    </main>
</x-page-shell>
@endsection
