@props([
    'name' => 'sheet',
    'side' => 'right', // 'right', 'left', 'top', 'bottom'
    'maxW' => null,
    'maxWidth' => 'sm',
    'title' => null,
    'description' => null,
    'closeable' => true,
])

@php
    $resolvedMaxW = $maxW ?? match ($maxWidth) {
        'xs' => 'max-w-xs',
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
        'full' => 'max-w-full',
        default => 'max-w-sm',
    };

    $containerClasses = match ($side) {
        'left' => 'inset-y-0 left-0 justify-start h-full',
        'right' => 'inset-y-0 right-0 justify-end h-full',
        'top' => 'inset-x-0 top-0 flex-col justify-start w-full',
        'bottom' => 'inset-x-0 bottom-0 flex-col justify-end w-full',
        default => 'inset-y-0 right-0 justify-end h-full',
    };

    $sheetBodyClasses = match ($side) {
        'top' => 'w-full max-h-[85vh] rounded-b-xl border-b',
        'bottom' => 'w-full max-h-[85vh] rounded-t-xl border-t',
        'left' => "h-full w-full {$resolvedMaxW} border-r",
        'right' => "h-full w-full {$resolvedMaxW} border-l",
        default => "h-full w-full {$resolvedMaxW} border-l",
    };

    $enterStartClass = match ($side) {
        'left' => '-translate-x-full',
        'right' => 'translate-x-full',
        'top' => '-translate-y-full',
        'bottom' => 'translate-y-full',
        default => 'translate-x-full',
    };

    $leaveEndClass = $enterStartClass;
@endphp

<div
    x-data="{ open: false }"
    x-on:open-sheet.window="if ($event.detail === '{{ $name }}') open = true"
    x-on:close-sheet.window="if ($event.detail === '{{ $name }}') open = false"
    x-on:keydown.escape.window="if ({{ $closeable ? 'true' : 'false' }}) open = false"
>
    <template x-teleport="body">
        <div
            x-show="open"
            class="fixed inset-0 z-50 flex {{ $containerClasses }}"
            style="display: none;"
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
                @if ($closeable) @click="open = false" @endif
            ></div>

            {{-- Sheet Content Panel --}}
            <div
                x-show="open"
                x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="{{ $enterStartClass }}"
                x-transition:enter-end="translate-x-0 translate-y-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0 translate-y-0"
                x-transition:leave-end="{{ $leaveEndClass }}"
                class="relative flex {{ $sheetBodyClasses }} flex-col overflow-y-auto bg-white dark:bg-zinc-900 shadow-2xl z-10 border-zinc-200 dark:border-zinc-800 p-6 space-y-4"
            >
                {{-- Header --}}
                @if ($title || isset($header) || $closeable)
                    <div class="flex items-start justify-between border-b border-zinc-100 dark:border-zinc-800 pb-3">
                        @if (isset($header))
                            {{ $header }}
                        @else
                            <div>
                                @if ($title)
                                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white tracking-tight">{{ $title }}</h3>
                                @endif
                                @if ($description)
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">{{ $description }}</p>
                                @endif
                            </div>
                        @endif

                        @if ($closeable)
                            <button
                                type="button"
                                @click="open = false"
                                class="p-1 rounded-xl text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors cursor-pointer"
                                aria-label="Close sheet"
                            >
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        @endif
                    </div>
                @endif

                {{-- Slot Body --}}
                <div class="flex-1 space-y-4 overflow-y-auto">
                    {{ $slot }}
                </div>

                {{-- Footer --}}
                @if (isset($footer))
                    <div class="pt-4 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-end gap-3">
                        {{ $footer }}
                    </div>
                @endif
            </div>
        </div>
    </template>
</div>
