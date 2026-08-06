@props([
    'align' => 'right', // 'left' | 'right'
    'width' => '56',
])

@php
    $alignmentClasses = match ($align) {
        'left' => 'left-0 origin-top-left',
        'right' => 'right-0 origin-top-right',
        default => 'right-0 origin-top-right',
    };

    $widthClass = match ($width) {
        '44' => 'w-44',
        '48' => 'w-48',
        '56' => 'w-56',
        '64' => 'w-64',
        '72' => 'w-72',
        default => 'w-56',
    };
@endphp

<div x-data="{ open: false }" x-on:click.outside="open = false" x-on:close.stop="open = false" class="relative inline-block text-left">
    <div x-on:click="open = ! open">
        {{ $trigger }}
    </div>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="transform opacity-0 scale-95 -translate-y-1"
        x-transition:enter-end="transform opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="transform opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="transform opacity-0 scale-95 -translate-y-1"
        class="absolute {{ $alignmentClasses }} {{ $widthClass }} z-50 mt-2 rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200/90 dark:border-zinc-800 shadow-xl p-1.5 space-y-0.5"
        style="display: none;"
    >
        {{ $slot }}
    </div>
</div>
