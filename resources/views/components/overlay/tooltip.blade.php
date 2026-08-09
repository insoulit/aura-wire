@props([
    'text' => null,
    'position' => 'top', // 'top', 'bottom', 'left', 'right'
])

@php
    $positionClasses = match ($position) {
        'bottom' => 'top-full mt-2 left-1/2 -translate-x-1/2',
        'left' => 'right-full mr-2 top-1/2 -translate-y-1/2',
        'right' => 'left-full ml-2 top-1/2 -translate-y-1/2',
        default => 'bottom-full mb-2 left-1/2 -translate-x-1/2',
    };
@endphp

<div x-data="{ show: false }" @mouseenter="show = true" @mouseleave="show = false" @focusin="show = true" @focusout="show = false" class="relative inline-block">
    <div {{ $attributes }}>
        {{ $slot }}
    </div>

    <div
        x-show="show"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute {{ $positionClasses }} z-50 whitespace-nowrap rounded-lg bg-zinc-900 px-2.5 py-1 text-xs font-semibold text-white shadow-md dark:bg-white dark:text-zinc-900 pointer-events-none"
        style="display: none;"
    >
        {{ $text }}
    </div>
</div>
