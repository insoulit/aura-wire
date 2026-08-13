@props([
    'level' => 1, // 1 | 2 | 3 | 4 | 5 | 6
    'size' => null, // 'display-xl' | 'display-lg' | 'display-md' | 'display-sm' | 'xl' | 'lg' | 'md' | 'sm' | 'xs' | 'xxs'
    'as' => null,
    'weight' => null,
])

@php
    $computedLevel = is_numeric($level) ? (int) $level : 1;
    $tag = $as ?? ("h{$computedLevel}");

    // Default size based on heading level if size prop is omitted
    $computedSize = $size ?? match ($computedLevel) {
        1 => 'xl',
        2 => 'lg',
        3 => 'md',
        4 => 'sm',
        5 => 'xs',
        6 => 'xxs',
        default => 'xl',
    };

    $sizeClasses = match ($computedSize) {
        'display-xl' => 'text-5xl sm:text-6xl lg:text-7xl font-black tracking-tight leading-none',
        'display-lg' => 'text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-none',
        'display-md' => 'text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight',
        'display-sm' => 'text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight leading-tight',
        'xl' => 'text-3xl sm:text-4xl font-extrabold tracking-tight leading-tight',
        'lg' => 'text-2xl sm:text-3xl font-bold tracking-tight leading-snug',
        'md' => 'text-xl sm:text-2xl font-bold tracking-tight leading-snug',
        'sm' => 'text-lg font-bold tracking-tight leading-normal',
        'xs' => 'text-base font-semibold tracking-tight leading-normal',
        'xxs' => 'text-xs font-bold uppercase font-mono tracking-wider leading-normal',
        default => 'text-3xl sm:text-4xl font-extrabold tracking-tight leading-tight',
    };

    $weightClasses = match ($weight) {
        'normal' => 'font-normal',
        'medium' => 'font-medium',
        'semibold' => 'font-semibold',
        'bold' => 'font-bold',
        'extrabold' => 'font-extrabold',
        'black' => 'font-black',
        default => '',
    };
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "text-zinc-900 dark:text-white group-hover:text-inherit transition-colors {$sizeClasses} {$weightClasses}"]) }}>
    {{ $slot }}
</{{ $tag }}>
