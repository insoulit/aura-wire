@props([
    'as' => 'div',
])

<{{ $as }} {{ $attributes->merge(['class' => 'text-xs font-bold font-mono uppercase tracking-widest text-zinc-500 dark:text-zinc-400 select-none']) }}>
    {{ $slot }}
</{{ $as }}>
