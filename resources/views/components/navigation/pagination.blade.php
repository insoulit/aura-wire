@props([
    'page' => 1,
    'totalPages' => 10,
    'total' => null,
    'perPage' => 10,
    'variant' => 'numbers', // 'numbers', 'pills', 'simple', 'compact', 'card'
    'shape' => 'circle', // 'circle', 'square'
    'size' => 'md', // 'sm', 'md', 'lg'
    'iconsOnly' => true,
    'align' => 'center', // 'start', 'center', 'end', 'left', 'right'
    'paginator' => null,
    'wireSetPage' => 'setPage',
    'wirePreviousPage' => 'previousPage',
    'wireNextPage' => 'nextPage',
])

@php
    $currentPage = (int) ($page ?? 1);
    $lastPage = max(1, (int) ($totalPages ?? 10));
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
        default => 'w-8 h-8 text-xs font-semibold',
    };

    $radiusClass = ($shape === 'square') ? 'rounded-xl' : 'rounded-full';

    // Active button classes
    $activeBtnClass = "bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 shadow-xs {$radiusClass} {$btnSizeClasses} flex items-center justify-center transition-all shrink-0";
    $inactiveBtnClass = "bg-transparent hover:bg-zinc-100 dark:hover:bg-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors {$radiusClass} {$btnSizeClasses} flex items-center justify-center shrink-0";
@endphp

<nav role="navigation" aria-label="Pagination Navigation" {{ $attributes->merge(['class' => 'w-full']) }}>
    @if ($paginator && method_exists($paginator, 'links'))
        {{ $paginator->links() }}
    @elseif ($variant === 'simple')
        {{-- Simple Clean Text Previous / Next with Page Info --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-4 p-2 w-full">
            @if ($iconsOnly)
                <button type="button" @if($wirePreviousPage) wire:click="{{ $wirePreviousPage }}" @endif @disabled($isFirst) class="p-1.5 rounded-full text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800 disabled:opacity-40 disabled:cursor-not-allowed transition-colors shrink-0" aria-label="Previous Page">
                    <x-aura::icon name="chevron-left" size="xs" />
                </button>
            @else
                <x-aura::button variant="secondary" size="{{ $size === 'lg' ? 'md' : 'sm' }}" :disabled="$isFirst" wire:click="{{ $wirePreviousPage }}">
                    Previous
                </x-aura::button>
            @endif

            <span class="text-xs sm:text-sm font-medium text-zinc-600 dark:text-zinc-400 text-center">
                Page <span class="font-bold text-zinc-900 dark:text-white">{{ $currentPage }}</span> of <span class="font-bold text-zinc-900 dark:text-white">{{ $lastPage }}</span>
            </span>

            @if ($iconsOnly)
                <button type="button" @if($wireNextPage) wire:click="{{ $wireNextPage }}({{ $lastPage }})" @endif @disabled($isLast) class="p-1.5 rounded-full text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800 disabled:opacity-40 disabled:cursor-not-allowed transition-colors shrink-0" aria-label="Next Page">
                    <x-aura::icon name="chevron-right" size="xs" />
                </button>
            @else
                <x-aura::button variant="secondary" size="{{ $size === 'lg' ? 'md' : 'sm' }}" :disabled="$isLast" wire:click="{{ $wireNextPage }}({{ $lastPage }})">
                    Next
                </x-aura::button>
            @endif
        </div>

    @elseif ($variant === 'compact')
        {{-- Compact Icon Only Pagination --}}
        <div class="flex items-center {{ $alignClasses }} gap-2 w-full justify-center">
            <button type="button" @if($wirePreviousPage) wire:click="{{ $wirePreviousPage }}" @endif @disabled($isFirst) class="p-1.5 rounded-full text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800 disabled:opacity-40 disabled:cursor-not-allowed transition-colors shrink-0" aria-label="Previous Page">
                <x-aura::icon name="chevron-left" size="xs" />
            </button>

            <span class="px-3 text-xs sm:text-sm font-semibold text-zinc-700 dark:text-zinc-300">
                {{ $currentPage }} / {{ $lastPage }}
            </span>

            <button type="button" @if($wireNextPage) wire:click="{{ $wireNextPage }}({{ $lastPage }})" @endif @disabled($isLast) class="p-1.5 rounded-full text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800 disabled:opacity-40 disabled:cursor-not-allowed transition-colors shrink-0" aria-label="Next Page">
                <x-aura::icon name="chevron-right" size="xs" />
            </button>
        </div>

    @elseif ($variant === 'pills')
        {{-- Circular Pill Button Bar with Alignment Support --}}
        <div class="flex items-center {{ $alignClasses }} w-full justify-center">
            <div class="flex items-center justify-center flex-wrap gap-1.5 p-1.5 rounded-full bg-zinc-100/90 dark:bg-zinc-800/90 border border-zinc-200 dark:border-zinc-700/80 inline-flex shadow-2xs">
                <button type="button" @if($wirePreviousPage) wire:click="{{ $wirePreviousPage }}" @endif @disabled($isFirst) class="p-1 rounded-full text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white disabled:opacity-40 disabled:cursor-not-allowed transition-colors shrink-0" aria-label="Previous">
                    <x-aura::icon name="chevron-left" size="xs" />
                </button>

                @for ($i = 1; $i <= min($lastPage, 5); $i++)
                    <button type="button" @if($wireSetPage) wire:click="{{ $wireSetPage }}({{ $i }})" @endif class="w-8 h-8 rounded-full font-bold text-xs flex items-center justify-center transition-all shrink-0 {{ $i === $currentPage ? 'bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white shadow-xs border border-zinc-200 dark:border-zinc-700' : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-white/60 dark:hover:bg-zinc-700/50' }}">
                        {{ $i }}
                    </button>
                @endfor

                <button type="button" @if($wireNextPage) wire:click="{{ $wireNextPage }}({{ $lastPage }})" @endif @disabled($isLast) class="p-1 rounded-full text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white disabled:opacity-40 disabled:cursor-not-allowed transition-colors shrink-0" aria-label="Next">
                    <x-aura::icon name="chevron-right" size="xs" />
                </button>
            </div>
        </div>

    @else
        {{-- Numbered Pagination (Default) --}}
        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 sm:gap-4 w-full">
            @if ($total)
                <div class="text-xs sm:text-sm text-zinc-500 dark:text-zinc-400 text-center sm:text-left">
                    Showing <span class="font-bold text-zinc-900 dark:text-white">{{ $from }}</span> to <span class="font-bold text-zinc-900 dark:text-white">{{ $to }}</span> of <span class="font-bold text-zinc-900 dark:text-white">{{ $total }}</span> items
                </div>
            @else
                <div class="text-center sm:text-left">{{ $slot }}</div>
            @endif

            <div class="flex items-center justify-center flex-wrap gap-1 sm:gap-1.5">
                {{-- Previous Button --}}
                <button type="button" @if($wirePreviousPage) wire:click="{{ $wirePreviousPage }}" @endif @disabled($isFirst) class="p-1.5 rounded-full text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800 disabled:opacity-40 disabled:cursor-not-allowed transition-colors shrink-0" aria-label="Previous Page">
                    <x-aura::icon name="chevron-left" size="xs" />
                </button>

                {{-- First Page if window start > 1 --}}
                @if ($startPage > 1)
                    <button type="button" @if($wireSetPage) wire:click="{{ $wireSetPage }}(1)" @endif class="{{ $inactiveBtnClass }}">1</button>
                    @if ($startPage > 2)
                        <span class="px-0.5 text-xs text-zinc-400">...</span>
                    @endif
                @endif

                {{-- Page Window --}}
                @for ($i = $startPage; $i <= $endPage; $i++)
                    <button type="button" @if($wireSetPage) wire:click="{{ $wireSetPage }}({{ $i }})" @endif class="{{ $i === $currentPage ? $activeBtnClass : $inactiveBtnClass }}">
                        {{ $i }}
                    </button>
                @endfor

                {{-- Last Page if window end < lastPage --}}
                @if ($endPage < $lastPage)
                    @if ($endPage < $lastPage - 1)
                        <span class="px-0.5 text-xs text-zinc-400">...</span>
                    @endif
                    <button type="button" @if($wireSetPage) wire:click="{{ $wireSetPage }}({{ $lastPage }})" @endif class="{{ $inactiveBtnClass }}">{{ $lastPage }}</button>
                @endif

                {{-- Next Button --}}
                <button type="button" @if($wireNextPage) wire:click="{{ $wireNextPage }}({{ $lastPage }})" @endif @disabled($isLast) class="p-1.5 rounded-full text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800 disabled:opacity-40 disabled:cursor-not-allowed transition-colors shrink-0" aria-label="Next Page">
                    <x-aura::icon name="chevron-right" size="xs" />
                </button>
            </div>
        </div>
    @endif
</nav>
