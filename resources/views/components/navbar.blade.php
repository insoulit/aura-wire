@props([
    'brand' => null,
])

<header {{ $attributes->merge(['class' => 'w-full bg-white dark:bg-zinc-950 border-b border-zinc-200 dark:border-zinc-800 px-4 sm:px-6 py-3.5 sticky top-0 z-40']) }}>
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
        <div class="flex items-center gap-6">
            @if ($brand || isset($brandSlot))
                <div class="font-extrabold text-lg tracking-tight text-zinc-900 dark:text-white flex items-center gap-2">
                    {{ $brandSlot ?? $brand }}
                </div>
            @endif

            @if (isset($navigation))
                <nav class="hidden md:flex items-center gap-1">
                    {{ $navigation }}
                </nav>
            @endif
        </div>

        @if (isset($actions))
            <div class="flex items-center gap-3">
                {{ $actions }}
            </div>
        @endif
    </div>
</header>
