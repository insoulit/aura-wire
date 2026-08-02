@props([
    'variant' => 'neutral',
    'size' => 'md',
    'icon' => null,
])

@php
    $variantClasses = match ($variant) {
        'primary', 'neutral' => 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 border border-transparent',
        'subtle', 'accent', 'info' => 'bg-zinc-100 text-zinc-900 dark:bg-zinc-800 dark:text-zinc-100 border border-zinc-300 dark:border-zinc-700',
        'positive', 'success', 'green' => 'bg-emerald-600/10 text-emerald-700 dark:text-emerald-400 border border-emerald-600/20',
        'warning', 'yellow' => 'bg-amber-500/10 text-amber-800 dark:text-amber-300 border border-amber-500/20',
        'negative', 'danger', 'red' => 'bg-red-600/10 text-red-700 dark:text-red-400 border border-red-600/20',
        default => 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 border border-transparent',
    };

    $sizeClasses = match ($size) {
        'sm' => 'px-2.5 py-1 text-[11px] font-bold uppercase tracking-wider rounded-full',
        'md' => 'px-3 py-1.5 text-xs font-bold uppercase tracking-wider rounded-full',
        'lg' => 'px-3.5 py-2 text-xs sm:text-sm font-semibold tracking-wide rounded-full',
        default => 'px-3 py-1.5 text-xs font-bold uppercase tracking-wider rounded-full',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center justify-center gap-1.5 font-mono select-none leading-none align-middle {$variantClasses} {$sizeClasses}"]) }}>
    @if (isset($icon) && $icon)
        <span class="shrink-0 flex items-center justify-center leading-none">{{ $icon }}</span>
    @endif
    <span class="inline-flex items-center justify-center leading-none transform translate-y-[0.5px]">{{ $slot }}</span>
</span>
