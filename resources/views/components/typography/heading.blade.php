@props([
    'level' => 1, // 1 | 2 | 3 | 4 | 5 | 6
    'size' => null, // '2xl' | 'xl' | 'lg' | 'md' | 'sm' | 'xs' | '2xs'
    'as' => null,
    'weight' => null, // 'light' | 'normal' | 'medium' | 'semibold' | 'bold' | 'extrabold' | 'black'
    'variant' => 'default', // 'default' | 'gradient' | 'subtle' | 'muted' | 'accent' | 'positive' | 'warning' | 'danger'
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
        6 => '2xs',
        default => 'xl',
    };

    $sizeClasses = match ($computedSize) {
        '2xl' => 'text-3xl sm:text-4xl font-extrabold leading-tight',
        'xl' => 'text-2xl sm:text-3xl font-extrabold leading-tight',
        'lg' => 'text-xl sm:text-2xl font-bold leading-snug',
        'md' => 'text-lg sm:text-xl font-bold leading-snug',
        'sm' => 'text-base sm:text-lg font-bold leading-normal',
        'xs' => 'text-sm sm:text-base font-semibold leading-normal',
        '2xs', 'xxs' => 'text-xs font-semibold uppercase font-mono tracking-wider leading-normal',
        default => 'text-2xl sm:text-3xl font-extrabold leading-tight',
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
        'gradient' => 'bg-gradient-to-r from-zinc-950 via-zinc-600 to-zinc-950 dark:from-white dark:via-zinc-400 dark:to-white bg-clip-text text-transparent',
        'subtle', 'muted' => 'text-zinc-600 dark:text-zinc-400',
        'accent' => 'text-zinc-900 dark:text-white',
        'positive', 'success' => 'text-emerald-600 dark:text-emerald-400',
        'warning' => 'text-amber-600 dark:text-amber-400',
        'danger', 'error' => 'text-red-600 dark:text-red-400',
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
