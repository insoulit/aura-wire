@props([
    'as' => 'p',
])

<{{ $as }} {{ $attributes->merge(['class' => 'text-base sm:text-lg text-zinc-600 dark:text-zinc-400 font-normal leading-relaxed']) }}>
    {{ $slot }}
</{{ $as }}>
