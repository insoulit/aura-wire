@props([
    'size' => 'xl', // '2xl' | 'xl' | 'lg' | 'md' | 'sm'
    'as' => 'h1',
    'weight' => 'extrabold', // 'black' | 'extrabold' | 'bold' | 'semibold' | 'medium' | 'normal'
    'gradient' => false,
])

@php
    $tag = $as;

    $sizeClasses = match ($size) {
        '2xl' => 'text-6xl sm:text-7xl lg:text-8xl tracking-tight leading-none',
        'xl' => 'text-5xl sm:text-6xl lg:text-7xl tracking-tight leading-none',
        'lg' => 'text-4xl sm:text-5xl lg:text-6xl tracking-tight leading-tight',
        'md' => 'text-3xl sm:text-4xl lg:text-5xl tracking-tight leading-tight',
        'sm' => 'text-2xl sm:text-3xl lg:text-4xl tracking-tight leading-tight',
        default => 'text-5xl sm:text-6xl lg:text-7xl tracking-tight leading-none',
    };

    $weightClasses = match ($weight) {
        'black' => 'font-black',
        'extrabold' => 'font-extrabold',
        'bold' => 'font-bold',
        'semibold' => 'font-semibold',
        'medium' => 'font-medium',
        'normal' => 'font-normal',
        default => 'font-extrabold',
    };

    $colorClasses = $gradient
        ? 'bg-gradient-to-r from-zinc-900 via-zinc-700 to-zinc-900 dark:from-white dark:via-zinc-200 dark:to-zinc-400 bg-clip-text text-transparent'
        : 'text-zinc-900 dark:text-white';
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "transition-colors {$sizeClasses} {$weightClasses} {$colorClasses}"]) }}>
    {{ $slot }}
</{{ $tag }}>
