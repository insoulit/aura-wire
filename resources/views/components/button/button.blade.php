@props([
    'variant' => 'secondary',
    'size' => 'md',
    'type' => 'button',
    'href' => null,
    'icon' => null,
    'iconTrailing' => null,
    'square' => false,
    'disabled' => false,
    'loading' => null,
])

@php
    // Base interactive styles
    $baseClasses = 'inline-flex items-center justify-center font-medium transition-all duration-150 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:pointer-events-none aria-disabled:opacity-50 aria-disabled:pointer-events-none';

    // Variant classes
    $variantClasses = match ($variant) {
        'primary' => 'bg-zinc-900 text-white hover:bg-zinc-800 active:bg-zinc-950 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-100 dark:active:bg-zinc-200 shadow-sm border border-transparent',
        'secondary' => 'bg-white text-zinc-800 border border-zinc-300 hover:bg-zinc-50 active:bg-zinc-100 dark:bg-zinc-800 dark:text-zinc-200 dark:border-zinc-700 dark:hover:bg-zinc-700 dark:active:bg-zinc-800 shadow-sm',
        'filled', 'subtle' => 'bg-zinc-100 text-zinc-900 hover:bg-zinc-200 active:bg-zinc-300 dark:bg-zinc-800 dark:text-zinc-100 dark:hover:bg-zinc-700 dark:active:bg-zinc-600 border border-transparent',
        'outline' => 'bg-transparent text-zinc-700 border border-zinc-300 hover:bg-zinc-50 active:bg-zinc-100 dark:text-zinc-300 dark:border-zinc-700 dark:hover:bg-zinc-800 dark:active:bg-zinc-700',
        'ghost' => 'bg-transparent text-zinc-700 hover:bg-zinc-100 hover:text-zinc-900 active:bg-zinc-200 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white dark:active:bg-zinc-700 border border-transparent',
        'danger' => 'bg-red-600 text-white hover:bg-red-500 active:bg-red-700 dark:bg-red-600 dark:hover:bg-red-500 dark:active:bg-red-700 shadow-sm border border-transparent',
        'link' => 'bg-transparent text-indigo-600 hover:underline dark:text-indigo-400 border border-transparent p-0 focus-visible:ring-0',
        default => 'bg-white text-zinc-800 border border-zinc-300 hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-200 dark:border-zinc-700 shadow-sm',
    };

    // Size classes (normal vs square)
    $sizeClasses = match ($size) {
        'xs' => $square ? 'p-1 text-xs rounded' : 'px-2 py-1 text-xs gap-1 rounded-md',
        'sm' => $square ? 'p-1.5 text-xs rounded-md' : 'px-2.5 py-1.5 text-xs gap-1.5 rounded-md',
        'md' => $square ? 'p-2 text-sm rounded-lg' : 'px-3.5 py-2 text-sm gap-2 rounded-lg',
        'lg' => $square ? 'p-2.5 text-base rounded-lg' : 'px-4.5 py-2.5 text-base gap-2.5 rounded-lg',
        default => $square ? 'p-2 text-sm rounded-lg' : 'px-3.5 py-2 text-sm gap-2 rounded-lg',
    };

    $classes = "{$baseClasses} {$variantClasses} {$sizeClasses}";

    $tag = ($href || $attributes->has('href')) ? 'a' : 'button';

    // Safely get wire:click or wire target attribute
    $wireClick = $attributes->whereStartsWith('wire:click')->first();
    $wireTarget = is_string($loading) ? $loading : $wireClick;
@endphp


<{{ $tag }}
    @if ($tag === 'a')
        href="{{ $href ?? $attributes->get('href') }}"
    @else
        type="{{ $type }}"
        @if ($disabled || $loading === true) disabled @endif
    @endif
    {{ $attributes->merge(['class' => $classes]) }}
    @if ($wireTarget && $loading !== false)
        wire:loading.attr="disabled"
        wire:target="{{ $wireTarget }}"
    @endif
>
    {{-- Loading Spinner (if wire:target or loading state active) --}}
    @if ($wireTarget)
        <svg wire:loading wire:target="{{ $wireTarget }}" class="animate-spin -ml-1 mr-2 h-4 w-4 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    @endif

    {{-- Leading Icon --}}
    @if (isset($icon) && $icon)
        <span class="inline-flex shrink-0">
            {{ $icon }}
        </span>
    @endif

    {{-- Button Slot Content --}}
    @if ($slot->isNotEmpty())
        <span>{{ $slot }}</span>
    @endif

    {{-- Trailing Icon --}}
    @if (isset($iconTrailing) && $iconTrailing)
        <span class="inline-flex shrink-0">
            {{ $iconTrailing }}
        </span>
    @endif
</{{ $tag }}>
