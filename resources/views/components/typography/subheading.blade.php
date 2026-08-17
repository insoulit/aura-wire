@props([
    'as' => 'p',
    'size' => 'md', // '2xl' | 'xl' | 'lg' | 'md' | 'sm' | 'xs'
    'variant' => 'default', // 'default' | 'subtle' | 'muted' | 'accent' | 'primary' | 'inverse' | 'white'
    'weight' => 'normal', // 'light' | 'normal' | 'medium' | 'semibold' | 'bold'
    'align' => null, // 'left' | 'center' | 'right' | 'justify'
    'pretty' => true,
    'truncate' => false,
    'nowrap' => false,
])

@php
    $sizeClasses = match ($size) {
        '2xl' => 'text-xl sm:text-2xl leading-relaxed tracking-tight',
        'xl' => 'text-lg sm:text-xl leading-relaxed tracking-tight',
        'lg' => 'text-base sm:text-lg leading-relaxed tracking-tight',
        'sm' => 'text-xs sm:text-sm leading-normal tracking-normal',
        'xs' => 'text-xs leading-normal tracking-normal',
        default => 'text-sm sm:text-base leading-relaxed tracking-normal',
    };

    $variantClasses = match ($variant) {
        'default', 'muted', 'subtle' => 'text-zinc-600 dark:text-zinc-400',
        'accent' => 'text-zinc-900 dark:text-white',
        'primary' => 'text-indigo-600 dark:text-indigo-400',
        'inverse', 'white' => 'text-zinc-200 dark:text-zinc-300',
        default => 'text-zinc-600 dark:text-zinc-400',
    };

    $weightClasses = match ($weight) {
        'light' => 'font-light',
        'normal' => 'font-normal',
        'medium' => 'font-medium',
        'semibold' => 'font-semibold',
        'bold' => 'font-bold',
        default => 'font-normal',
    };

    $alignClasses = match ($align) {
        'left', 'start' => 'text-left',
        'center' => 'text-center',
        'right', 'end' => 'text-right',
        'justify' => 'text-justify',
        default => '',
    };

    $prettyClass = $pretty ? 'text-pretty' : '';
    $truncateClass = $truncate ? 'truncate' : '';
    $nowrapClass = $nowrap ? 'whitespace-nowrap' : '';
@endphp

<{{ $as }} {{ $attributes->merge(['class' => "transition-colors {$sizeClasses} {$variantClasses} {$weightClasses} {$alignClasses} {$prettyClass} {$truncateClass} {$nowrapClass}"]) }}>
    {{ $slot }}
</{{ $as }}>
