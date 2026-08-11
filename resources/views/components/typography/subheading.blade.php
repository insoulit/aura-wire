@props([
    'as' => 'p',
    'size' => 'md', // 'sm', 'md', 'lg'
])

@php
    $sizeClasses = match ($size) {
        'sm' => 'text-xs sm:text-sm tracking-normal',
        'lg' => 'text-base sm:text-lg tracking-tight',
        default => 'text-sm sm:text-base tracking-normal',
    };
@endphp

<{{ $as }} {{ $attributes->merge(['class' => "{$sizeClasses} text-zinc-700 dark:text-zinc-300 font-normal leading-relaxed"]) }}>
    {{ $slot }}
</{{ $as }}>
