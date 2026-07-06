@extends('layouts.site')

@section('title', 'Contact | 24 Frames')
@section('description', 'Get in touch with 24 Frames for production enquiries and collaborations in Sri Lanka.')

@section('content')
@php
    use App\Support\AccentText;

    $contactCopy = config('frames.contact');
    $contactSubheading = AccentText::highlight($contactCopy['headline'], ['vision', 'handle']);
@endphp
<x-page-shell>
    <x-page-hero
        title="Contact"
        :subheading-html="$contactSubheading"
    />

    <main class="contact-page mx-auto max-w-7xl px-4 pb-20 pt-12 sm:px-6 lg:px-12 lg:pt-16">
        <section class="contact-layout">
            <form action="{{ route('contact.store') }}" method="POST" class="contact-form reveal card-surface">
                @csrf
                <div class="contact-form-head">
                    <p class="section-label">Enquiry</p>
                    <h2 class="contact-form-title">Send a message</h2>
                </div>

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
                    <button type="submit" class="btn btn-lg btn-primary w-full font-semibold tracking-[0.18em] sm:w-auto">
                        <i data-lucide="send" class="size-4"></i>Send Message
                    </button>
                    @if (session('status'))
                        <p class="contact-form-status">{{ session('status') }}</p>
                    @endif
                </div>
            </form>

            <aside class="contact-aside reveal">
                <div class="contact-aside-head">
                    <p class="section-label">Reach us</p>
                    <h2 class="contact-aside-title">Studio details</h2>
                </div>
                <x-contact-sidebar :contact="$contact" />
            </aside>
        </section>
    </main>
</x-page-shell>
@endsection
