@props([
    'type' => 'bounce',
    'as' => 'div',
    'inline' => false,
])

@php
    $tag = $inline ? 'span' : $as;
    $displayClass = $inline ? 'inline-flex' : 'flex';

    $animateClass = match ($type) {
        // Continuous Loop Animations (Zero-Config Core Tailwind)
        'bounce'            => 'animate-bounce',
        'spin'              => 'animate-spin',
        'pulse'             => 'animate-pulse',
        'ping'              => 'animate-ping',
        
        // Hover Micro-Interactions (Zero-Config Core Tailwind Transitions)
        'hover-scale'       => 'transition-transform duration-200 hover:scale-110',
        'hover-scale-sm'    => 'transition-transform duration-200 hover:scale-105',
        'hover-scale-lg'    => 'transition-transform duration-200 hover:scale-125',
        'hover-shrink'      => 'transition-transform duration-200 hover:scale-95',
        'hover-lift'        => 'transition-all duration-200 hover:-translate-y-1 hover:shadow-md',
        'hover-bounce'      => 'transition-transform duration-200 hover:-translate-y-1',
        'hover-bounce-deep' => 'transition-transform duration-200 hover:-translate-y-2',
        'hover-spin'        => 'transition-transform duration-300 hover:rotate-180',
        'hover-wiggle'      => 'transition-transform duration-200 hover:rotate-12',
        'hover-tilt-left'   => 'transition-transform duration-200 hover:-rotate-12',
        'hover-tilt-right'  => 'transition-transform duration-200 hover:rotate-12',
        'hover-glow'        => 'transition-all duration-200 hover:brightness-125 hover:drop-shadow-md',
        'hover-fade'        => 'transition-opacity duration-200 hover:opacity-75',

        // Hover Rotations & Directional Flips
        'hover-rotate-45'   => 'transition-transform duration-300 hover:rotate-45',
        'hover-rotate-90'   => 'transition-transform duration-300 hover:rotate-90',
        'hover-rotate-180'  => 'transition-transform duration-300 hover:rotate-180',
        'hover-rotate-270'  => 'transition-transform duration-300 hover:-rotate-90',
        'hover-flip-x'      => 'transition-transform duration-300 hover:-scale-x-100',
        'hover-flip-y'      => 'transition-transform duration-300 hover:-scale-y-100',

        // Active / Press Interactions
        'active-press'      => 'transition-transform duration-100 active:scale-95',
        'active-sink'       => 'transition-transform duration-100 active:translate-y-0.5',
        'active-bounce'     => 'transition-transform duration-100 active:scale-90',

        // Orientations & Static Transforms
        'flip-x'            => '-scale-x-100',
        'flip-y'            => '-scale-y-100',
        'rotate-45'         => 'rotate-45',
        'rotate-90'         => 'rotate-90',
        'rotate-180'        => 'rotate-180',
        'rotate-270'        => '-rotate-90',

        default             => $type ? (str_starts_with($type, 'animate-') ? $type : "animate-{$type}") : '',
    };
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "{$displayClass} items-center justify-center shrink-0 {$animateClass}"]) }}>
    {{ $slot }}
</{{ $tag }}>
