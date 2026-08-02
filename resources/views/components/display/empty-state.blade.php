@props([
    'title' => null,
    'description' => null,
    'icon' => null,
])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center rounded-2xl border-2 border-dashed border-zinc-200 dark:border-zinc-800 p-8 sm:p-12 text-center bg-zinc-50/50 dark:bg-zinc-900/30']) }}>
    @if ($icon)
        <div class="mb-4 text-zinc-400 dark:text-zinc-500">
            {{ $icon }}
        </div>
    @endif

    @if ($title)
        <h3 class="text-base sm:text-lg font-bold text-zinc-900 dark:text-white tracking-tight">{{ $title }}</h3>
    @endif

    @if ($description)
        <p class="mt-1 text-xs sm:text-sm text-zinc-500 dark:text-zinc-400 max-w-sm leading-relaxed">{{ $description }}</p>
    @endif

    @if (isset($slot) && $slot->isNotEmpty())
        <div class="mt-6">
            {{ $slot }}
        </div>
    @endif
</div>
