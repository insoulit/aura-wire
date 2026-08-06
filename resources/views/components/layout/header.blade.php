@props([
    'sticky' => true,
    'variant' => 'default', // 'default', 'dark', 'minimal', 'bordered'
])

@php
    $variantClasses = match ($variant) {
        'dark' => 'bg-zinc-950 text-white border-b border-zinc-800/80 shadow-md',
        'minimal' => 'bg-transparent border-b border-zinc-200/50 dark:border-zinc-800/50',
        'bordered' => 'bg-white dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-800 shadow-2xs',
        default => 'bg-white/90 dark:bg-zinc-950/90 backdrop-blur-md border-b border-zinc-200/80 dark:border-zinc-800/80 shadow-2xs',
    };

    $stickyClass = $sticky ? 'sticky top-0 z-30' : 'relative z-10';
@endphp

<header {{ $attributes->merge(['class' => "w-full px-4 sm:px-6 py-3 transition-all {$variantClasses} {$stickyClass}"]) }}>
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
        @if (isset($brand))
            <div class="flex items-center gap-3 font-bold text-zinc-900 dark:text-white shrink-0">
                {{ $brand }}
            </div>
        @endif

        <nav class="flex-1 flex items-center justify-start sm:justify-center gap-1.5 overflow-x-auto scrollbar-none py-0.5">
            {{ $slot }}
        </nav>

        @if (isset($actions))
            <div class="flex items-center gap-2.5 shrink-0">
                {{ $actions }}
            </div>
        @endif
    </div>
</header>
