@props([
    'variant' => 'text', // 'text', 'avatar', 'button', 'card'
    'height' => null,
    'width' => null,
])

@php
    $hasClassWidth = preg_match('/(?:^|\s)w-/', $attributes->get('class', ''));
    $hasClassHeight = preg_match('/(?:^|\s)h-/', $attributes->get('class', ''));

    $baseClasses = 'animate-pulse bg-zinc-200 dark:bg-zinc-800';

    $widthClass = $hasClassWidth ? '' : 'w-full ';
    $heightClass = $hasClassHeight ? '' : 'h-4 ';

    $variantClasses = match ($variant) {
        'avatar', 'circle' => 'w-10 h-10 rounded-full shrink-0',
        'button' => 'w-24 h-10 rounded-xl shrink-0',
        'badge' => 'w-16 h-6 rounded-full shrink-0',
        'card' => "{$widthClass}h-48 rounded-2xl",
        default => "{$widthClass}{$heightClass}rounded-md",
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
