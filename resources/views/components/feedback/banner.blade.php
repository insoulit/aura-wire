@props([
    'variant' => 'info', // 'info' | 'success' | 'warning' | 'danger'
    'dismissible' => false,
])

@php
    $variantClasses = match ($variant) {
        'success' => 'bg-emerald-50 text-emerald-900 border-emerald-200 dark:bg-emerald-950/40 dark:text-emerald-200 dark:border-emerald-800',
        'warning' => 'bg-amber-50 text-amber-900 border-amber-200 dark:bg-amber-950/40 dark:text-amber-200 dark:border-amber-800',
        'danger' => 'bg-red-50 text-red-900 border-red-200 dark:bg-red-950/40 dark:text-red-200 dark:border-red-800',
        'info' => 'bg-zinc-100 text-zinc-900 border-zinc-200 dark:bg-zinc-800/60 dark:text-zinc-200 dark:border-zinc-700',
        default => 'bg-zinc-100 text-zinc-900 border-zinc-200 dark:bg-zinc-800/60 dark:text-zinc-200 dark:border-zinc-700',
    };
@endphp

<div
    role="alert"
    @if ($dismissible) x-data="{ show: true }" x-show="show" @endif
    {{ $attributes->merge(['class' => "flex items-center justify-between p-4 rounded-xl border transition-all duration-200 {$variantClasses}"]) }}
>
    <div class="flex items-center gap-3 text-sm font-medium">
        {{ $slot }}
    </div>

    @if ($dismissible)
        <button
            type="button"
            @click="show = false"
            class="p-1 rounded-md hover:bg-black/5 dark:hover:bg-white/10 transition-colors"
            aria-label="Dismiss"
        >
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    @endif
</div>
