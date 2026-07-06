@props(['contact', 'showSocial' => false])

<div class="contact-info-stack">
    <article class="contact-info-item reveal">
        <span class="contact-info-icon" aria-hidden="true">
            <i data-lucide="map-pin" class="size-5"></i>
        </span>
        <div class="contact-info-body">
            <p class="contact-info-label">Address</p>
            <p class="contact-info-value">{{ $contact['address'] }}</p>
        </div>
    </article>

    <article class="contact-info-item reveal">
        <span class="contact-info-icon" aria-hidden="true">
            <i data-lucide="phone" class="size-5"></i>
        </span>
        <div class="contact-info-body">
            <p class="contact-info-label">Phone</p>
            <div class="contact-info-value space-y-1">
                @foreach ($contact['phones'] as $phone)
                    <a href="tel:{{ preg_replace('/\s+/', '', $phone) }}" class="contact-info-link">{{ $phone }}</a>
                @endforeach
            </div>
            @if (!empty($contact['whatsapp']))
                <a
                    href="https://wa.me/{{ preg_replace('/\D/', '', $contact['whatsapp']) }}"
                    target="_blank"
                    rel="noreferrer"
                    class="contact-info-link mt-2 inline-flex items-center gap-2"
                >
                    <i data-lucide="message-circle" class="size-4 text-[#ff4d3d]"></i>
                    WhatsApp {{ $contact['whatsapp'] }}
                </a>
            @endif
        </div>
    </article>

    <article class="contact-info-item reveal">
        <span class="contact-info-icon" aria-hidden="true">
            <i data-lucide="mail" class="size-5"></i>
        </span>
        <div class="contact-info-body">
            <p class="contact-info-label">Email</p>
            <a href="mailto:{{ $contact['email'] }}" class="contact-info-link contact-info-value">{{ $contact['email'] }}</a>
        </div>
    </article>

    @if ($showSocial && !empty($contact['social']))
        <article class="contact-info-item contact-info-item--social reveal">
            <span class="contact-info-icon" aria-hidden="true">
                <i data-lucide="share-2" class="size-5"></i>
            </span>
            <div class="contact-info-body">
                <p class="contact-info-label">Social</p>
                <x-social-icons :links="$contact['social']" variant="accent" size="lg" />
            </div>
        </article>
    @endif
</div>
