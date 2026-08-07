@props([
    'href' => '#',
    'active' => false,
    'icon' => null,
    'variant' => 'default', // 'default', 'dark'
])

@php
    $activeClasses = match ($variant) {
        'dark' => $active
            ? 'text-white bg-zinc-800 font-semibold shadow-2xs'
            : 'text-zinc-400 hover:text-white hover:bg-zinc-900 font-medium border border-transparent',
        default => $active
            ? 'text-zinc-900 dark:text-white bg-zinc-900/10 dark:bg-white/15 font-semibold shadow-2xs'
            : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-900/5 dark:hover:bg-white/10 font-medium border border-transparent',
    };
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => "inline-flex items-center gap-2 px-3 py-1.5 text-xs sm:text-sm rounded-lg whitespace-nowrap transition-all duration-150 cursor-pointer select-none group {$activeClasses}"]) }}
>
    @if (isset($icon) && $icon)
        <span class="shrink-0 transition-colors {{ $active ? 'text-zinc-900 dark:text-white' : 'text-zinc-400 dark:text-zinc-500 group-hover:text-zinc-700 dark:group-hover:text-zinc-300' }}">
            @if (is_string($icon))
                <x-aura::icon :name="$icon" size="xs" />
            @else
                {{ $icon }}
            @endif
        </span>
    @endif
    <span>{{ $slot }}</span>
</a>
