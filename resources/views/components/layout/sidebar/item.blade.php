@props([
    'href' => '#',
    'active' => false,
    'icon' => null,
    'badge' => null,
])

@php
    $activeClasses = $active
        ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 font-bold shadow-2xs'
        : 'text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800/80 hover:text-zinc-900 dark:hover:text-white font-medium';
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => "flex items-center justify-between px-3 py-2 text-sm rounded-md transition-all duration-150 cursor-pointer select-none group {$activeClasses}"]) }}
>
    <div class="flex items-center gap-3 min-w-0">
        @if (isset($icon) && $icon)
            <span class="shrink-0 transition-colors {{ $active ? 'text-current' : 'text-zinc-400 group-hover:text-zinc-700 dark:text-zinc-500 dark:group-hover:text-zinc-200' }}">
                @if (is_string($icon))
                    <x-aura::icon :name="$icon" size="sm" />
                @else
                    {{ $icon }}
                @endif
            </span>
        @endif
        <span class="truncate">{{ $slot }}</span>
    </div>

    @if ($badge)
        <span class="shrink-0 px-2 py-0.5 text-xs font-mono font-bold uppercase rounded-md {{ $active ? 'bg-white/20 text-white dark:bg-zinc-900/20 dark:text-zinc-900' : 'bg-zinc-100 text-zinc-600 dark:bg-zinc-800 dark:text-zinc-400' }}">
            {{ $badge }}
        </span>
    @endif
</a>
