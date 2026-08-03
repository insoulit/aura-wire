@props([
    'name' => 'sheet',
    'side' => 'right', // 'right' | 'left'
    'maxW' => 'max-w-xs',
])

@php
    $sideClasses = match ($side) {
        'left' => 'left-0 justify-start',
        'right' => 'right-0 justify-end',
        default => 'right-0 justify-end',
    };

    $borderSideClass = ($side === 'left') ? 'border-r' : 'border-l';
@endphp

<div
    x-data="{ open: false }"
    x-show="open"
    x-on:open-sheet.window="if ($event.detail === '{{ $name }}') open = true"
    x-on:close-sheet.window="if ($event.detail === '{{ $name }}') open = false"
    x-on:keydown.escape.window="open = false"
    class="fixed inset-0 z-50 flex {{ $sideClasses }}"
    style="display: none;"
    {{ $attributes }}
>
    {{-- Backdrop --}}
    <div
        x-show="open"
        x-transition:enter="transition-opacity ease-linear duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-zinc-900/60 backdrop-blur-xs"
        @click="open = false"
    ></div>

    {{-- Sheet Container --}}
    <div
        x-show="open"
        x-transition:enter="transition ease-in-out duration-300 transform"
        x-transition:enter-start="{{ $side === 'left' ? '-translate-x-full' : 'translate-x-full' }}"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in-out duration-300 transform"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="{{ $side === 'left' ? '-translate-x-full' : 'translate-x-full' }}"
        class="relative flex h-full w-full {{ $maxW }} flex-col overflow-y-auto bg-white dark:bg-zinc-900 shadow-2xl z-10 {{ $borderSideClass }} border-zinc-200 dark:border-zinc-800 p-6"
    >
        {{-- Close Button --}}
        <button
            type="button"
            @click="open = false"
            class="absolute top-4 right-4 p-2 rounded-lg text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors"
        >
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="mt-4 flex-1">
            {{ $slot }}
        </div>
    </div>
</div>
