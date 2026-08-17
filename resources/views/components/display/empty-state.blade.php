@props([
    'title' => null,
    'description' => null,
    'icon' => null,
])

@php
    $isNamedIcon = is_string($icon) && !empty($icon);
@endphp

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center rounded-xl border border-dashed border-zinc-200 dark:border-zinc-800 p-8 sm:p-12 text-center bg-zinc-50/50 dark:bg-zinc-900/30']) }}>
    @if ($icon)
        <div class="mb-4 flex items-center justify-center">
            @if ($isNamedIcon)
                <div class="w-12 h-12 rounded-xl bg-zinc-100 dark:bg-zinc-800/80 text-zinc-600 dark:text-zinc-300 flex items-center justify-center shadow-2xs border border-zinc-200/60 dark:border-zinc-700/60">
                    <x-aura::icon :name="$icon" size="lg" />
                </div>
            @else
                {{ $icon }}
            @endif
        </div>
    @endif

    @if ($title)
        <h3 class="text-base sm:text-lg font-bold text-zinc-900 dark:text-white tracking-tight leading-snug text-balance">{{ $title }}</h3>
    @endif

    @if ($description)
        <p class="mt-1.5 text-xs sm:text-sm text-zinc-600 dark:text-zinc-400 max-w-sm leading-relaxed text-pretty">{{ $description }}</p>
    @endif

    @if (isset($slot) && !$slot->isEmpty())
        <div class="mt-6 flex flex-wrap items-center justify-center gap-2.5">
            {{ $slot }}
        </div>
    @endif
</div>
