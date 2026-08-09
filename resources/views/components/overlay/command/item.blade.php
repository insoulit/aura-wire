@props([
    'icon' => null,
    'shortcut' => null,
    'href' => null,
])

@php
    $tag = $href ? 'a' : 'button';
@endphp

<{{ $tag }}
    @if ($href) href="{{ $href }}" @else type="button" @endif
    x-show="!search || $el.textContent.toLowerCase().includes(search.toLowerCase())"
    {{ $attributes->merge(['class' => 'flex items-center justify-between w-full px-3 py-2.5 rounded-xl text-xs font-medium text-zinc-900 dark:text-white hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-colors cursor-pointer group text-left']) }}
>
    <div class="flex items-center gap-2.5 min-w-0">
        @if ($icon)
            <x-aura::icon :name="$icon" size="xs" class="text-zinc-400 group-hover:text-zinc-900 dark:group-hover:text-white shrink-0 transition-colors" />
        @endif
        <span class="truncate">{{ $slot }}</span>
    </div>

    @if ($shortcut)
        <kbd class="hidden sm:inline-block px-1.5 py-0.5 text-[10px] font-mono font-semibold text-zinc-400 bg-zinc-100 dark:bg-zinc-800/80 rounded border border-zinc-200 dark:border-zinc-700/80 shrink-0">
            {{ $shortcut }}
        </kbd>
    @endif
</{{ $tag }}>
