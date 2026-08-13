@props([
    'size' => 'md', // 'xl' | 'lg' | 'md' | 'sm' | 'xs'
    'variant' => 'default', // 'default' | 'subtle' | 'muted' | 'accent' | 'positive' | 'warning' | 'danger' | 'mono'
    'weight' => 'normal', // 'normal' | 'medium' | 'semibold' | 'bold'
    'as' => 'p',
    'truncate' => false,
])

@php
    $tag = $as;

    $sizeClasses = match ($size) {
        'xl' => 'text-xl sm:text-2xl leading-relaxed',
        'lg' => 'text-lg sm:text-xl leading-relaxed',
        'md' => 'text-base leading-relaxed',
        'sm' => 'text-sm leading-normal',
        'xs' => 'text-xs leading-normal',
        default => 'text-base leading-relaxed',
    };

    $variantClasses = match ($variant) {
        'default' => 'text-zinc-900 dark:text-zinc-100',
        'subtle', 'muted' => 'text-zinc-700 dark:text-zinc-300',
        'accent' => 'text-zinc-900 dark:text-white font-semibold',
        'positive', 'green' => 'text-emerald-600 dark:text-emerald-400',
        'warning', 'yellow' => 'text-amber-600 dark:text-amber-400',
        'danger', 'negative', 'red' => 'text-red-600 dark:text-red-400',
        'mono' => 'font-mono text-zinc-800 dark:text-zinc-200',
        default => 'text-zinc-900 dark:text-zinc-100',
    };

    $weightClasses = match ($weight) {
        'normal' => 'font-normal',
        'medium' => 'font-medium',
        'semibold' => 'font-semibold',
        'bold' => 'font-bold',
        default => 'font-normal',
    };

    $truncateClass = $truncate ? 'truncate' : '';
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "transition-colors group-hover:text-inherit {$sizeClasses} {$variantClasses} {$weightClasses} {$truncateClass}"]) }}>
    {{ $slot }}
</{{ $tag }}>
