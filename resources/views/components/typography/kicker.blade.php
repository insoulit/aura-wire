@props([
    'as' => 'p',
    'size' => 'sm', // 'xs' | 'sm' | 'md' | 'lg'
    'variant' => 'default', // 'default' | 'subtle' | 'muted' | 'primary' | 'accent' | 'dark' | 'positive' | 'warning' | 'danger'
    'weight' => 'bold', // 'medium' | 'semibold' | 'bold' | 'extrabold'
    'tracking' => 'widest', // 'wide' | 'wider' | 'widest'
    'uppercase' => true,
    'icon' => null,
    'align' => null, // 'left' | 'center' | 'right'
])

@php
    $sizeClasses = match ($size) {
        'xs' => 'text-[10px] sm:text-[11px]',
        'md' => 'text-xs sm:text-sm',
        'lg' => 'text-sm sm:text-base',
        default => 'text-[11px] sm:text-xs',
    };

    $weightClasses = match ($weight) {
        'medium' => 'font-medium',
        'semibold' => 'font-semibold',
        'extrabold' => 'font-extrabold',
        default => 'font-bold',
    };

    $variantClasses = match ($variant) {
        'default', 'subtle', 'muted' => 'text-zinc-600 dark:text-zinc-300',
        'primary', 'accent' => 'text-indigo-600 dark:text-indigo-400',
        'dark', 'contrast' => 'text-zinc-900 dark:text-white',
        'positive', 'success' => 'text-emerald-600 dark:text-emerald-400',
        'warning' => 'text-amber-600 dark:text-amber-400',
        'danger' => 'text-red-600 dark:text-red-400',
        default => 'text-zinc-600 dark:text-zinc-300',
    };

    $trackingClasses = match ($tracking) {
        'wide' => 'tracking-wide',
        'wider' => 'tracking-wider',
        default => 'tracking-widest',
    };

    $alignClasses = match ($align) {
        'left', 'start' => 'text-left justify-start',
        'center' => 'text-center justify-center',
        'right', 'end' => 'text-right justify-end',
        default => '',
    };

    $uppercaseClass = $uppercase ? 'uppercase' : '';
    $iconSize = match ($size) {
        'xs' => 'xs',
        'lg' => 'sm',
        default => 'xs',
    };
@endphp

<{{ $as }} {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 font-sans {$sizeClasses} {$weightClasses} {$variantClasses} {$trackingClasses} {$alignClasses} {$uppercaseClass} select-none"]) }}>
    @if ($icon)
        <x-aura::icon :name="$icon" :size="$iconSize" />
    @endif
    <span>{{ $slot }}</span>
</{{ $as }}>
