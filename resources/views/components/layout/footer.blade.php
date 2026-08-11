@props([
    'brand' => null,
])

<footer {{ $attributes->merge(['class' => 'w-full border-t border-zinc-200 dark:border-zinc-800 bg-white/50 dark:bg-zinc-950/40 py-8 text-sm text-zinc-600 dark:text-zinc-400 transition-colors']) }}>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            @if (isset($brand))
                <div class="flex items-center gap-3 font-semibold text-zinc-900 dark:text-white">
                    {{ $brand }}
                </div>
            @elseif ($brand)
                <span class="font-semibold text-zinc-900 dark:text-white text-sm">{{ $brand }}</span>
            @endif

            <div class="flex items-center gap-6 font-medium">
                {{ $slot }}
            </div>
        </div>

        @if (isset($bottom))
            <div class="border-t border-zinc-200/60 dark:border-zinc-800/60 pt-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-zinc-500">
                {{ $bottom }}
            </div>
        @endif
    </div>
</footer>
