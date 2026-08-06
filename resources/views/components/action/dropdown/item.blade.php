@props([
    'href' => null,
    'icon' => null,
    'variant' => 'default', // 'default', 'danger'
    'disabled' => false,
    'badge' => null,
])

@php
    $baseClasses = 'group flex items-center justify-between w-full px-3 py-2 text-xs font-medium rounded-lg transition-colors cursor-pointer select-none';

    $variantClasses = match ($variant) {
        'danger' => 'text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/40',
        default => 'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800/80 hover:text-zinc-900 dark:hover:text-white',
    };

    if ($disabled) {
        $variantClasses = 'text-zinc-400 dark:text-zinc-600 cursor-not-allowed opacity-60';
    }
@endphp

@if ($href && !$disabled)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => "{$baseClasses} {$variantClasses}"]) }}>
        <span class="flex items-center gap-2.5">
            @if ($icon)
                <x-aura::icon :name="$icon" size="xs" class="text-zinc-400 group-hover:text-zinc-600 dark:group-hover:text-zinc-200 transition-colors" />
            @endif
            <span>{{ $slot }}</span>
        </span>
        @if ($badge)
            <span class="text-[10px] font-mono px-1.5 py-0.5 rounded-md bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 font-semibold">{{ $badge }}</span>
        @endif
    </a>
@else
    <button type="button" @if($disabled) disabled @endif {{ $attributes->merge(['class' => "{$baseClasses} {$variantClasses}"]) }}>
        <span class="flex items-center gap-2.5">
            @if ($icon)
                <x-aura::icon :name="$icon" size="xs" class="text-zinc-400 group-hover:text-zinc-600 dark:group-hover:text-zinc-200 transition-colors" />
            @endif
            <span>{{ $slot }}</span>
        </span>
        @if ($badge)
            <span class="text-[10px] font-mono px-1.5 py-0.5 rounded-md bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 font-semibold">{{ $badge }}</span>
        @endif
    </button>
@endif
