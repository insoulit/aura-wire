@props([
    'direction' => 'col', // 'col' | 'row'
    'align' => 'stretch', // 'start' | 'center' | 'end' | 'stretch'
    'justify' => 'start', // 'start' | 'center' | 'end' | 'between'
    'gap' => 'md', // 'none' | 'xs' | 'sm' | 'md' | 'lg' | 'xl' | '1' | '2' | '3' | '4' | '5' | '6' | '8'
    'as' => 'div',
])

@php
    $tag = $as;
    $directionClass = in_array($direction, ['row', 'horizontal']) ? 'flex flex-row' : 'flex flex-col';

    $alignClass = match ($align) {
        'start' => 'items-start',
        'center' => 'items-center',
        'end' => 'items-end',
        'stretch' => 'items-stretch',
        default => 'items-stretch',
    };

    $justifyClass = match ($justify) {
        'start' => 'justify-start',
        'center' => 'justify-center',
        'end' => 'justify-end',
        'between' => 'justify-between',
        default => 'justify-start',
    };

    $gapClass = match ($gap) {
        'none', '0' => 'gap-0',
        'xs', '1' => 'gap-1',
        'sm', '2' => 'gap-2',
        '3' => 'gap-3',
        'md', '4' => 'gap-4',
        '5' => 'gap-5',
        'lg', '6' => 'gap-6',
        'xl', '8' => 'gap-8',
        default => $gap ? "gap-{$gap}" : 'gap-4',
    };
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "{$directionClass} {$alignClass} {$justifyClass} {$gapClass}"]) }}>
    {{ $slot }}
</{{ $tag }}>
