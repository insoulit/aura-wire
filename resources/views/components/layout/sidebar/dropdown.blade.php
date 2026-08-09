@props([
    'label' => '',
    'icon' => null,
    'badge' => null,
    'open' => false,
    'active' => false,
])

<div x-data="{ open: @json($open || $active) }" class="space-y-1">
    <button
        type="button"
        x-on:click="open = !open"
        {{ $attributes->merge(['class' => 'flex items-center justify-between w-full px-3 py-2 text-sm rounded-md transition-all duration-150 cursor-pointer select-none group ' . ($active ? 'text-zinc-900 dark:text-white font-semibold' : 'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800/80 hover:text-zinc-900 dark:hover:text-white font-medium')]) }}
    >
        <div class="flex items-center gap-3 min-w-0">
            @if (isset($icon) && $icon)
                <span class="shrink-0 transition-colors {{ $active ? 'text-zinc-900 dark:text-white' : 'text-zinc-400 group-hover:text-zinc-700 dark:text-zinc-500 dark:group-hover:text-zinc-200' }}">
                    @if (is_string($icon))
                        <x-aura::icon :name="$icon" size="sm" />
                    @else
                        {{ $icon }}
                    @endif
                </span>
            @endif
            <span class="truncate">{{ $label }}</span>
        </div>

        <div class="flex items-center gap-2">
            @if ($badge)
                <span class="shrink-0 px-2 py-0.5 text-[10px] font-mono font-bold uppercase rounded-md bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400">
                    {{ $badge }}
                </span>
            @endif
            <svg
                class="w-4 h-4 shrink-0 transition-transform duration-200 text-zinc-400"
                :class="open ? 'rotate-90' : ''"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </div>
    </button>

    <div x-show="open" x-transition class="pl-4 space-y-1 border-l border-zinc-200 dark:border-zinc-800 ml-3 my-1">
        {{ $slot }}
    </div>
</div>
