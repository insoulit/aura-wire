@props([
    'href' => null,
    'icon' => null,
    'danger' => false,
])

@php
    $tag = $href ? 'a' : 'button';

    $colorClasses = $danger
        ? 'text-red-600 hover:bg-red-50 dark:hover:bg-red-950/40 dark:text-red-400'
        : 'text-zinc-700 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-800/80';
@endphp

<{{ $tag }}
    @if ($href) href="{{ $href }}" @else type="button" @endif
    {{ $attributes->merge(['class' => "w-full text-left flex items-center gap-2.5 px-4 py-2 text-sm font-medium transition-colors cursor-pointer select-none {$colorClasses}"]) }}
>
    @if (isset($icon) && $icon)
        <span class="shrink-0 text-zinc-400 dark:text-zinc-500">{{ $icon }}</span>
    @endif
    <span>{{ $slot }}</span>
</{{ $tag }}>
