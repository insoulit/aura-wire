@props([
    'size' => 'sm', // 'xs' | 'sm' | 'md' | 'lg'
    'variant' => 'default', // 'default' | 'outline' | 'solid'
])

@php
    $sizeClasses = match ($size) {
        'xs' => 'px-1.5 py-0.5 text-[10px] min-h-[18px] min-w-[18px]',
        'md' => 'px-2.5 py-1 text-xs min-h-[26px] min-w-[26px]',
        'lg' => 'px-3 py-1.5 text-sm min-h-[32px] min-w-[32px]',
        default => 'px-2 py-0.5 text-[11px] min-h-[22px] min-w-[22px]',
    };

    $variantClasses = match ($variant) {
        'outline' => 'border border-zinc-300 dark:border-zinc-700 bg-transparent text-zinc-700 dark:text-zinc-300',
        'solid' => 'bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 border-b-2 border-zinc-950 dark:border-zinc-200',
        default => 'bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300 border border-zinc-300/80 dark:border-zinc-700 shadow-2xs border-b-2 border-b-zinc-400/80 dark:border-b-zinc-600',
    };
@endphp

<kbd {{ $attributes->merge(['class' => "inline-flex items-center justify-center font-mono font-medium rounded-md select-none transition-colors {$sizeClasses} {$variantClasses}"]) }}>
    {{ $slot }}
</kbd>
