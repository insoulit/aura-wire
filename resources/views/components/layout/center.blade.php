@props([
    'inline' => false,
    'direction' => 'row', // 'row' | 'col' | 'column'
    'gap' => null,
    'screen' => false, // true | 'screen' | 'hero'
    'size' => null, // 'sm' | 'md' | 'lg' | 'xl' | '2xl' | '3xl' | '4xl' | '5xl' | '6xl' | '7xl' | 'full'
    'as' => 'div',
])

@php
    $tag = $as;
    $displayClass = $inline ? 'inline-flex' : 'flex w-full';
    $directionClass = in_array($direction, ['col', 'column']) ? 'flex-col' : 'flex-row';

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

    $sizeClass = match ($size) {
        'sm' => 'max-w-sm mx-auto',
        'md' => 'max-w-md mx-auto',
        'lg' => 'max-w-lg mx-auto',
        'xl' => 'max-w-xl mx-auto',
        '2xl' => 'max-w-2xl mx-auto',
        '3xl' => 'max-w-3xl mx-auto',
        '4xl' => 'max-w-4xl mx-auto',
        '5xl' => 'max-w-5xl mx-auto',
        '6xl' => 'max-w-6xl mx-auto',
        'full' => 'max-w-full',
        default => $size ? "max-w-{$size} mx-auto" : '',
    };

    $screenClass = match ($screen) {
        true, 'screen' => 'min-h-screen',
        'hero' => 'min-h-[calc(100vh-4rem)]',
        default => '',
    };
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "{$displayClass} {$directionClass} items-center justify-center {$gapClass} {$sizeClass} {$screenClass}"]) }}>
    {{ $slot }}
</{{ $tag }}>
