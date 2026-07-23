@props([
    'as' => 'div',
])

<{{ $as }} {{ $attributes->merge(['class' => 'text-[11px] font-bold font-mono uppercase tracking-widest text-zinc-500 dark:text-zinc-400 select-none']) }}>
    {{ $slot }}
</{{ $as }}>
