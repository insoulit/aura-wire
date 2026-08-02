@props([
    'size' => 'sm',
])

@php
    $sizeClass = match ($size) {
        'xs' => 'w-3.5 h-3.5',
        'sm' => 'w-4 h-4',
        'md' => 'w-5 h-5',
        'lg' => 'w-6 h-6',
        default => 'w-4 h-4',
    };
@endphp

<svg {{ $attributes->merge(['class' => "{$sizeClass} inline-block shrink-0 cursor-pointer hover:opacity-80 transition-opacity"]) }} fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
</svg>
