@props([
    'name' => 'modal',
    'title' => null,
    'description' => null,
    'maxWidth' => 'md',
    'variant' => 'default', // 'default', 'centered', 'danger', 'success', 'full'
    'icon' => null,
    'closeable' => true,
])

@php
    $maxWidthClass = match ($maxWidth) {
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
        '3xl' => 'sm:max-w-3xl',
        '4xl' => 'sm:max-w-4xl',
        '5xl' => 'sm:max-w-5xl',
        'full' => 'sm:max-w-[calc(100vw-2rem)] h-[calc(100vh-2rem)]',
        default => 'sm:max-w-md',
    };

    $isCentered = $variant === 'centered';
    $isDanger = $variant === 'danger' || $variant === 'destructive';
    $isSuccess = $variant === 'success';

    $iconBgClass = match (true) {
        $isDanger => 'bg-red-100 dark:bg-red-950/60 text-red-600 dark:text-red-400 border border-red-200 dark:border-red-800/60',
        $isSuccess => 'bg-emerald-100 dark:bg-emerald-950/60 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800/60',
        default => 'bg-zinc-100 dark:bg-zinc-800 text-zinc-900 dark:text-white border border-zinc-200 dark:border-zinc-700',
    };
@endphp

<div
    x-data="{ open: false }"
    x-on:open-modal.window="if ($event.detail === '{{ $name }}') open = true"
    x-on:close-modal.window="if ($event.detail === '{{ $name }}') open = false"
    x-on:keydown.escape.window="if ({{ $closeable ? 'true' : 'false' }}) open = false"
>
    <template x-teleport="body">
        <div
            x-show="open"
            class="relative z-50"
            style="display: none;"
        >
            {{-- Backdrop --}}
            <div
                x-show="open"
                x-transition:enter="ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/60 backdrop-blur-xs transition-opacity"
                @if ($closeable) x-on:click="open = false" @endif
            ></div>

            {{-- Dialog Container --}}
            <div class="fixed inset-0 z-10 p-4 sm:p-6 flex items-center justify-center pointer-events-none">
                <div
                    x-show="open"
                    x-transition:enter="ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="pointer-events-auto w-full {{ $maxWidthClass }} max-h-[90vh] overflow-y-auto bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-6 shadow-2xl space-y-5 transform transition-all {{ $isCentered ? 'text-center flex flex-col items-center' : 'text-left' }}"
                >
                    {{-- Header --}}
                    @if ($isCentered)
                        {{-- Centered Header Layout --}}
                        <div class="flex flex-col items-center text-center space-y-3 w-full relative">
                            @if ($closeable)
                                <button x-on:click="open = false" class="absolute top-0 right-0 text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200 p-1 rounded-xl hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors cursor-pointer">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </button>
                            @endif

                            @if ($icon || $isDanger || $isSuccess)
                                <div class="w-12 h-12 rounded-2xl {{ $iconBgClass }} flex items-center justify-center shrink-0 shadow-2xs">
                                    @if ($icon && is_string($icon) && view()->exists("aura::components.icon.{$icon}"))
                                        <x-dynamic-component :component="'aura::icon.'.$icon" size="md" />
                                    @elseif ($icon)
                                        {{ $icon }}
                                    @elseif ($isDanger)
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                    @elseif ($isSuccess)
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    @endif
                                </div>
                            @endif

                            @if ($title)
                                <h3 class="text-lg font-bold text-zinc-900 dark:text-white tracking-tight">{{ $title }}</h3>
                            @endif
                            @if ($description)
                                <p class="text-xs sm:text-sm text-zinc-500 dark:text-zinc-400 max-w-xs sm:max-w-sm leading-relaxed">{{ $description }}</p>
                            @endif
                        </div>
                    @else
                        {{-- Standard Left Header Layout --}}
                        @if ($title || isset($header) || $icon)
                            <div class="flex items-start justify-between border-b border-zinc-100 dark:border-zinc-800 pb-3.5">
                                @if (isset($header))
                                    {{ $header }}
                                @else
                                    <div class="flex items-center gap-3">
                                        @if ($icon || $isDanger || $isSuccess)
                                            <div class="w-10 h-10 rounded-xl {{ $iconBgClass }} flex items-center justify-center shrink-0 shadow-2xs">
                                                @if ($icon && is_string($icon) && view()->exists("aura::components.icon.{$icon}"))
                                                    <x-dynamic-component :component="'aura::icon.'.$icon" size="sm" />
                                                @elseif ($icon)
                                                    {{ $icon }}
                                                @elseif ($isDanger)
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                                @elseif ($isSuccess)
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                @endif
                                            </div>
                                        @endif

                                        <div>
                                            <h3 class="text-base sm:text-lg font-bold text-zinc-900 dark:text-white tracking-tight leading-snug">{{ $title }}</h3>
                                            @if ($description)
                                                <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">{{ $description }}</p>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                @if ($closeable)
                                    <button x-on:click="open = false" class="text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200 p-1 rounded-xl hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors cursor-pointer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                    </button>
                                @endif
                            </div>
                        @endif
                    @endif

                    {{-- Body Slot --}}
                    <div class="space-y-4 w-full">
                        {{ $slot }}
                    </div>

                    {{-- Footer Slot --}}
                    @if (isset($footer))
                        <div @class([
                            'pt-4 border-t border-zinc-100 dark:border-zinc-800 flex items-center gap-3 w-full',
                            'justify-center' => $isCentered,
                            'justify-end' => !$isCentered,
                        ])>
                            {{ $footer }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </template>
</div>
