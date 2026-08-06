@props([
    'size' => 'md', // 'xs', 'sm', 'md', 'lg', 'xl'
    'variant' => 'default', // 'default', 'primary', 'success', 'warning', 'danger', 'white'
    'type' => 'ring', // 'ring', 'dots', 'bars', 'ping'
])

@php
    $sizeClasses = match ($size) {
        'xs' => 'h-3.5 w-3.5',
        'sm' => 'h-4.5 w-4.5',
        'md' => 'h-6 w-6',
        'lg' => 'h-8 w-8',
        'xl' => 'h-11 w-11',
        default => 'h-6 w-6',
    };

    $colorClasses = match ($variant) {
        'white' => 'text-white',
        'primary' => 'text-indigo-600 dark:text-indigo-400',
        'success' => 'text-emerald-600 dark:text-emerald-400',
        'warning' => 'text-amber-500 dark:text-amber-400',
        'danger' => 'text-red-600 dark:text-red-400',
        default => 'text-zinc-900 dark:text-white',
    };

    $bgColorClasses = match ($variant) {
        'white' => 'bg-white',
        'primary' => 'bg-indigo-600 dark:bg-indigo-400',
        'success' => 'bg-emerald-600 dark:bg-emerald-400',
        'warning' => 'bg-amber-500 dark:bg-amber-400',
        'danger' => 'bg-red-600 dark:bg-red-400',
        default => 'bg-zinc-900 dark:bg-white',
    };

    $dotSize = match ($size) {
        'xs' => 'w-1 h-1',
        'sm' => 'w-1.5 h-1.5',
        'lg' => 'w-2.5 h-2.5',
        'xl' => 'w-3 h-3',
        default => 'w-2 h-2',
    };
@endphp

@if ($type === 'dots')
    {{-- 3-Dot Bouncing Pulse Loader --}}
    <div {{ $attributes->merge(['class' => "inline-flex items-center gap-1 shrink-0 {$colorClasses}"]) }}>
        <span class="{{ $dotSize }} rounded-full {{ $bgColorClasses }} animate-bounce [animation-delay:-0.3s]"></span>
        <span class="{{ $dotSize }} rounded-full {{ $bgColorClasses }} animate-bounce [animation-delay:-0.15s]"></span>
        <span class="{{ $dotSize }} rounded-full {{ $bgColorClasses }} animate-bounce"></span>
    </div>

@elseif ($type === 'bars')
    {{-- Equalizer Pulsating Bars --}}
    <div {{ $attributes->merge(['class' => "inline-flex items-end gap-1 h-5 shrink-0 {$colorClasses}"]) }}>
        <span class="w-1 h-full {{ $bgColorClasses }} rounded-full animate-pulse"></span>
        <span class="w-1 h-2/3 {{ $bgColorClasses }} rounded-full animate-pulse [animation-delay:200ms]"></span>
        <span class="w-1 h-full {{ $bgColorClasses }} rounded-full animate-pulse [animation-delay:400ms]"></span>
    </div>

@elseif ($type === 'ping')
    {{-- Radar Ping Pulse Circle --}}
    <div {{ $attributes->merge(['class' => "relative inline-flex items-center justify-center shrink-0 {$sizeClasses}"]) }}>
        <span class="absolute inset-0 rounded-full {{ $bgColorClasses }} opacity-75 animate-ping"></span>
        <span class="relative rounded-full h-2 w-2 {{ $bgColorClasses }}"></span>
    </div>

@else
    {{-- Circular Ring Spinner (Default) --}}
    <svg
        {{ $attributes->merge(['class' => "animate-spin shrink-0 {$sizeClasses} {$colorClasses}"]) }}
        xmlns="http://www.w3.org/2000/svg"
        fill="none"
        viewBox="0 0 24 24"
    >
        <circle
            class="opacity-25"
            cx="12"
            cy="12"
            r="10"
            stroke="currentColor"
            stroke-width="4"
        ></circle>
        <path
            class="opacity-75"
            fill="currentColor"
            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
        ></path>
    </svg>
@endif
