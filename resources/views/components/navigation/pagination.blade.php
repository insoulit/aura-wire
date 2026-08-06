@props([
    'page' => 1,
    'totalPages' => 10,
    'total' => null,
    'perPage' => 10,
    'variant' => 'numbers', // 'numbers', 'pills', 'simple', 'compact', 'card'
    'shape' => 'circle', // 'circle', 'square'
    'size' => 'md', // 'sm', 'md', 'lg'
    'iconsOnly' => false,
    'align' => 'center', // 'start', 'center', 'end', 'left', 'right'
    'paginator' => null,
])

@php
    $currentPage = (int) ($page ?? 1);
    $lastPage = (int) ($totalPages ?? 10);
    $isFirst = $currentPage <= 1;
    $isLast = $currentPage >= $lastPage;

    // Calculate showing numbers if total is provided
    $from = $total ? (($currentPage - 1) * $perPage) + 1 : null;
    $to = $total ? min($currentPage * $perPage, $total) : null;

    // Numbered pagination window calculation (e.g. 1 ... 4 5 6 ... 10)
    $window = 2;
    $startPage = max(1, $currentPage - $window);
    $endPage = min($lastPage, $currentPage + $window);

    // Alignment classes
    $alignClasses = match ($align) {
        'start', 'left' => 'justify-start',
        'end', 'right' => 'justify-end',
        'center' => 'justify-center',
        default => 'justify-center',
    };

    // Button size classes
    $btnSizeClasses = match ($size) {
        'sm' => 'w-7 h-7 text-xs',
        'lg' => 'w-10 h-10 text-base',
        default => 'w-8.5 h-8.5 text-sm',
    };

    $radiusClass = ($shape === 'square') ? 'rounded-xl' : 'rounded-full';

    // Active button classes
    $activeBtnClass = "bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 font-bold shadow-xs {$radiusClass} {$btnSizeClasses} flex items-center justify-center";
    $inactiveBtnClass = "bg-transparent hover:bg-zinc-100 dark:hover:bg-zinc-800 text-zinc-700 dark:text-zinc-300 font-medium transition-colors {$radiusClass} {$btnSizeClasses} flex items-center justify-center";
@endphp

<nav role="navigation" aria-label="Pagination Navigation" {{ $attributes->merge(['class' => 'w-full']) }}>
    @if ($paginator && method_exists($paginator, 'links'))
        {{ $paginator->links() }}
    @elseif ($variant === 'simple')
        {{-- Simple Clean Text Previous / Next with Page Info --}}
        <div class="flex items-center justify-between gap-4 p-2">
            @if ($iconsOnly)
                <x-aura::icon-button variant="secondary" size="{{ $size === 'lg' ? 'md' : 'sm' }}" :shape="$shape" :disabled="$isFirst" label="Previous">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </x-aura::icon-button>
            @else
                <x-aura::button variant="secondary" size="{{ $size === 'lg' ? 'md' : 'sm' }}" :disabled="$isFirst">
                    Previous
                </x-aura::button>
            @endif

            <span class="text-xs sm:text-sm font-medium text-zinc-600 dark:text-zinc-400">
                Page <span class="font-bold text-zinc-900 dark:text-white">{{ $currentPage }}</span> of <span class="font-bold text-zinc-900 dark:text-white">{{ $lastPage }}</span>
            </span>

            @if ($iconsOnly)
                <x-aura::icon-button variant="secondary" size="{{ $size === 'lg' ? 'md' : 'sm' }}" :shape="$shape" :disabled="$isLast" label="Next">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </x-aura::icon-button>
            @else
                <x-aura::button variant="secondary" size="{{ $size === 'lg' ? 'md' : 'sm' }}" :disabled="$isLast">
                    Next
                </x-aura::button>
            @endif
        </div>

    @elseif ($variant === 'compact')
        {{-- Compact Icon-Only Pagination --}}
        <div class="flex items-center {{ $alignClasses }} gap-2">
            <x-aura::icon-button variant="secondary" size="{{ $size }}" :shape="$shape" :disabled="$isFirst" label="Previous Page">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </x-aura::icon-button>

            <span class="px-3 text-xs sm:text-sm font-semibold text-zinc-700 dark:text-zinc-300">
                {{ $currentPage }} / {{ $lastPage }}
            </span>

            <x-aura::icon-button variant="secondary" size="{{ $size }}" :shape="$shape" :disabled="$isLast" label="Next Page">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </x-aura::icon-button>
        </div>

    @elseif ($variant === 'pills')
        {{-- Circular Pill Button Bar with Alignment Support --}}
        <div class="flex items-center {{ $alignClasses }} w-full">
            <div class="flex items-center justify-center gap-1.5 p-1.5 rounded-full bg-zinc-100/90 dark:bg-zinc-800/90 border border-zinc-200 dark:border-zinc-700/80 inline-flex shadow-2xs">
                <x-aura::icon-button variant="ghost" size="sm" shape="circle" :disabled="$isFirst" label="Previous">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </x-aura::icon-button>

                @for ($i = 1; $i <= min($lastPage, 5); $i++)
                    @if ($i === $currentPage)
                        <span class="w-8 h-8 rounded-full bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white font-bold text-xs flex items-center justify-center shadow-xs border border-zinc-200 dark:border-zinc-700">
                            {{ $i }}
                        </span>
                    @else
                        <a href="#" class="w-8 h-8 rounded-full text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white font-medium text-xs flex items-center justify-center hover:bg-white/60 dark:hover:bg-zinc-700/50 transition-all">
                            {{ $i }}
                        </a>
                    @endif
                @endfor

                <x-aura::icon-button variant="ghost" size="sm" shape="circle" :disabled="$isLast" label="Next">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </x-aura::icon-button>
            </div>
        </div>

    @elseif ($variant === 'card' || $variant === 'bar')
        {{-- Footer Card Bar with Item Count & Numbered Buttons --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 p-4 rounded-xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 shadow-2xs w-full">
            <div class="text-xs sm:text-sm text-zinc-500 dark:text-zinc-400">
                @if ($total)
                    Showing <span class="font-bold text-zinc-900 dark:text-white">{{ $from }}</span> to <span class="font-bold text-zinc-900 dark:text-white">{{ $to }}</span> of <span class="font-bold text-zinc-900 dark:text-white">{{ $total }}</span> results
                @else
                    Page <span class="font-bold text-zinc-900 dark:text-white">{{ $currentPage }}</span> of <span class="font-bold text-zinc-900 dark:text-white">{{ $lastPage }}</span>
                @endif
            </div>

            <div class="flex items-center gap-1.5">
                <x-aura::icon-button variant="subtle" size="sm" :shape="$shape" :disabled="$isFirst" label="Previous">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                </x-aura::icon-button>

                @for ($i = $startPage; $i <= $endPage; $i++)
                    @if ($i === $currentPage)
                        <span class="{{ $activeBtnClass }}">{{ $i }}</span>
                    @else
                        <a href="#" class="{{ $inactiveBtnClass }}">{{ $i }}</a>
                    @endif
                @endfor

                <x-aura::icon-button variant="subtle" size="sm" :shape="$shape" :disabled="$isLast" label="Next">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </x-aura::icon-button>
            </div>
        </div>

    @else
        {{-- Numbered Pagination (Text or Icon-Only Previous/Next) --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 w-full">
            @if ($total)
                <div class="text-xs sm:text-sm text-zinc-500 dark:text-zinc-400">
                    Showing <span class="font-bold text-zinc-900 dark:text-white">{{ $from }}</span> to <span class="font-bold text-zinc-900 dark:text-white">{{ $to }}</span> of <span class="font-bold text-zinc-900 dark:text-white">{{ $total }}</span> items
                </div>
            @else
                <div></div>
            @endif

            <div class="flex items-center gap-1.5">
                {{-- Previous Button (Icon-Only or Text) --}}
                @if ($iconsOnly)
                    <x-aura::icon-button variant="secondary" size="sm" :shape="$shape" :disabled="$isFirst" label="Previous Page">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    </x-aura::icon-button>
                @else
                    <x-aura::button variant="secondary" size="sm" :disabled="$isFirst">
                        Previous
                    </x-aura::button>
                @endif

                {{-- First Page if window start > 1 --}}
                @if ($startPage > 1)
                    <a href="#" class="{{ $inactiveBtnClass }}">1</a>
                    @if ($startPage > 2)
                        <span class="px-1 text-xs text-zinc-400">...</span>
                    @endif
                @endif

                {{-- Page Window --}}
                @for ($i = $startPage; $i <= $endPage; $i++)
                    @if ($i === $currentPage)
                        <span class="{{ $activeBtnClass }}">{{ $i }}</span>
                    @else
                        <a href="#" class="{{ $inactiveBtnClass }}">{{ $i }}</a>
                    @endif
                @endfor

                {{-- Last Page if window end < lastPage --}}
                @if ($endPage < $lastPage)
                    @if ($endPage < $lastPage - 1)
                        <span class="px-1 text-xs text-zinc-400">...</span>
                    @endif
                    <a href="#" class="{{ $inactiveBtnClass }}">{{ $lastPage }}</a>
                @endif

                {{-- Next Button (Icon-Only or Text) --}}
                @if ($iconsOnly)
                    <x-aura::icon-button variant="secondary" size="sm" :shape="$shape" :disabled="$isLast" label="Next Page">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </x-aura::icon-button>
                @else
                    <x-aura::button variant="secondary" size="sm" :disabled="$isLast">
                        Next
                    </x-aura::button>
                @endif
            </div>
        </div>
    @endif
</nav>
