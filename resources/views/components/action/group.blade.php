@props([
    'vertical' => false,
    'shape' => 'default', // 'default', 'compact', 'square', 'pill'
])

@php
    $radiusClasses = match ($shape) {
        'pill' => $vertical
            ? '[&>:first-child]:rounded-t-full [&>:first-child]:rounded-b-none [&>:last-child]:rounded-b-full [&>:last-child]:rounded-t-none'
            : '[&>:first-child]:rounded-l-full [&>:first-child]:rounded-r-none [&>:last-child]:rounded-r-full [&>:last-child]:rounded-l-none',
        'compact', 'square' => $vertical
            ? '[&>:first-child]:rounded-t-md [&>:first-child]:rounded-b-none [&>:last-child]:rounded-b-md [&>:last-child]:rounded-t-none'
            : '[&>:first-child]:rounded-l-md [&>:first-child]:rounded-r-none [&>:last-child]:rounded-r-md [&>:last-child]:rounded-l-none',
        default => $vertical
            ? '[&>:first-child]:rounded-t-lg [&>:first-child]:rounded-b-none [&>:last-child]:rounded-b-lg [&>:last-child]:rounded-t-none'
            : '[&>:first-child]:rounded-l-lg [&>:first-child]:rounded-r-none [&>:last-child]:rounded-r-lg [&>:last-child]:rounded-l-none',
    };

    $groupClasses = $vertical
        ? "flex-col {$radiusClasses} [&>:not(:first-child):not(:last-child)]:rounded-none [&>:not(:first-child)]:-mt-px [&>*]:focus:z-10 [&>*]:hover:z-10"
        : "flex-row {$radiusClasses} [&>:not(:first-child):not(:last-child)]:rounded-none [&>:not(:first-child)]:-ml-px [&>*]:focus:z-10 [&>*]:hover:z-10";
@endphp

<div {{ $attributes->merge(['class' => "inline-flex shadow-2xs {$groupClasses}"]) }} role="group">
    {{ $slot }}
</div>
