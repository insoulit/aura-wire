@props([
    'align' => 'right', // 'left', 'right', 'center'
    'width' => '64',
])

@php
    $alignmentClasses = match ($align) {
        'left' => 'left-0 origin-top-left',
        'center' => 'left-1/2 -translate-x-1/2 origin-top',
        default => 'right-0 origin-top-right',
    };

    $widthClass = match ($width) {
        '48' => 'w-48',
        '56' => 'w-56',
        '64' => 'w-64',
        '72' => 'w-72',
        '80' => 'w-80',
        '96' => 'w-96',
        default => 'w-64',
    };
@endphp

<div x-data="{ open: false }" @click.outside="open = false" @keydown.escape.window="open = false" :class="open ? 'relative inline-block text-left z-30' : 'relative inline-block text-left z-0'">
    <div @click="open = !open">
        {{ $trigger }}
    </div>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
        class="absolute {{ $alignmentClasses }} {{ $widthClass }} z-50 mt-2 rounded-xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 shadow-xl p-4 space-y-3"
        style="display: none;"
    >
        {{ $slot }}
    </div>
</div>
