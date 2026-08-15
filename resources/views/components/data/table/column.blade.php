@props([
    'align' => 'left', // 'left', 'center', 'right'
])

@php
    $alignClass = match ($align) {
        'center' => 'text-center',
        'right' => 'text-right',
        default => 'text-left',
    };
@endphp

<th {{ $attributes->merge(['class' => "px-4 py-3 text-xs font-bold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 {$alignClass}"]) }}>
    {{ $slot }}
</th>
