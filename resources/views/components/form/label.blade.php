@props([
    'required' => false,
    'size' => 'sm', // 'xs' | 'sm' | 'md' | 'lg'
    'weight' => 'medium', // 'normal' | 'medium' | 'semibold' | 'bold'
])

@php
    $sizeClasses = match ($size) {
        'xs' => 'text-xs',
        'lg' => 'text-base',
        default => 'text-sm',
    };

    $weightClasses = match ($weight) {
        'normal' => 'font-normal',
        'semibold' => 'font-semibold',
        'bold' => 'font-bold',
        default => 'font-medium',
    };
@endphp

<label {{ $attributes->merge(['class' => "block text-zinc-900 dark:text-zinc-100 tracking-tight select-none mb-1.5 pl-1 pr-0.5 {$sizeClasses} {$weightClasses}"]) }}>
    {{ $slot }}
    @if ($required)
        <span class="text-red-600 dark:text-red-500 font-bold ml-0.5" aria-hidden="true">*</span>
    @endif
</label>
