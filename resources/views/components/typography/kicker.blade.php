@props([
    'as' => 'div',
])

<{{ $as }} {{ $attributes->merge(['class' => 'text-[11px] sm:text-xs font-bold font-sans uppercase tracking-widest text-zinc-600 dark:text-zinc-300 select-none']) }}>
    {{ $slot }}
</{{ $as }}>
