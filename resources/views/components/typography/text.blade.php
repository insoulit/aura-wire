@props([
    'size' => 'sm', // '2xl' | 'xl' | 'lg' | 'md' | 'sm' | 'xs' | '2xs' | 'xxs'
    'variant' => 'default', // 'default' | 'subtle' | 'muted' | 'accent' | 'primary' | 'secondary' | 'positive' | 'warning' | 'danger' | 'info' | 'mono' | 'white' | 'inverse'
    'weight' => 'normal', // 'light' | 'normal' | 'medium' | 'semibold' | 'bold' | 'extrabold' | 'black'
    'as' => 'p',
    'align' => null, // 'left' | 'center' | 'right' | 'justify'
    'truncate' => false,
    'nowrap' => false,
    'italic' => false,
    'pretty' => false,
    'clamp' => null, // 1 | 2 | 3 | 4 | 5 | 6
    'tracking' => null, // 'tighter' | 'tight' | 'normal' | 'wide' | 'wider' | 'widest'
])

@php
    $tag = $as;

    $sizeClasses = match ($size) {
        '2xl' => 'text-2xl sm:text-3xl leading-relaxed',
        'xl' => 'text-xl sm:text-2xl leading-relaxed',
        'lg' => 'text-lg sm:text-xl leading-relaxed',
        'md' => 'text-base leading-relaxed',
        'sm' => 'text-sm leading-normal',
        'xs' => 'text-xs leading-normal',
        '2xs', 'xxs' => 'text-[11px] leading-tight',
        default => 'text-sm leading-normal',
    };

    $variantClasses = match ($variant) {
        'default' => 'text-zinc-900 dark:text-zinc-100',
        'subtle', 'muted' => 'text-zinc-700 dark:text-zinc-300',
        'accent' => 'text-zinc-900 dark:text-white font-semibold',
        'primary' => 'text-indigo-600 dark:text-indigo-400',
        'secondary' => 'text-zinc-600 dark:text-zinc-400',
        'positive', 'green', 'success' => 'text-emerald-600 dark:text-emerald-400',
        'warning', 'yellow' => 'text-amber-600 dark:text-amber-400',
        'danger', 'negative', 'red', 'error' => 'text-red-600 dark:text-red-400',
        'info', 'blue' => 'text-sky-600 dark:text-sky-400',
        'mono' => 'font-mono whitespace-nowrap text-zinc-800 dark:text-zinc-200',
        'white' => 'text-white',
        'inverse' => 'text-zinc-100 dark:text-zinc-900',
        default => 'text-zinc-900 dark:text-zinc-100',
    };

    $weightClasses = match ($weight) {
        'light' => 'font-light',
        'normal' => 'font-normal',
        'medium' => 'font-medium',
        'semibold' => 'font-semibold',
        'bold' => 'font-bold',
        'extrabold' => 'font-extrabold',
        'black' => 'font-black',
        default => 'font-normal',
    };

    $alignClasses = match ($align) {
        'left', 'start' => 'text-left',
        'center' => 'text-center',
        'right', 'end' => 'text-right',
        'justify' => 'text-justify',
        default => '',
    };

    $clampClasses = match ($clamp) {
        1, '1' => 'line-clamp-1',
        2, '2' => 'line-clamp-2',
        3, '3' => 'line-clamp-3',
        4, '4' => 'line-clamp-4',
        5, '5' => 'line-clamp-5',
        6, '6' => 'line-clamp-6',
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

    $truncateClass = $truncate ? 'truncate' : '';
    $nowrapClass = $nowrap ? 'whitespace-nowrap' : '';
    $italicClass = $italic ? 'italic' : '';
    $prettyClass = $pretty ? 'text-pretty' : '';
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "transition-colors group-hover:text-inherit {$sizeClasses} {$variantClasses} {$weightClasses} {$alignClasses} {$trackingClasses} {$clampClasses} {$truncateClass} {$nowrapClass} {$italicClass} {$prettyClass}"]) }}>
    {{ $slot }}
</{{ $tag }}>
