@props([
    'title' => null,
    'time' => null,
    'description' => null,
    'variant' => 'solid', // 'solid', 'subtle'
    'icon' => null,
])

@php
    $dotClasses = match ($variant) {
        'subtle', 'neutral' => 'bg-zinc-100 dark:bg-zinc-800 text-zinc-900 dark:text-zinc-100 border border-zinc-300 dark:border-zinc-700 ring-4 ring-zinc-50 dark:ring-zinc-900/50',
        default => 'bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 ring-4 ring-zinc-100 dark:ring-zinc-800',
    };
@endphp

<div {{ $attributes->merge(['class' => 'relative flex items-start gap-4 pl-10']) }}>
    <div class="absolute left-0 top-1 flex h-7 w-7 items-center justify-center rounded-full text-xs font-bold shadow-2xs {{ $dotClasses }}">
        @if ($icon)
            <x-aura::icon :name="$icon" size="xs" />
        @else
            <div class="h-2 w-2 rounded-full bg-current"></div>
        @endif
    </div>

    <div class="flex-1 space-y-1">
        <div class="flex items-center justify-between gap-2">
            <h4 class="text-sm font-bold text-zinc-900 dark:text-white tracking-tight">{{ $title }}</h4>
            @if ($time)
                <time class="text-xs text-zinc-400 font-mono">{{ $time }}</time>
            @endif
        </div>

        @if ($description)
            <p class="text-xs text-zinc-500 dark:text-zinc-400 leading-relaxed">{{ $description }}</p>
        @endif

        @if ($slot->isNotEmpty())
            <div class="pt-1 text-xs text-zinc-600 dark:text-zinc-300">
                {{ $slot }}
            </div>
        @endif
    </div>
</div>
