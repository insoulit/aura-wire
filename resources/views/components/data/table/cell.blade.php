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

<td {{ $attributes->merge(['class' => "px-4 py-3.5 align-middle text-sm text-zinc-900 dark:text-zinc-100 {$alignClass}"]) }}>
    {{ $slot }}
</td>
