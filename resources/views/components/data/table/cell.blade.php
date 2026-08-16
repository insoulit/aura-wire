@props([
    'align' => 'left', // 'left', 'center', 'right'
    'nowrap' => false,
    'truncate' => false,
])

@php
    $alignClass = match ($align) {
        'center' => 'text-center',
        'right' => 'text-right',
        default => 'text-left',
    };
    $nowrapClass = filter_var($nowrap, FILTER_VALIDATE_BOOLEAN) ? ' whitespace-nowrap' : '';
    $truncateClass = filter_var($truncate, FILTER_VALIDATE_BOOLEAN) ? ' truncate max-w-md' : '';
@endphp

<td {{ $attributes->merge(['class' => "px-4 py-3.5 align-middle text-sm text-zinc-900 dark:text-zinc-100 {$alignClass}{$nowrapClass}{$truncateClass}"]) }}>
    {{ $slot }}
</td>
