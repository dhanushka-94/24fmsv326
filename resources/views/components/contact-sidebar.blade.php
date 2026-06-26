@props(['contact', 'showSocial' => false])

<div class="card-surface space-y-5 p-6 text-sm text-body sm:p-8">
    <div>
        <p class="section-label mb-1">Address</p>
        <p>{{ $contact['address'] }}</p>
    </div>
    <div>
        <p class="section-label mb-1">Phone</p>
        @foreach ($contact['phones'] as $phone)
            <p>{{ $phone }}</p>
        @endforeach
        @if (!empty($contact['whatsapp']))
            <p class="mt-2">
                <a href="https://wa.me/{{ preg_replace('/\D/', '', $contact['whatsapp']) }}" target="_blank" rel="noreferrer" class="text-accent hover:underline">
                    WhatsApp: {{ $contact['whatsapp'] }}
                </a>
            </p>
        @endif
    </div>
    <div>
        <p class="section-label mb-1">Email</p>
        <a href="mailto:{{ $contact['email'] }}" class="text-accent underline-offset-4 hover:underline">{{ $contact['email'] }}</a>
    </div>
    @if ($showSocial && !empty($contact['social']))
        <div>
            <p class="section-label mb-3">Social</p>
            <x-social-icons :links="$contact['social']" />
        </div>
    @endif
</div>
