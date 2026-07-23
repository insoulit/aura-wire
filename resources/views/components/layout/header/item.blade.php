@props([
    'href' => '#',
    'active' => false,
    'icon' => null,
])

@php
    $activeClasses = $active
        ? 'text-zinc-900 dark:text-white font-bold bg-zinc-100 dark:bg-zinc-800/80'
        : 'text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-50 dark:hover:bg-zinc-800/50 font-medium';
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => "inline-flex items-center gap-2 px-3 py-2 text-sm rounded-lg transition-colors cursor-pointer select-none {$activeClasses}"]) }}
>
    @if (isset($icon) && $icon)
        <span class="shrink-0 text-zinc-400 dark:text-zinc-500">{{ $icon }}</span>
    @endif
    <span>{{ $slot }}</span>
</a>
