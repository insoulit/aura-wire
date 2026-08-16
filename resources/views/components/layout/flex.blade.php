@props([
    'direction' => 'row', // 'row' | 'col' | 'column' | 'row-reverse' | 'col-reverse'
    'align' => 'center', // 'start' | 'center' | 'end' | 'baseline' | 'stretch'
    'justify' => 'start', // 'start' | 'center' | 'end' | 'between' | 'around' | 'evenly'
    'gap' => null, // 'none' | 'xs' | 'sm' | 'md' | 'lg' | 'xl' | '1' | '2' | '3' | '4' | '5' | '6' | '8' | '10'
    'wrap' => false,
    'inline' => false,
    'as' => 'div',
])

@php
    $tag = $as;

    $displayClass = $inline ? 'inline-flex' : 'flex';

    $directionClass = match ($direction) {
        'col', 'column' => 'flex-col',
        'row-reverse' => 'flex-row-reverse',
        'col-reverse', 'column-reverse' => 'flex-col-reverse',
        default => 'flex-row',
    };

    $alignClass = match ($align) {
        'start' => 'items-start',
        'center' => 'items-center',
        'end' => 'items-end',
        'baseline' => 'items-baseline',
        'stretch' => 'items-stretch',
        default => 'items-center',
    };

    $justifyClass = match ($justify) {
        'start' => 'justify-start',
        'center' => 'justify-center',
        'end' => 'justify-end',
        'between' => 'justify-between',
        'around' => 'justify-around',
        'evenly' => 'justify-evenly',
        default => 'justify-start',
    };

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
        '10' => 'gap-10',
        '12' => 'gap-12',
        default => $gap ? "gap-{$gap}" : '',
    };

    $wrapClass = $wrap ? 'flex-wrap' : '';
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "{$displayClass} {$directionClass} {$alignClass} {$justifyClass} {$gapClass} {$wrapClass}"]) }}>
    {{ $slot }}
</{{ $tag }}>
