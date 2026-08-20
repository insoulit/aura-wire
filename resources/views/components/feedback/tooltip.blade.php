@props([
    'text' => null,
    'position' => 'top', // 'top', 'bottom', 'left', 'right'
])

@php
    $transformClass = match ($position) {
        'bottom' => '-translate-x-1/2',
        'left' => '-translate-y-1/2 -translate-x-full',
        'right' => '-translate-y-1/2',
        default => '-translate-x-1/2 -translate-y-full',
    };
@endphp

<div 
    x-data="{ 
        show: false,
        top: 0,
        left: 0,
        calcPosition() {
            if (!this.$refs.trigger) return;
            const rect = this.$refs.trigger.getBoundingClientRect();
            @if ($position === 'bottom')
                this.top = rect.bottom + 6;
                this.left = rect.left + (rect.width / 2);
            @elseif ($position === 'right')
                this.top = rect.top + (rect.height / 2);
                this.left = rect.right + 6;
            @elseif ($position === 'left')
                this.top = rect.top + (rect.height / 2);
                this.left = rect.left - 6;
            @else
                this.top = rect.top - 6;
                this.left = rect.left + (rect.width / 2);
            @endif
        }
    }" 
    x-ref="trigger"
    @mouseenter="calcPosition(); show = true" 
    @mouseleave="show = false" 
    @focusin="calcPosition(); show = true" 
    @focusout="show = false" 
    @scroll.window.passive="if (show) calcPosition()" 
    @resize.window="if (show) calcPosition()" 
    class="relative inline-flex"
>
    <div {{ $attributes }}>
        {{ $slot }}
    </div>

    <template x-teleport="body">
        <div
            x-show="show"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            :style="`top: ${top}px; left: ${left}px;`"
            class="fixed z-[99999] pointer-events-none whitespace-nowrap rounded-lg bg-zinc-900 px-2.5 py-1 text-xs font-semibold text-white shadow-xl dark:bg-white dark:text-zinc-900 {{ $transformClass }}"
            style="display: none;"
        >
            {{ $text }}
        </div>
    </template>
</div>
