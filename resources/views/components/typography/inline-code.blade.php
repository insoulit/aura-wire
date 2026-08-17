@props([
    'size' => 'sm', // 'xs' | 'sm' | 'md'
    'variant' => 'default', // 'default' | 'outline' | 'dark'
])

@php
    $sizeClasses = match ($size) {
        'xs' => 'text-[11px] px-1 py-0.5',
        'md' => 'text-sm px-2 py-1',
        default => 'text-xs px-1.5 py-0.5',
    };

    $variantClasses = match ($variant) {
        'outline' => 'border border-zinc-300 dark:border-zinc-700 bg-transparent text-zinc-800 dark:text-zinc-200',
        'dark' => 'bg-zinc-900 text-zinc-100 border border-zinc-800',
        default => 'bg-zinc-100 dark:bg-zinc-800 text-zinc-800 dark:text-zinc-200 border border-zinc-200 dark:border-zinc-700/60',
    };
@endphp

<code {{ $attributes->merge(['class' => "font-mono rounded-md font-medium inline-block select-all {$sizeClasses} {$variantClasses}"]) }}>
    {{ $slot }}
</code>
