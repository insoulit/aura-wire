@props([
    'src' => null,
    'alt' => '',
    'initials' => null,
    'size' => 'md',
    'square' => false,
    'status' => null, // 'online' | 'offline' | 'busy' | 'away'
])

@php
    $sizeClasses = match ($size) {
        'xs' => 'w-6 h-6 text-[10px]',
        'sm' => 'w-8 h-8 text-xs',
        'md' => 'w-10 h-10 text-sm',
        'lg' => 'w-12 h-12 text-base',
        'xl' => 'w-16 h-16 text-lg',
        default => 'w-10 h-10 text-sm',
    };

    $shapeClasses = $square ? 'rounded-md' : 'rounded-full';

    $statusColor = match ($status) {
        'online' => 'bg-emerald-500',
        'busy' => 'bg-red-500',
        'away' => 'bg-amber-500',
        'offline' => 'bg-zinc-400',
        default => null,
    };
@endphp

<div class="relative inline-flex shrink-0">
    @if ($src)
        <img
            src="{{ $src }}"
            alt="{{ $alt }}"
            {{ $attributes->merge(['class' => "object-cover bg-zinc-100 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 shadow-2xs {$sizeClasses} {$shapeClasses}"]) }}
        />
    @else
        <div {{ $attributes->merge(['class' => "inline-flex items-center justify-center font-bold bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 border border-transparent shadow-2xs select-none {$sizeClasses} {$shapeClasses}"]) }}>
            <span>{{ $initials ?? substr($alt, 0, 2) }}</span>
        </div>
    @endif

    @if ($statusColor)
        <span class="absolute bottom-0 right-0 block w-2.5 h-2.5 rounded-full ring-2 ring-white dark:ring-zinc-900 {{ $statusColor }}"></span>
    @endif
</div>
