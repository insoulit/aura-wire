@props([
    'align' => 'right', // 'left' | 'right'
    'width' => '56',
])

@php
    $transformClass = match ($align) {
        'left' => '',
        default => '-translate-x-full',
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

<div 
    x-data="{ 
        open: false,
        top: 0,
        left: 0,
        calcPosition() {
            if (!this.$refs.trigger) return;
            const rect = this.$refs.trigger.getBoundingClientRect();
            this.top = rect.bottom + 6;
            @if ($align === 'left')
                this.left = rect.left;
            @else
                this.left = rect.right;
            @endif
        },
        toggle() {
            if (this.open) {
                this.open = false;
            } else {
                this.calcPosition();
                this.open = true;
            }
        }
    }" 
    @keydown.escape.window="open = false" 
    @scroll.window.passive="if (open) calcPosition()" 
    @resize.window="if (open) calcPosition()" 
    class="relative inline-block text-left"
>
    <div x-ref="trigger" @click="toggle()">
        {{ $trigger }}
    </div>

    <template x-teleport="body">
        <div
            x-show="open"
            @click.outside="if (!$refs.trigger || !$refs.trigger.contains($event.target)) open = false"
            @click="open = false"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 scale-95 -translate-y-1"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 -translate-y-1"
            :style="`top: ${top}px; left: ${left}px;`"
            class="fixed {{ $transformClass }} {{ $widthClass }} z-[99999] rounded-xl bg-white dark:bg-zinc-900 border border-zinc-200/90 dark:border-zinc-800 shadow-xl p-1.5 space-y-0.5"
            style="display: none;"
        >
            {{ $slot }}
        </div>
    </template>
</div>
