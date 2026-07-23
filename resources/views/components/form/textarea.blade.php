@props([
    'rows' => 3,
    'invalid' => false,
])

@php
    $borderClasses = $invalid
        ? 'border-red-600 dark:border-red-500 focus:border-red-600 focus:ring-1 focus:ring-red-600'
        : 'border-zinc-300 dark:border-zinc-700 focus:border-zinc-900 dark:focus:border-zinc-100 focus:ring-1 focus:ring-zinc-900 dark:focus:ring-zinc-100';
@endphp

<textarea
    rows="{{ $rows }}"
    {{ $attributes->merge(['class' => "w-full bg-zinc-50 dark:bg-zinc-900/90 text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500 border rounded-md p-3 text-sm transition-all duration-150 shadow-2xs outline-none disabled:opacity-50 disabled:cursor-not-allowed {$borderClasses}"]) }}
>{{ $slot }}</textarea>
