@props([
    'src' => null,
    'alt' => '',
    'aspect' => 'auto', // 'auto' | 'square' | 'video' | '4/3' | '16/9'
    'fit' => 'cover', // 'cover' | 'contain' | 'fill'
    'rounded' => 'lg', // 'none' | 'sm' | 'md' | 'lg' | 'xl' | '2xl' | 'full'
    'zoom' => false,
    'caption' => null,
])

@php
    $aspectClass = match ($aspect) {
        'square', '1/1' => 'aspect-square',
        'video', '16/9' => 'aspect-video',
        '4/3' => 'aspect-4/3',
        '3/4' => 'aspect-3/4',
        default => '',
    };

    $fitClass = match ($fit) {
        'contain' => 'object-contain',
        'fill' => 'object-fill',
        'cover' => 'object-cover',
        default => 'object-cover',
    };

    $roundedClass = match ($rounded) {
        'none' => 'rounded-none',
        'sm' => 'rounded-sm',
        'md' => 'rounded-md',
        'lg' => 'rounded-lg',
        'xl' => 'rounded-xl',
        '2xl' => 'rounded-2xl',
        '3xl' => 'rounded-3xl',
        'full' => 'rounded-full',
        default => 'rounded-lg',
    };

    $zoomClass = $zoom ? 'group-hover:scale-105 transition-transform duration-300' : '';
@endphp

<figure {{ $attributes->merge(['class' => "group relative overflow-hidden bg-zinc-100 dark:bg-zinc-800/80 {$aspectClass} {$roundedClass}"]) }}>
    @if ($src)
        <img
            src="{{ $src }}"
            alt="{{ $alt }}"
            class="w-full h-full object-center {{ $fitClass }} {{ $zoomClass }}"
            loading="lazy"
        />
    @endif

    {{ $slot }}

    @if ($caption)
        <figcaption class="mt-2 text-xs text-center text-zinc-500 dark:text-zinc-400 font-sans">
            {{ $caption }}
        </figcaption>
    @endif
</figure>
