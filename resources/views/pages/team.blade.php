@extends('layouts.site')

@section('title', 'Our Team | 24 Frames')
@section('description', 'Meet the 24 Frames core team — direction, production, and post-production specialists in Sri Lanka.')

@section('content')
@php
    use App\Support\AccentText;

    $teamCopy = config('frames.team');
    $teamHeadline = $teamCopy['subtitle'] ?? 'Built by the best. Driven by Precision.';
    $teamTagline = AccentText::highlight($teamHeadline, ['best', 'Precision'], 'page-tagline-accent');
    $departmentLabels = $departmentLabels ?? config('frames.team.departments', []);
    $departmentLayouts = [
        'direction' => 'team-grid--single',
        'production' => 'team-grid--triple',
        'post' => 'team-grid--duo',
    ];
@endphp
<x-page-shell>
    <x-page-tagline :tagline-html="$teamTagline" :sr-title="'Our Team — '.$teamHeadline" />

    <main class="team-page page-content mx-auto max-w-7xl space-y-16 px-4 pb-20 sm:px-6 lg:space-y-24 lg:px-12">
        @forelse ($teamByDepartment as $departmentKey => $members)
            @php
                $sectionLabel = $departmentLabels[$departmentKey] ?? $departmentKey;
                $layoutKey = array_key_exists($departmentKey, $departmentLayouts) ? $departmentKey : 'production';
            @endphp
            @if ($members->isNotEmpty())
                <section class="team-department reveal">
                    <h2 class="team-department-title">{{ strtoupper($sectionLabel) }}</h2>
                    <div class="team-grid {{ $departmentLayouts[$layoutKey] ?? 'team-grid--triple' }}">
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
        @empty
            <p class="text-body">No team members available yet.</p>
        @endforelse
    </main>
</x-page-shell>
@endsection
