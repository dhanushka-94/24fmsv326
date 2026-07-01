@extends('layouts.site')

@section('title', 'Our Team | 24 Frames')
@section('description', 'Meet the 24 Frames core team — direction, production, and post-production specialists in Sri Lanka.')

@section('content')
@php
    $teamCopy = config('frames.team');
    $departments = $teamCopy['departments'];
@endphp
<x-page-shell>
    <x-page-hero
        label="Our Team"
        index="04"
        :title="'The Core<br>Team'"
        :description="$teamCopy['subtitle']"
    />

    <main class="mx-auto flex max-w-7xl flex-col gap-20 px-4 pb-20 pt-16 sm:px-6 lg:gap-24 lg:px-12 lg:pt-20">
        @foreach ($departments as $key => $label)
            @php $members = $teamByDepartment[$key] ?? collect(); @endphp
            @if ($members->isNotEmpty())
                <section class="space-y-10">
                    <h2 class="reveal section-heading">{{ $label }}</h2>
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($members as $member)
                            <x-team-card
                                :role="$member->role"
                                :name="$member->name"
                                :imdb="$member->imdb"
                                :bio="$member->bio"
                                :photo="$member->photoUrl()"
                                :instagram="$member->instagram"
                                :linkedin="$member->linkedin"
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
