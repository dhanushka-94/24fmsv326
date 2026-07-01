@extends('layouts.site')

@section('title', 'Contact | 24 Frames')
@section('description', 'Get in touch with 24 Frames for production enquiries and collaborations in Sri Lanka.')

@section('content')
@php $contactCopy = config('frames.contact'); @endphp
<x-page-shell>
    <x-page-hero
        label="Contact"
        index="05"
        :quote="$contactCopy['headline']"
        title="Let's Build<br>Something"
        :description="$contactCopy['pitch']"
    />

    <main class="mx-auto max-w-7xl px-4 pb-20 pt-16 sm:px-6 lg:px-12 lg:pt-20">
        <section class="grid gap-12 lg:grid-cols-[minmax(0,1.15fr)_minmax(0,1fr)] lg:gap-16">
            <form action="{{ route('contact.store') }}" method="POST" class="reveal card-surface space-y-5 p-6 sm:p-9">
                @csrf
                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="space-y-2">
                        <label class="section-label !tracking-[0.22em]">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="field-input" placeholder="Your name" />
                        @error('name')<p class="text-sm text-accent-strong">{{ $message }}</p>@enderror
                    </div>
                    <div class="space-y-2">
                        <label class="section-label !tracking-[0.22em]">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="field-input" placeholder="you@example.com" />
                        @error('email')<p class="text-sm text-accent-strong">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="section-label !tracking-[0.22em]">Project details</label>
                    <textarea name="message" rows="5" required class="field-input min-h-[9rem] py-3 text-base" placeholder="Tell us about your production, timelines, and locations.">{{ old('message') }}</textarea>
                    @error('message')<p class="text-sm text-accent-strong">{{ $message }}</p>@enderror
                </div>
                <button type="submit" class="btn btn-lg btn-primary mt-2 w-full font-semibold tracking-[0.18em] sm:w-auto">
                    <i data-lucide="send" class="size-4"></i>Send Message
                </button>
                @if (session('status'))
                    <p class="text-sm text-accent">{{ session('status') }}</p>
                @endif
            </form>

            <div class="reveal grid gap-4 sm:grid-cols-2 lg:grid-cols-1">
                <x-contact-sidebar :contact="$contact" :show-social="true" />
            </div>
        </section>
    </main>
</x-page-shell>
@endsection
