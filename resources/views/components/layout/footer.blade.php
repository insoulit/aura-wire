@props([
    'brand' => null,
    'variant' => 'default', // 'default', 'dark', 'bordered'
])

@php
    $variantClasses = match ($variant) {
        'dark' => 'bg-zinc-900 border-zinc-800 text-zinc-300',
        'bordered' => 'bg-white dark:bg-zinc-900 border-zinc-200/80 dark:border-zinc-800/80 text-zinc-600 dark:text-zinc-400',
        default => 'border-t border-zinc-200 dark:border-zinc-800 bg-white/50 dark:bg-zinc-950/40 text-zinc-600 dark:text-zinc-400',
    };
@endphp

<footer {{ $attributes->merge(['class' => "w-full border-t py-8 text-sm transition-colors {$variantClasses}"]) }}>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            @if (isset($brand) && $brand)
                <div class="flex items-center justify-center sm:justify-start gap-3 font-semibold text-zinc-900 dark:text-white">
                    {{ $brand }}
                </div>
            @endif

            <div class="flex flex-wrap items-center justify-center sm:justify-end gap-4 sm:gap-6 font-medium">
                {{ $slot }}
            </div>
        </div>

        @if (isset($bottom))
            <div class="border-t border-zinc-200/60 dark:border-zinc-800/60 pt-4 flex flex-col sm:flex-row items-center justify-between gap-3 text-zinc-500 text-center sm:text-left">
                {{ $bottom }}
            </div>
        @endif
    </div>
</footer>
