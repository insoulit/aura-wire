@props([
    'size' => '6xl', // 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl', 'full'
    'gap' => null,
    'stack' => false,
    'padding' => true,
])

@php
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
        'xs', '1' => 'gap-1',
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

    $stackClass = ($stack || $gap !== null) ? "flex flex-col {$gapClass}" : '';
@endphp

<div {{ $attributes->merge(['class' => "{$sizeClass} mx-auto {$paddingClass} w-full {$stackClass}"]) }}>
    {{ $slot }}
</div>
