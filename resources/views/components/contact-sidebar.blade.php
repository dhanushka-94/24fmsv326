@props(['contact', 'showSocial' => false])

<div class="space-y-4">
    <div class="contact-detail-card">
        <p class="section-label mb-2">Address</p>
        <p class="text-lead">{{ $contact['address'] }}</p>
    </div>
    <div class="contact-detail-card">
        <p class="section-label mb-2">Phone</p>
        <div class="space-y-1 text-lead">
            @foreach ($contact['phones'] as $phone)
                <p>{{ $phone }}</p>
            @endforeach
        </div>
        @if (!empty($contact['whatsapp']))
            <p class="mt-3">
                <a href="https://wa.me/{{ preg_replace('/\D/', '', $contact['whatsapp']) }}" target="_blank" rel="noreferrer" class="text-accent hover:underline">
                    WhatsApp: {{ $contact['whatsapp'] }}
                </a>
            </p>
        @endif
    </div>
    <div class="contact-detail-card">
        <p class="section-label mb-2">Email</p>
        <a href="mailto:{{ $contact['email'] }}" class="text-lead text-accent underline-offset-4 hover:underline">{{ $contact['email'] }}</a>
    </div>
    @if ($showSocial && !empty($contact['social']))
        <div class="contact-detail-card">
            <p class="section-label mb-4">Social</p>
            <x-social-icons :links="$contact['social']" />
        </div>
    @endif
</div>
