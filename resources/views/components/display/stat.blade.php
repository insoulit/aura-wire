@props([
    'label' => null,
    'value' => null,
    'trend' => null, // e.g. '+12.5%' or '-3.2%'
    'trendDirection' => 'up', // 'up', 'down', 'neutral'
    'description' => null,
    'icon' => null,
])

@php
    $trendClasses = match ($trendDirection) {
        'up' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-950/60 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800/60',
        'down' => 'bg-red-50 text-red-700 dark:bg-red-950/60 dark:text-red-400 border-red-200 dark:border-red-800/60',
        default => 'bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300 border-zinc-200 dark:border-zinc-700',
    };
@endphp

<div {{ $attributes->merge(['class' => 'p-6 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl shadow-2xs space-y-3']) }}>
    <div class="flex items-center justify-between gap-2">
        <span class="text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
            {{ $label }}
        </span>

        @if ($icon)
            <div class="p-2 rounded-xl bg-zinc-100 dark:bg-zinc-800 text-zinc-700 dark:text-zinc-300">
                <x-aura::icon :name="$icon" size="sm" />
            </div>
        @endif
    </div>

    <div class="flex items-baseline justify-between gap-3">
        <span class="text-2xl sm:text-3xl font-extrabold text-zinc-900 dark:text-white tracking-tight">
            {{ $value }}
        </span>

        @if ($trend)
            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold border {{ $trendClasses }}">
                @if ($trendDirection === 'up')
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                @elseif ($trendDirection === 'down')
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                @endif
                <span>{{ $trend }}</span>
            </span>
        @endif
    </div>

    @if ($description)
        <p class="text-xs text-zinc-500 dark:text-zinc-400">
            {{ $description }}
        </p>
    @endif

    {{ $slot }}
</div>
