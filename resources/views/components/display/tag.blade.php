@props([
    'variant' => 'default', // 'default' | 'primary' | 'success' | 'warning' | 'danger'
    'size' => 'md', // 'sm' | 'md' | 'lg'
])

@php
    $sizeClasses = match ($size) {
        'sm' => 'px-3 py-0.5 text-xs',
        'md' => 'px-3.5 py-1 text-xs font-medium',
        'lg' => 'px-4 py-1.5 text-sm font-medium',
        default => 'px-3.5 py-1 text-xs font-medium',
    };

    $variantClasses = match ($variant) {
        'primary' => 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900',
        'success' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300',
        'warning' => 'bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300',
        'danger' => 'bg-red-100 text-red-800 dark:bg-red-950 dark:text-red-300',
        'default' => 'bg-zinc-100 text-zinc-800 dark:bg-zinc-800 dark:text-zinc-100',
        default => 'bg-zinc-100 text-zinc-800 dark:bg-zinc-800 dark:text-zinc-100',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center rounded-full transition-all duration-150 {$sizeClasses} {$variantClasses}"]) }}>
    {{ $slot }}
</span>
