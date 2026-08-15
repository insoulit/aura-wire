@props([
    'title' => null,
])

<div class="space-y-1 py-1">
    @if ($title)
        <div class="px-3 py-1.5 text-[10px] font-bold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">
            {{ $title }}
        </div>
    @endif
    {{ $slot }}
</div>
