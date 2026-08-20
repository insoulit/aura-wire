@props([
    'type' => 'bounce', // 'bounce', 'spin', 'ping', 'pulse', 'float', 'wiggle', 'spin-slow', 'bounce-slow', 'pulse-slow', 'throb', 'flip-x', 'flip-y', 'rotate-45', 'rotate-90', 'rotate-180', 'rotate-270', 'hover-spin', 'hover-bounce', 'hover-scale', 'hover-lift', 'hover-wiggle'
    'as' => 'div',
    'inline' => false,
])

@php
    $tag = $inline ? 'span' : $as;
    $displayClass = $inline ? 'inline-flex' : 'flex';

    $animateClass = match ($type) {
        // Continuous animations
        'bounce'       => 'animate-bounce',
        'bounce-slow'  => 'motion-safe:animate-[bounce_2s_infinite]',
        'float'        => 'motion-safe:animate-[float_3s_ease-in-out_infinite]',
        'spin'         => 'animate-spin',
        'spin-slow'    => 'motion-safe:animate-[spin_3s_linear_infinite]',
        'spin-reverse' => 'motion-safe:animate-[spin_1s_linear_infinite_reverse]',
        'pulse'        => 'animate-pulse',
        'pulse-slow'   => 'motion-safe:animate-[pulse_3s_cubic-bezier(0.4,0,0.6,1)_infinite]',
        'ping'         => 'animate-ping',
        'wiggle'       => 'motion-safe:animate-[wiggle_1s_ease-in-out_infinite]',
        'throb'        => 'motion-safe:animate-[pulse_1.5s_ease-in-out_infinite]',
        
        // Hover micro-interactions
        'hover-spin'   => 'transition-transform duration-300 hover:rotate-180',
        'hover-bounce' => 'transition-transform duration-200 hover:-translate-y-1',
        'hover-scale'  => 'transition-transform duration-200 hover:scale-110',
        'hover-lift'   => 'transition-transform duration-200 hover:-translate-y-1 hover:shadow-md',
        'hover-wiggle' => 'transition-transform duration-200 hover:rotate-6',
        
        // Transformations & Orientations
        'flip-x'       => '-scale-x-100',
        'flip-y'       => '-scale-y-100',
        'rotate-45'    => 'rotate-45',
        'rotate-90'    => 'rotate-90',
        'rotate-180'   => 'rotate-180',
        'rotate-270'   => 'rotate-270',

        default        => $type ? (str_starts_with($type, 'animate-') ? $type : "animate-{$type}") : '',
    };
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "{$displayClass} items-center justify-center shrink-0 {$animateClass}"]) }}>
    {{ $slot }}
</{{ $tag }}>
