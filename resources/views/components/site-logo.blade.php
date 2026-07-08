@props([
    'size' => 'md',
    'animate' => false,
])

@php
    use App\Support\Frames;

    $sizes = [
        'sm' => 'h-8 sm:h-9',
        'md' => 'h-10 sm:h-11',
        'lg' => 'h-14 sm:h-16',
        'xl' => 'h-16 sm:h-20 md:h-24',
        'hero' => 'h-20 sm:h-28 md:h-36',
        'loader' => 'h-auto w-full',
    ];
    $widths = [
        'sm' => 'max-w-[10rem] sm:max-w-[11rem]',
        'md' => 'max-w-[12rem] sm:max-w-[13rem]',
        'lg' => 'max-w-[18rem] sm:max-w-[20rem]',
        'xl' => 'max-w-[22rem] sm:max-w-[26rem] md:max-w-[30rem]',
        'hero' => 'max-w-[28rem] sm:max-w-[36rem] md:max-w-[42rem]',
        'loader' => 'max-w-none w-full',
    ];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    $widthClass = $widths[$size] ?? $widths['md'];
    $logoUrl = Frames::brandingUrl('logo');
@endphp

<span {{ $attributes->merge(['class' => "site-logo-stack inline-block {$widthClass}"]) }}>
    <img
        src="{{ $logoUrl }}"
        alt="24 Frames — Art House For Film"
        class="site-logo {{ $sizeClass }} {{ $animate ? 'site-logo-animate' : '' }}"
        width="1024"
        height="207"
        loading="{{ in_array($size, ['xl', 'hero', 'loader']) ? 'eager' : 'lazy' }}"
        decoding="async"
    />
</span>
