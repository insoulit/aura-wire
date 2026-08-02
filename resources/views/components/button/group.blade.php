@props([
    'vertical' => false,
])

@php
    $groupClasses = $vertical
        ? 'flex-col shadow-2xs [&>:first-child]:rounded-t-xl [&>:first-child]:rounded-b-none [&>:last-child]:rounded-b-xl [&>:last-child]:rounded-t-none [&>:not(:first-child):not(:last-child)]:rounded-none [&>:not(:first-child)]:-mt-px'
        : 'flex-row shadow-2xs [&>:first-child]:rounded-l-full [&>:first-child]:rounded-r-none [&>:last-child]:rounded-r-full [&>:last-child]:rounded-l-none [&>:not(:first-child):not(:last-child)]:rounded-none [&>:not(:first-child)]:-ml-px';
@endphp

<div {{ $attributes->merge(['class' => "inline-flex {$groupClasses}"]) }} role="group">
    {{ $slot }}
</div>
