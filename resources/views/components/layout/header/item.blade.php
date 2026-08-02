@props([
    'href' => '#',
    'active' => false,
    'icon' => null,
])

@php
    $activeClasses = $active
        ? 'text-white bg-zinc-900 dark:text-zinc-900 dark:bg-white font-bold shadow-xs'
        : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-100/80 dark:hover:bg-zinc-800/60 font-medium border border-transparent';
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => "inline-flex items-center gap-2 px-3.5 py-1.5 text-xs sm:text-sm rounded-full transition-all duration-200 cursor-pointer select-none group {$activeClasses}"]) }}
>
    @if (isset($icon) && $icon)
        <span class="shrink-0 transition-transform group-hover:scale-110 {{ $active ? 'text-white dark:text-zinc-900' : 'text-zinc-400 dark:text-zinc-500 group-hover:text-zinc-700 dark:group-hover:text-zinc-300' }}">{{ $icon }}</span>
    @endif
    <span>{{ $slot }}</span>
</a>
