@props([
    'size' => '6xl', // 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl', 'full'
    'gap' => null,
    'padding' => true,
    'center' => false,
    'screen' => false, // true | 'screen' | 'hero'
    'as' => 'div',
])

@php
    $tag = $as;

    $isPadded = filter_var($padding, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? ($padding !== 'none' && $padding !== '0' && (bool) $padding);
    $hasCustomPadding = str_contains($attributes->get('class', ''), 'p-') || str_contains($attributes->get('class', ''), 'px-') || str_contains($attributes->get('class', ''), 'py-');
    $paddingClass = $hasCustomPadding ? '' : ($isPadded ? 'px-4 sm:px-6 lg:px-8 py-8' : '');

    $sizeClass = match ($size) {
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
        '3xl' => 'max-w-3xl',
        '4xl' => 'max-w-4xl',
        '5xl' => 'max-w-5xl',
        '6xl' => 'max-w-6xl',
        '7xl' => 'max-w-7xl',
        'full' => 'max-w-full',
        default => $size ? "max-w-{$size}" : 'max-w-6xl',
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

    $screenClass = match ($screen) {
        true, 'screen' => 'min-h-screen',
        'hero' => 'min-h-[calc(100vh-4rem)]',
        default => '',
    };

    $centerClass = $center ? 'items-center justify-center text-center' : '';
    $flexClass = ($gap !== null || $center) ? "flex flex-col {$gapClass} {$centerClass}" : '';
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "{$sizeClass} mx-auto {$paddingClass} w-full {$flexClass} {$screenClass}"]) }}>
    {{ $slot }}
</{{ $tag }}>
