@props([
    'variant' => 'neutral',
    'size' => 'md',
    'icon' => null,
])

@php
    $variantClasses = match ($variant) {
        'neutral' => 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 border border-transparent',
        'subtle' => 'bg-zinc-100 text-zinc-800 dark:bg-zinc-800 dark:text-zinc-200 border border-zinc-300 dark:border-zinc-700',
        'accent', 'info', 'blue' => 'bg-blue-600/10 text-blue-700 dark:text-blue-400 border border-blue-600/20',
        'positive', 'success', 'green' => 'bg-emerald-600/10 text-emerald-700 dark:text-emerald-400 border border-emerald-600/20',
        'warning', 'yellow' => 'bg-amber-500/10 text-amber-800 dark:text-amber-300 border border-amber-500/20',
        'negative', 'danger', 'red' => 'bg-red-600/10 text-red-700 dark:text-red-400 border border-red-600/20',
        default => 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 border border-transparent',
    };

    $sizeClasses = match ($size) {
        'sm' => 'px-2 py-0.5 text-[10px] font-semibold uppercase tracking-wider rounded-sm',
        'md' => 'px-2.5 py-1 text-xs font-semibold uppercase tracking-wider rounded-md',
        'lg' => 'px-3 py-1 text-sm font-semibold tracking-wide rounded-md',
        default => 'px-2.5 py-1 text-xs font-semibold uppercase tracking-wider rounded-md',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center gap-1.5 font-mono select-none leading-none {$variantClasses} {$sizeClasses}"]) }}>
    @if (isset($icon) && $icon)
        <span class="shrink-0">{{ $icon }}</span>
    @endif
    <span>{{ $slot }}</span>
</span>
