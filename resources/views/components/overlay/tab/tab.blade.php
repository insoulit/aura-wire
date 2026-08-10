@props([
    'name' => '',
    'icon' => null,
])

<button
    type="button"
    x-on:click="activeTab = '{{ $name }}'"
    :class="activeTab === '{{ $name }}'
        ? 'border-zinc-900 text-zinc-900 dark:border-white dark:text-white font-bold'
        : 'border-transparent text-zinc-500 hover:text-zinc-700 hover:border-zinc-300 dark:text-zinc-400 dark:hover:text-zinc-200 font-medium'"
    {{ $attributes->merge(['class' => 'whitespace-nowrap py-3 px-1 border-b-2 text-sm transition-all flex items-center gap-2 cursor-pointer']) }}
>
    @if (isset($icon) && $icon)
        <span class="shrink-0">{{ $icon }}</span>
    @endif
    <span>{{ $slot }}</span>
</button>
