@props([
    'variant' => 'neutral', // 'neutral' | 'accent' | 'positive' | 'warning' | 'negative'
    'title' => null,
    'icon' => null,
])

@php
    $variantClasses = match ($variant) {
        'neutral' => 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 border-transparent',
        'accent', 'info' => 'bg-blue-900 text-blue-100 dark:bg-blue-950 dark:text-blue-200 border-blue-700',
        'positive', 'success' => 'bg-emerald-900 text-emerald-100 dark:bg-emerald-950 dark:text-emerald-200 border-emerald-700',
        'warning' => 'bg-amber-900 text-amber-100 dark:bg-amber-950 dark:text-amber-200 border-amber-700',
        'negative', 'danger', 'error' => 'bg-red-900 text-red-100 dark:bg-red-950 dark:text-red-200 border-red-700',
        default => 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 border-transparent',
    };
@endphp

<div {{ $attributes->merge(['class' => "rounded-xl border p-4 shadow-lg flex items-start gap-3 transition-all {$variantClasses}"]) }} role="alert">
    @if (isset($icon) && $icon)
        <div class="shrink-0 mt-0.5">{{ $icon }}</div>
    @endif

    <div class="flex-1 text-sm">
        @if ($title)
            <h4 class="font-bold tracking-tight mb-0.5">{{ $title }}</h4>
        @endif
        <div class="leading-relaxed opacity-90">{{ $slot }}</div>
    </div>
</div>
