@props([
    'name' => null,
    'title' => null,
    'icon' => null,
    'size' => 'sm',
])

@php
    $itemId = $name ?? 'accordion-'.uniqid();

    $titleSizeClass = match ($size) {
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-base sm:text-lg',
        'xl' => 'text-lg sm:text-xl',
        default => 'text-sm',
    };
@endphp

<div {{ $attributes->merge(['class' => 'py-4 first:pt-0 last:pb-0']) }}>
    <button
        type="button"
        @click="toggle('{{ $itemId }}')"
        class="flex w-full items-center justify-between text-left {{ $titleSizeClass }} font-semibold text-zinc-900 dark:text-white hover:text-zinc-600 dark:hover:text-zinc-300 transition-colors cursor-pointer group"
    >
        <span class="flex items-center gap-3">
            @if ($icon)
                <div class="shrink-0 text-zinc-400 group-hover:text-zinc-600 dark:group-hover:text-zinc-300">
                    <x-aura::icon :name="$icon" size="sm" />
                </div>
            @endif
            <span>{{ $title ?? $slot }}</span>
        </span>

        <svg
            class="w-4 h-4 text-zinc-400 transition-transform duration-200"
            :class="{ 'rotate-180': isOpen('{{ $itemId }}') }"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
        >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div
        x-show="isOpen('{{ $itemId }}')"
        x-collapse
        style="display: none;"
    >
        <div class="pt-3 text-xs sm:text-sm text-zinc-600 dark:text-zinc-400 leading-relaxed text-pretty">
            {{ $title ? $slot : '' }}
        </div>
    </div>
</div>
