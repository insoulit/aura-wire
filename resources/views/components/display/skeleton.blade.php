@props([
    'variant' => 'text', // 'text', 'avatar', 'button', 'card'
    'height' => null,
    'width' => null,
])

@php
    $baseClasses = 'animate-pulse bg-zinc-200 dark:bg-zinc-800 rounded-lg';

    $variantClasses = match ($variant) {
        'avatar' => 'w-10 h-10 rounded-full',
        'button' => 'w-24 h-10 rounded-xl',
        'card' => 'w-full h-48 rounded-2xl',
        default => 'w-full h-4 rounded-md',
    };

    $style = array_filter([
        'width' => $width,
        'height' => $height,
    ]);
@endphp

<div
    {{ $attributes->merge(['class' => "{$baseClasses} {$variantClasses}"]) }}
    @if ($style) style="{{ collect($style)->map(fn($v, $k) => "$k: $v")->implode('; ') }}" @endif
></div>
