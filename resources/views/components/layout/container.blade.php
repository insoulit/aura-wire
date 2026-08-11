@props([
    'size' => '7xl', // 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl', 'full'
])

@php
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
        'full' => 'max-w-full',
        default => 'max-w-7xl',
    };
@endphp

<div {{ $attributes->merge(['class' => "{$sizeClass} mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full"]) }}>
    {{ $slot }}
</div>
