@props([
    'variant' => 'text', // 'text', 'avatar', 'circle', 'button', 'badge', 'card'
    'size' => 'md', // 'xs', 'sm', 'md', 'lg', 'xl'
    'height' => null,
    'width' => null,
])

@php
    $baseClasses = 'animate-pulse bg-zinc-200 dark:bg-zinc-800';

    $avatarSize = match ($size) {
        'xs' => 'w-6 h-6',
        'sm' => 'w-8 h-8',
        'lg' => 'w-12 h-12',
        'xl' => 'w-16 h-16',
        default => 'w-10 h-10',
    };

    $buttonSize = match ($size) {
        'xs' => 'w-16 h-7 rounded-md',
        'sm' => 'w-20 h-8 rounded-lg',
        'lg' => 'w-28 h-10 rounded-2xl',
        default => 'w-24 h-10 rounded-xl',
    };

    $textSize = match ($size) {
        'xs' => 'h-2.5 w-24 rounded-sm',
        'sm' => 'h-3 w-32 rounded-md',
        'lg' => 'h-5 w-48 rounded-md',
        'xl' => 'h-6 w-64 rounded-lg',
        default => 'h-4 w-full rounded-md',
    };

    $variantClasses = match ($variant) {
        'avatar', 'circle' => "{$avatarSize} rounded-full shrink-0",
        'button' => "{$buttonSize} shrink-0",
        'badge' => 'w-16 h-5 rounded-full shrink-0',
        'card' => 'w-full h-40 rounded-2xl',
        default => $textSize,
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
