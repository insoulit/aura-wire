@props([
    'required' => false,
    'size' => 'sm',
])

@php
    $sizeClasses = match ($size) {
        'xs' => 'text-xs',
        'md', 'lg' => 'text-base',
        default => 'text-sm',
    };
@endphp

<label {{ $attributes->merge(['class' => "block font-medium text-zinc-900 dark:text-zinc-100 tracking-tight select-none mb-1.5 pl-1 pr-0.5 {$sizeClasses}"]) }}>
    {{ $slot }}
    @if ($required)
        <span class="text-red-600 dark:text-red-500 font-bold ml-0.5">*</span>
    @endif
</label>
