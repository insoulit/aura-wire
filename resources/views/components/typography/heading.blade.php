@props([
    'level' => 1, // 1 | 2 | 3 | 4 | 5 | 6
    'size' => null, // 'display-2xl' | 'display-xl' | 'display-lg' | 'display' | '3xl' | '2xl' | 'xl' | 'lg' | 'md' | 'sm' | 'xs' | 'xxs' | '2xs'
    'as' => null,
    'weight' => null, // 'light' | 'normal' | 'medium' | 'semibold' | 'bold' | 'extrabold' | 'black'
    'variant' => 'default', // 'default' | 'subtle' | 'muted' | 'accent' | 'primary' | 'positive' | 'warning' | 'danger' | 'gradient' | 'inverse' | 'white'
    'align' => null, // 'left' | 'center' | 'right' | 'justify'
    'balance' => true,
    'truncate' => false,
    'nowrap' => false,
    'tracking' => null, // 'tighter' | 'tight' | 'normal' | 'wide' | 'wider' | 'widest'
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
        'display-2xl', '4xl' => 'text-5xl sm:text-6xl lg:text-7xl font-extrabold tracking-tight leading-none',
        'display-xl', 'display-lg', 'display', '3xl' => 'text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight',
        '2xl' => 'text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight',
        'xl' => 'text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight leading-tight',
        'lg' => 'text-xl sm:text-2xl lg:text-3xl font-bold tracking-tight leading-snug',
        'md' => 'text-lg sm:text-xl font-bold tracking-tight leading-snug',
        'sm' => 'text-base sm:text-lg font-bold tracking-tight leading-normal',
        'xs' => 'text-sm sm:text-base font-semibold tracking-tight leading-normal',
        'xxs', '2xs' => 'text-xs font-semibold uppercase font-mono tracking-wider leading-normal',
        default => 'text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight leading-tight',
    };

    $weightClasses = match ($weight) {
        'light' => 'font-light',
        'normal' => 'font-normal',
        'medium' => 'font-medium',
        'semibold' => 'font-semibold',
        'bold' => 'font-bold',
        'extrabold' => 'font-extrabold',
        'black' => 'font-black',
        default => '',
    };

    $variantClasses = match ($variant) {
        'default' => 'text-zinc-900 dark:text-white',
        'subtle', 'muted' => 'text-zinc-600 dark:text-zinc-400',
        'accent' => 'text-zinc-900 dark:text-white',
        'primary' => 'text-indigo-600 dark:text-indigo-400',
        'positive', 'success' => 'text-emerald-600 dark:text-emerald-400',
        'warning' => 'text-amber-600 dark:text-amber-400',
        'danger', 'error' => 'text-red-600 dark:text-red-400',
        'gradient' => 'bg-gradient-to-r from-zinc-900 via-zinc-700 to-zinc-900 dark:from-white dark:via-zinc-200 dark:to-zinc-400 bg-clip-text text-transparent',
        'inverse', 'white' => 'text-white',
        default => 'text-zinc-900 dark:text-white',
    };

    $alignClasses = match ($align) {
        'left', 'start' => 'text-left',
        'center' => 'text-center',
        'right', 'end' => 'text-right',
        'justify' => 'text-justify',
        default => '',
    };

    $trackingClasses = match ($tracking) {
        'tighter' => 'tracking-tighter',
        'tight' => 'tracking-tight',
        'normal' => 'tracking-normal',
        'wide' => 'tracking-wide',
        'wider' => 'tracking-wider',
        'widest' => 'tracking-widest',
        default => '',
    };

    $balanceClass = $balance ? 'text-balance' : '';
    $truncateClass = $truncate ? 'truncate' : '';
    $nowrapClass = $nowrap ? 'whitespace-nowrap' : '';
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "group-hover:text-inherit transition-colors {$variantClasses} {$sizeClasses} {$weightClasses} {$alignClasses} {$trackingClasses} {$balanceClass} {$truncateClass} {$nowrapClass}"]) }}>
    {{ $slot }}
</{{ $tag }}>
