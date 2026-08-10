@props([
    'variant' => 'default', // 'default' | 'primary' | 'success' | 'warning' | 'danger'
    'size' => 'md', // 'sm' | 'md' | 'lg'
    'shape' => 'pill', // 'pill' | 'rounded'
    'pill' => false,
    'rounded' => false,
])

@php
    $sizeClasses = match ($size) {
        'sm' => 'px-2 py-0.5 text-[10px] font-semibold',
        'md' => 'px-2.5 py-0.5 text-xs font-semibold',
        'lg' => 'px-3 py-1 text-xs font-semibold',
        default => 'px-2.5 py-0.5 text-xs font-semibold',
    };

    $variantClasses = match ($variant) {
        'primary' => 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900',
        'success' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300',
        'warning' => 'bg-amber-100 text-amber-800 dark:bg-amber-950 dark:text-amber-300',
        'danger' => 'bg-red-100 text-red-800 dark:bg-red-950 dark:text-red-300',
        'default' => 'bg-zinc-100 text-zinc-800 dark:bg-zinc-800 dark:text-zinc-100',
        default => 'bg-zinc-100 text-zinc-800 dark:bg-zinc-800 dark:text-zinc-100',
    };

    $shapeClass = match (true) {
        $rounded || $shape === 'rounded' => 'rounded-md',
        default => 'rounded-full',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center w-fit transition-all duration-150 {$shapeClass} {$sizeClasses} {$variantClasses}"]) }}>
    {{ $slot }}
</span>
