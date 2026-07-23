@props([
    'type' => 'text',
    'size' => 'md',
    'invalid' => false,
    'icon' => null,
    'iconTrailing' => null,
])

@php
    $sizeClasses = match ($size) {
        'sm' => 'py-1.5 px-3 text-xs rounded-md',
        'md' => 'py-2 px-3.5 text-sm rounded-md',
        'lg' => 'py-2.5 px-4 text-base rounded-lg',
        default => 'py-2 px-3.5 text-sm rounded-md',
    };

    $paddingLeft = (isset($icon) && $icon) ? 'pl-10' : '';
    $paddingRight = (isset($iconTrailing) && $iconTrailing) ? 'pr-10' : '';

    $borderClasses = $invalid
        ? 'border-red-600 dark:border-red-500 focus:border-red-600 focus:ring-1 focus:ring-red-600'
        : 'border-zinc-300 dark:border-zinc-700 focus:border-zinc-900 dark:focus:border-zinc-100 focus:ring-1 focus:ring-zinc-900 dark:focus:ring-zinc-100';
@endphp

<div class="relative flex items-center w-full">
    @if (isset($icon) && $icon)
        <div class="absolute left-3 inset-y-0 flex items-center justify-center pointer-events-none text-zinc-400 dark:text-zinc-500">
            {{ $icon }}
        </div>
    @endif

    <input
        type="{{ $type }}"
        {{ $attributes->merge(['class' => "w-full bg-zinc-50 dark:bg-zinc-900/90 text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500 border transition-all duration-150 shadow-2xs outline-none disabled:opacity-50 disabled:cursor-not-allowed {$sizeClasses} {$paddingLeft} {$paddingRight} {$borderClasses}"]) }}
    />

    @if (isset($iconTrailing) && $iconTrailing)
        <div class="absolute right-3 inset-y-0 flex items-center justify-center pointer-events-none text-zinc-400 dark:text-zinc-500">
            {{ $iconTrailing }}
        </div>
    @endif
</div>
