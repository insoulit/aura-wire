@props([
    'sticky' => true,
])

<header {{ $attributes->merge(['class' => 'w-full bg-white dark:bg-zinc-950 border-b border-zinc-200 dark:border-zinc-800 px-4 sm:px-6 py-3 transition-colors z-30 ' . ($sticky ? 'sticky top-0' : '')]) }}>
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
        @if (isset($brand))
            <div class="flex items-center gap-3 font-bold text-zinc-900 dark:text-white shrink-0">
                {{ $brand }}
            </div>
        @endif

        <div class="flex-1 flex items-center justify-center gap-4">
            {{ $slot }}
        </div>

        @if (isset($actions))
            <div class="flex items-center gap-3 shrink-0">
                {{ $actions }}
            </div>
        @endif
    </div>
</header>
