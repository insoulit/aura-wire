@props([
    'inline' => false,
    'direction' => 'row', // 'row' | 'col' | 'column'
    'gap' => null,
    'as' => 'div',
])

@php
    $tag = $as;
    $displayClass = $inline ? 'inline-flex' : 'flex';
    $directionClass = in_array($direction, ['col', 'column']) ? 'flex-col' : 'flex-row';

    $gapClass = match ($gap) {
        'none', '0' => 'gap-0',
        'xs', '1' => 'gap-1',
        '1.5' => 'gap-1.5',
        'sm', '2' => 'gap-2',
        '3' => 'gap-3',
        'md', '4' => 'gap-4',
        '5' => 'gap-5',
        'lg', '6' => 'gap-6',
        'xl', '8' => 'gap-8',
        default => $gap ? "gap-{$gap}" : '',
    };
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "{$displayClass} {$directionClass} items-center justify-center {$gapClass}"]) }}>
    {{ $slot }}
</{{ $tag }}>
