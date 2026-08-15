@props([
    'brand' => null,
    'variant' => 'default', // 'default', 'dark', 'minimal', 'bordered'
])

@php
    $variantClasses = match ($variant) {
        'dark' => 'bg-zinc-900 border-zinc-800 text-white',
        'minimal' => 'bg-transparent border-transparent',
        'bordered' => 'bg-white dark:bg-zinc-900 border-zinc-200/80 dark:border-zinc-800/80',
        default => 'bg-white/90 dark:bg-zinc-950/90 backdrop-blur-md border-zinc-200/80 dark:border-zinc-800/80',
    };
@endphp

<header {{ $attributes->merge(['class' => "w-full border-b px-4 sm:px-6 py-3 sticky top-0 z-40 {$variantClasses}"]) }}>
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
        <div class="flex items-center gap-6">
            @if ($brand || isset($brandSlot))
                <div class="font-extrabold text-lg tracking-tight text-zinc-900 dark:text-white flex items-center gap-2">
                    {{ $brandSlot ?? $brand }}
                </div>
            @endif

            @if (isset($navigation))
                <nav class="hidden md:flex items-center gap-1.5 overflow-x-auto scrollbar-none">
                    {{ $navigation }}
                </nav>
            @endif
        </div>

        <div class="flex items-center gap-2.5">
            {{ $slot }}
            @if (isset($actions))
                {{ $actions }}
            @endif
        </div>
    </div>
</header>
