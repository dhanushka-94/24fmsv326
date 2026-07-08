@props(['contact', 'showSocial' => false])

@php
    $phones = $contact['phones'] ?? [];
    $phoneLine = collect($phones)
        ->map(fn (string $phone): string => '<a href="tel:'.preg_replace('/\s+/', '', $phone).'" class="contact-info-link">'.$phone.'</a>')
        ->implode(' <span class="contact-info-separator">/</span> ');
@endphp

<div class="contact-info-stack">
    <section class="contact-info-block reveal">
        <h2 class="contact-info-heading">Get in touch</h2>
        @if ($phoneLine !== '')
            <p class="contact-info-line">{!! $phoneLine !!}</p>
        @endif
        <p class="contact-info-line">
            <a href="mailto:{{ $contact['email'] }}" class="contact-info-link">{{ $contact['email'] }}</a>
        </p>
    </section>

    <section class="contact-info-block reveal">
        <h2 class="contact-info-heading">Office</h2>
        <p class="contact-info-line contact-info-address">
            @if (! empty($contact['company']))
                <span>{{ $contact['company'] }}</span>
            @endif
            <span>{{ $contact['address'] }}</span>
        </p>
    </section>

    @if ($showSocial && ! empty($contact['social']))
        <div class="contact-social reveal">
            <x-social-icons :links="$contact['social']" variant="brand" size="lg" />
        </div>
    @endif
</div>
