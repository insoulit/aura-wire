@props([
    'variant' => 'neutral',
    'size' => 'md',
    'icon' => null,
    'shape' => 'pill', // 'pill' | 'rounded'
    'pill' => false,
    'rounded' => false,
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
        'xs' => 'px-2 py-0.5 text-[11px] font-bold uppercase tracking-wider',
        'sm' => 'px-2.5 py-0.5 text-xs font-bold uppercase tracking-wider',
        'md' => 'px-3 py-1 text-xs sm:text-[13px] font-bold uppercase tracking-wider',
        'lg' => 'px-3.5 py-1.5 text-sm font-bold uppercase tracking-wider',
        'xl' => 'px-4 py-2 text-sm sm:text-base font-bold uppercase tracking-wider',
        default => 'px-3 py-1 text-xs sm:text-[13px] font-bold uppercase tracking-wider',
    };

    $shapeClass = match (true) {
        $rounded || $shape === 'rounded' => 'rounded-md',
        default => 'rounded-full',
    };
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center justify-center w-fit gap-1.5 font-mono select-none leading-none align-middle shrink-0 whitespace-nowrap {$shapeClass} {$variantClasses} {$sizeClasses}"]) }}>
    @if (isset($icon) && $icon)
        <span class="shrink-0 flex items-center justify-center leading-none">{{ $icon }}</span>
    @endif
    <span class="inline-flex items-center justify-center leading-none whitespace-nowrap transform translate-y-[0.5px]">{{ $slot }}</span>
</span>
