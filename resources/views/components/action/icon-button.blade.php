@props([
    'variant' => 'secondary',
    'size' => 'md',
    'shape' => 'circle',
    'type' => 'button',
    'href' => null,
    'icon' => null,
    'label' => null,
    'ariaLabel' => null,
    'disabled' => false,
    'loading' => null,
])

@php
    // Base interactive styles for Icon Button
    $baseClasses = 'inline-flex items-center justify-center font-medium cursor-pointer select-none transition-all duration-150 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:pointer-events-none aria-disabled:opacity-50 aria-disabled:pointer-events-none shrink-0';

    // Variant classes (Danger defaults to hover-red icon instead of solid red bg)
    $variantClasses = match ($variant) {
        'primary' => 'bg-zinc-900 text-white hover:bg-zinc-800 active:bg-zinc-950 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-100 dark:active:bg-zinc-200 shadow-xs border border-transparent',
        'secondary' => 'bg-white text-zinc-800 border border-zinc-300 hover:bg-zinc-50 active:bg-zinc-100 dark:bg-zinc-800 dark:text-zinc-200 dark:border-zinc-700 dark:hover:bg-zinc-700 dark:active:bg-zinc-800 shadow-xs',
        'filled', 'subtle' => 'bg-zinc-100 text-zinc-900 hover:bg-zinc-200 active:bg-zinc-300 dark:bg-zinc-800 dark:text-zinc-100 dark:hover:bg-zinc-700 dark:active:bg-zinc-600 border border-transparent',
        'outline' => 'bg-transparent text-zinc-700 border border-zinc-300 hover:bg-zinc-50 active:bg-zinc-100 dark:text-zinc-300 dark:border-zinc-700 dark:hover:bg-zinc-800 dark:active:bg-zinc-700',
        'ghost' => 'bg-transparent text-zinc-700 hover:bg-zinc-100 hover:text-zinc-900 active:bg-zinc-200 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white dark:active:bg-zinc-700 border border-transparent',
        'danger', 'danger-ghost', 'ghost-danger' => 'bg-transparent text-zinc-600 hover:text-red-600 hover:bg-red-50 active:bg-red-100 dark:text-zinc-400 dark:hover:text-red-400 dark:hover:bg-red-950/40 dark:active:bg-red-900/50 border border-transparent',
        'danger-subtle', 'subtle-danger' => 'bg-zinc-100 text-zinc-700 hover:bg-red-50 hover:text-red-600 active:bg-red-100 dark:bg-zinc-800 dark:text-zinc-300 dark:hover:bg-red-950/50 dark:hover:text-red-400 border border-transparent',
        'danger-solid', 'solid-danger' => 'bg-red-600 text-white hover:bg-red-500 active:bg-red-700 dark:bg-red-600 dark:hover:bg-red-500 dark:active:bg-red-700 shadow-xs border border-transparent',
        'link' => 'bg-transparent text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 border border-transparent p-0 focus-visible:ring-0',
        default => 'bg-white text-zinc-800 border border-zinc-300 hover:bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-200 dark:border-zinc-700 shadow-xs',
    };

    // Shape radius
    $isSquare = in_array($shape, ['square', 'rounded', 'rect']);
    
    // Size classes (sleek tighter border-radius for square/rectangular buttons)
    $sizeClasses = match ($size) {
        'xs' => $isSquare ? 'w-7 h-7 p-0 rounded-md' : 'w-7 h-7 p-0 rounded-full',
        'sm' => $isSquare ? 'w-8 h-8 p-0 rounded-md' : 'w-8 h-8 p-0 rounded-full',
        'md' => $isSquare ? 'w-9 h-9 p-0 rounded-lg' : 'w-9 h-9 p-0 rounded-full',
        'lg' => $isSquare ? 'w-10 h-10 p-0 rounded-lg' : 'w-10 h-10 p-0 rounded-full',
        'xl' => $isSquare ? 'w-12 h-12 p-0 rounded-xl' : 'w-12 h-12 p-0 rounded-full',
        default => $isSquare ? 'w-9 h-9 p-0 rounded-lg' : 'w-9 h-9 p-0 rounded-full',
    };

    // Proportional icon size matching button scale
    $iconSize = match ($size) {
        'xs' => 'xs', // 14px in 28px button
        'sm' => 'sm', // 16px in 32px button
        'md' => 'sm', // 16px in 36px button
        'lg' => 'md', // 20px in 40px button
        'xl' => 'lg', // 24px in 48px button
        default => 'sm',
    };

    $classes = "{$baseClasses} {$variantClasses} {$sizeClasses}";

    $tag = ($href || $attributes->has('href')) ? 'a' : 'button';

    // Accessibility label
    $accessibleLabel = $label ?? $ariaLabel;

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
    @if ($accessibleLabel && !$attributes->has('aria-label'))
        aria-label="{{ $accessibleLabel }}"
        title="{{ $accessibleLabel }}"
    @endif
    {{ $attributes->merge(['class' => $classes]) }}
    @if ($wireTarget && $loading !== false)
        wire:loading.attr="disabled"
        wire:target="{{ $wireTarget }}"
    @endif
>
    {{-- Loading Spinner --}}
    @if ($wireTarget)
        <svg wire:loading wire:target="{{ $wireTarget }}" class="animate-spin h-4 w-4 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
    @endif

    {{-- Content / Icon --}}
    <span @if($wireTarget) wire:loading.remove wire:target="{{ $wireTarget }}" @endif class="inline-flex items-center justify-center shrink-0">
        @if (is_string($icon) && !empty($icon))
            <x-aura::icon :name="$icon" :size="$iconSize" />
        @elseif (isset($icon) && $icon)
            {{ $icon }}
        @else
            {{ $slot }}
        @endif
    </span>
</{{ $tag }}>
