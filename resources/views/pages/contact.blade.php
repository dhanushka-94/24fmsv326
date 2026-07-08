@extends('layouts.site')

@section('title', 'Contact | 24 Frames')
@section('description', 'Get in touch with 24 Frames for production enquiries and collaborations in Sri Lanka.')

@section('content')
@php
    use App\Support\AccentText;

    $contactCopy = config('frames.contact');
    $contactTagline = AccentText::highlight($contactCopy['headline'], ['Vision', 'handle'], 'page-tagline-accent');
@endphp
<x-page-shell anchored>
    <main class="contact-page page-anchored-layout">
        <x-page-tagline
            :tagline-html="$contactTagline"
            :description="$contactCopy['pitch']"
            :sr-title="'Contact — '.$contactCopy['headline']"
        />

        <div class="contact-page-inner page-anchored-main mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-12">
            <section class="contact-layout">
                <form action="{{ route('contact.store') }}" method="POST" class="contact-form reveal">
                    @csrf
                    <div class="contact-form-fields space-y-5">
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div class="space-y-2">
                                <label class="contact-field-label" for="contact-name">Name</label>
                                <input id="contact-name" type="text" name="name" value="{{ old('name') }}" required class="field-input" placeholder="Your name" />
                                @error('name')<p class="text-sm text-accent-strong">{{ $message }}</p>@enderror
                            </div>
                            <div class="space-y-2">
                                <label class="contact-field-label" for="contact-email">Email</label>
                                <input id="contact-email" type="email" name="email" value="{{ old('email') }}" required class="field-input" placeholder="you@example.com" />
                                @error('email')<p class="text-sm text-accent-strong">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="contact-field-label" for="contact-message">Project details</label>
                            <textarea id="contact-message" name="message" rows="6" required class="field-input min-h-[10rem] py-3 text-base" placeholder="Tell us about your production, timelines, and locations.">{{ old('message') }}</textarea>
                            @error('message')<p class="text-sm text-accent-strong">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="contact-form-actions">
                        <button type="submit" class="btn btn-lg btn-primary contact-submit-btn">
                            <i data-lucide="send" class="size-4"></i>Send Message
                        </button>
                        @if (session('status'))
                            <p class="contact-form-status">{{ session('status') }}</p>
                        @endif
                    </div>

                    <x-contact-credits />
                </form>

                <aside class="contact-aside reveal">
                    <x-contact-sidebar :contact="$contact" :show-social="true" />
                </aside>
            </section>
        </div>
    </main>
</x-page-shell>
@endsection
