@props([
    'sticky' => true,
    'variant' => 'default', // 'default', 'dark', 'minimal', 'bordered'
    'border' => false,
    'responsive' => true,
    'align' => 'end', // 'end', 'center', 'start'
])

@php
    $variantClasses = match ($variant) {
        'dark' => 'bg-zinc-950 text-white shadow-md',
        'minimal' => 'bg-transparent',
        'bordered' => 'bg-white dark:bg-zinc-900 shadow-2xs',
        default => 'bg-white/90 dark:bg-zinc-950/90 backdrop-blur-md shadow-2xs',
    };

    $borderClasses = ($border || $variant === 'bordered')
        ? match ($variant) {
            'dark' => 'border-b border-zinc-800/80',
            'minimal' => 'border-b border-zinc-200/50 dark:border-zinc-800/50',
            default => 'border-b border-zinc-200/80 dark:border-zinc-800/80',
          }
        : '';

    $buttonTextClasses = match ($variant) {
        'dark' => 'text-zinc-300 hover:text-white hover:bg-zinc-800/80',
        default => 'text-zinc-600 dark:text-zinc-300 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800/60',
    };

    $drawerBorderClasses = match ($variant) {
        'dark' => 'border-t border-zinc-800/80',
        'minimal' => 'border-t border-zinc-200/50 dark:border-zinc-800/50',
        default => 'border-t border-zinc-200/80 dark:border-zinc-800/80',
    };

    $justifyClass = match ($align) {
        'center' => 'justify-center',
        'start' => 'justify-start',
        default => 'justify-end',
    };

    $stickyClass = $sticky ? 'sticky top-0 z-30' : 'relative z-10';
    $navClasses = $responsive
        ? "hidden md:flex flex-1 items-center {$justifyClass} gap-1.5 mr-2"
        : "flex-1 flex items-center {$justifyClass} gap-1.5 overflow-x-auto scrollbar-none py-0.5 mr-2";
@endphp

<header
    @if ($responsive) x-data="{ mobileOpen: false }" @endif
    {{ $attributes->merge(['class' => "w-full px-4 sm:px-6 py-3 sm:py-3.5 transition-all {$variantClasses} {$borderClasses} {$stickyClass}"]) }}
>
    <div class="max-w-7xl mx-auto flex items-center justify-between gap-3 sm:gap-4">
        @if (isset($brand))
            <div class="flex items-center gap-2.5 sm:gap-3 font-bold text-zinc-900 dark:text-white shrink-0 min-w-0">
                {{ $brand }}
            </div>
        @endif

        <nav class="{{ $navClasses }}">
            {{ $slot }}
        </nav>

        <div class="flex items-center gap-2 sm:gap-3 shrink-0">
            @if (isset($actions))
                {{ $actions }}
            @endif

            @if ($responsive)
                <button
                    type="button"
                    x-on:click="mobileOpen = !mobileOpen"
                    class="md:hidden inline-flex items-center justify-center p-2 rounded-xl {{ $buttonTextClasses }} transition-colors focus:outline-hidden cursor-pointer shrink-0"
                    aria-label="Toggle navigation menu"
                >
                    <svg x-show="!mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            @endif
        </div>
    </div>

    @if ($responsive)
        {{-- Mobile Collapsible Navigation Menu --}}
        <div
            x-show="mobileOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="md:hidden pt-3 pb-3 mt-3 {{ $drawerBorderClasses }} space-y-3"
            style="display: none;"
        >
            <nav class="flex flex-col gap-2 p-1 [&_a]:w-full [&_a]:justify-start">
                @if (isset($mobileNav))
                    {{ $mobileNav }}
                @else
                    {{ $slot }}
                @endif
            </nav>

            {{-- Actions inside Mobile Drawer: Packagist Button First, Theme Switcher Centered --}}
            <div class="pt-3 border-t border-zinc-100 dark:border-zinc-800/60 flex flex-col items-center gap-3 px-1">
                <x-aura::button variant="outline" size="md" icon="package" href="https://packagist.org/packages/insoulit/aura-wire" target="_blank" rel="noopener noreferrer" class="w-full justify-center rounded-lg">
                    Packagist
                </x-aura::button>
                <div class="flex items-center justify-center w-full pt-1">
                    <x-theme-switcher />
                </div>
            </div>
        </div>
    @endif
</header>
