@props([
    'href' => '#',
    'active' => false,
    'icon' => null,
    'variant' => 'outline', // 'outline', 'ghost', 'default'
])

@php
    $buttonClasses = match ($variant) {
        'ghost' => $active
            ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 font-semibold shadow-2xs border border-transparent'
            : 'bg-transparent text-zinc-700 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-300 dark:hover:bg-zinc-800 dark:hover:text-white font-medium border border-transparent',
        default => $active
            ? 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 font-semibold shadow-2xs border border-transparent'
            : 'bg-white text-zinc-700 border border-zinc-300/80 hover:bg-zinc-50 hover:text-zinc-900 dark:bg-zinc-900 dark:text-zinc-300 dark:border-zinc-800 dark:hover:bg-zinc-800 dark:hover:text-white font-medium shadow-2xs',
    };
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => "inline-flex items-center gap-2.5 px-3.5 h-10 md:h-9 text-sm rounded-lg whitespace-nowrap transition-all duration-150 cursor-pointer select-none group {$buttonClasses}"]) }}
>
    @if (isset($icon) && $icon)
        <span class="shrink-0 transition-colors {{ $active ? 'text-current' : 'text-zinc-700 dark:text-zinc-200 group-hover:text-zinc-900 dark:group-hover:text-white' }}">
            @if (is_string($icon))
                <x-aura::icon :name="$icon" size="sm" />
            @else
                {{ $icon }}
            @endif
        </span>
    @endif
    <span>{{ $slot }}</span>
</a>
