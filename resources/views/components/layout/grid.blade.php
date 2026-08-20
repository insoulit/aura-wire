@props([
    'cols' => 1, // 1 | 2 | 3 | 4 | 5 | 6 | 7 | 8 | 9 | 10 | 11 | 12 | 'none'
    'sm' => null,
    'md' => null,
    'lg' => null,
    'xl' => null,
    '2xl' => null,
    'gap' => null, // 'none' | 'xs' | 'sm' | 'md' | 'lg' | 'xl' | '1' | '2' | '3' | '4' | '5' | '6' | '8' | '10' | '12'
    'gapX' => null,
    'gapY' => null,
    'align' => null, // 'start' | 'center' | 'end' | 'baseline' | 'stretch'
    'justify' => null, // 'start' | 'center' | 'end' | 'between' | 'around' | 'evenly'
    'inline' => false,
    'as' => 'div',
])

@php
    $tag = $as;

    $displayClass = $inline ? 'inline-grid' : 'grid';

    $colsClass = match ((string) $cols) {
        '1' => 'grid-cols-1',
        '2' => 'grid-cols-2',
        '3' => 'grid-cols-3',
        '4' => 'grid-cols-4',
        '5' => 'grid-cols-5',
        '6' => 'grid-cols-6',
        '7' => 'grid-cols-7',
        '8' => 'grid-cols-8',
        '9' => 'grid-cols-9',
        '10' => 'grid-cols-10',
        '11' => 'grid-cols-11',
        '12' => 'grid-cols-12',
        'none' => 'grid-cols-none',
        default => $cols ? "grid-cols-{$cols}" : 'grid-cols-1',
    };

    $smClass = match ((string) $sm) {
        '1' => 'sm:grid-cols-1',
        '2' => 'sm:grid-cols-2',
        '3' => 'sm:grid-cols-3',
        '4' => 'sm:grid-cols-4',
        '5' => 'sm:grid-cols-5',
        '6' => 'sm:grid-cols-6',
        '7' => 'sm:grid-cols-7',
        '8' => 'sm:grid-cols-8',
        '9' => 'sm:grid-cols-9',
        '10' => 'sm:grid-cols-10',
        '11' => 'sm:grid-cols-11',
        '12' => 'sm:grid-cols-12',
        default => $sm ? "sm:grid-cols-{$sm}" : '',
    };

    $mdClass = match ((string) $md) {
        '1' => 'md:grid-cols-1',
        '2' => 'md:grid-cols-2',
        '3' => 'md:grid-cols-3',
        '4' => 'md:grid-cols-4',
        '5' => 'md:grid-cols-5',
        '6' => 'md:grid-cols-6',
        '7' => 'md:grid-cols-7',
        '8' => 'md:grid-cols-8',
        '9' => 'md:grid-cols-9',
        '10' => 'md:grid-cols-10',
        '11' => 'md:grid-cols-11',
        '12' => 'md:grid-cols-12',
        default => $md ? "md:grid-cols-{$md}" : '',
    };

    $lgClass = match ((string) $lg) {
        '1' => 'lg:grid-cols-1',
        '2' => 'lg:grid-cols-2',
        '3' => 'lg:grid-cols-3',
        '4' => 'lg:grid-cols-4',
        '5' => 'lg:grid-cols-5',
        '6' => 'lg:grid-cols-6',
        '7' => 'lg:grid-cols-7',
        '8' => 'lg:grid-cols-8',
        '9' => 'lg:grid-cols-9',
        '10' => 'lg:grid-cols-10',
        '11' => 'lg:grid-cols-11',
        '12' => 'lg:grid-cols-12',
        default => $lg ? "lg:grid-cols-{$lg}" : '',
    };

    $xlClass = match ((string) $xl) {
        '1' => 'xl:grid-cols-1',
        '2' => 'xl:grid-cols-2',
        '3' => 'xl:grid-cols-3',
        '4' => 'xl:grid-cols-4',
        '5' => 'xl:grid-cols-5',
        '6' => 'xl:grid-cols-6',
        '7' => 'xl:grid-cols-7',
        '8' => 'xl:grid-cols-8',
        '9' => 'xl:grid-cols-9',
        '10' => 'xl:grid-cols-10',
        '11' => 'xl:grid-cols-11',
        '12' => 'xl:grid-cols-12',
        default => $xl ? "xl:grid-cols-{$xl}" : '',
    };

    $gapClass = match ($gap) {
        'none', '0' => 'gap-0',
        '0.5' => 'gap-0.5',
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
        '16' => 'gap-16',
        default => $gap ? "gap-{$gap}" : '',
    };

    $gapXClass = match ($gapX) {
        'none', '0' => 'gap-x-0',
        '0.5' => 'gap-x-0.5',
        'xs', '1' => 'gap-x-1',
        '1.5' => 'gap-x-1.5',
        'sm', '2' => 'gap-x-2',
        '3' => 'gap-x-3',
        'md', '4' => 'gap-x-4',
        '5' => 'gap-x-5',
        'lg', '6' => 'gap-x-6',
        'xl', '8' => 'gap-x-8',
        '10' => 'gap-x-10',
        '12' => 'gap-x-12',
        '16' => 'gap-x-16',
        default => $gapX ? "gap-x-{$gapX}" : '',
    };

    $gapYClass = match ($gapY) {
        'none', '0' => 'gap-y-0',
        '0.5' => 'gap-y-0.5',
        'xs', '1' => 'gap-y-1',
        '1.5' => 'gap-y-1.5',
        'sm', '2' => 'gap-y-2',
        '3' => 'gap-y-3',
        'md', '4' => 'gap-y-4',
        '5' => 'gap-y-5',
        'lg', '6' => 'gap-y-6',
        'xl', '8' => 'gap-y-8',
        '10' => 'gap-y-10',
        '12' => 'gap-y-12',
        '16' => 'gap-y-16',
        default => $gapY ? "gap-y-{$gapY}" : '',
    };

    $alignClass = match ($align) {
        'start' => 'items-start',
        'center' => 'items-center',
        'end' => 'items-end',
        'baseline' => 'items-baseline',
        'stretch' => 'items-stretch',
        default => '',
    };

    $justifyClass = match ($justify) {
        'start' => 'justify-start',
        'center' => 'justify-center',
        'end' => 'justify-end',
        'between' => 'justify-between',
        'around' => 'justify-around',
        'evenly' => 'justify-evenly',
        default => '',
    };
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "{$displayClass} {$colsClass} {$smClass} {$mdClass} {$lgClass} {$xlClass} {$gapClass} {$gapXClass} {$gapYClass} {$alignClass} {$justifyClass}"]) }}>
    {{ $slot }}
</{{ $tag }}>
