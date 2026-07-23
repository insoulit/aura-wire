@props([
    'required' => false,
    'size' => 'sm',
])

@php
    $sizeClasses = match ($size) {
        'xs' => 'text-xs',
        'sm' => 'text-xs sm:text-sm',
        'md' => 'text-sm font-medium',
        default => 'text-xs sm:text-sm',
    };
@endphp

<label {{ $attributes->merge(['class' => "block font-medium text-zinc-900 dark:text-zinc-100 tracking-tight {$sizeClasses}"]) }}>
    {{ $slot }}
    @if ($required)
        <span class="text-red-600 dark:text-red-500 font-bold ml-0.5">*</span>
    @endif
</label>
