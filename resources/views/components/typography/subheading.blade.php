@props([
    'as' => 'p',
    'size' => 'md', // 'sm', 'md', 'lg'
])

@php
    $sizeClasses = match ($size) {
        'sm' => 'text-xs sm:text-sm',
        'lg' => 'text-base sm:text-lg',
        default => 'text-sm sm:text-base',
    };
@endphp

<{{ $as }} {{ $attributes->merge(['class' => "{$sizeClasses} text-zinc-600 dark:text-zinc-400 font-normal leading-relaxed"]) }}>
    {{ $slot }}
</{{ $as }}>
