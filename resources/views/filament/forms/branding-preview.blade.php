@php
    $path = \App\Models\SiteSetting::get($key, config("frames.{$key}"));
    $url = \App\Support\Frames::mediaUrl($path);
@endphp

@if ($url)
    <div @class([
        'frames-branding-preview',
        'frames-branding-preview--favicon' => ($variant ?? 'logo') === 'favicon',
    ])>
        <img
            src="{{ $url }}"
            alt="{{ $label ?? 'Preview' }}"
            class="frames-branding-preview-image"
        >
    </div>
@else
    <p class="frames-branding-preview-empty">No image uploaded yet.</p>
@endif
