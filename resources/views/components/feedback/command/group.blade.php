@props([
    'title' => null,
])

<div class="space-y-1 py-1">
    @if ($title)
        <div class="px-3 py-1.5 text-xs font-bold font-mono uppercase tracking-wider text-zinc-400 dark:text-zinc-500 select-none">
            {{ $title }}
        </div>
    @endif
    {{ $slot }}
</div>
