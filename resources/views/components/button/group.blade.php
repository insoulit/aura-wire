@props([
    'vertical' => false,
])

@php
    $orientation = $vertical ? 'flex-col shadow-sm' : 'flex-row shadow-sm';
@endphp

<div {{ $attributes->merge(['class' => "inline-flex rounded-lg {$orientation} [&>:first-child]:rounded-r-none [&>:last-child]:rounded-l-none [&>:not(:first-child):not(:last-child)]:rounded-none [&>:not(:first-child)]:-ml-px"]) }} role="group">
    {{ $slot }}
</div>
