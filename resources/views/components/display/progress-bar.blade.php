@props([
    'percent' => 0,
    'size' => 'md', // 'sm' | 'md' | 'lg'
    'variant' => 'default', // 'default' | 'emerald' | 'indigo' | 'amber' | 'red'
])

@php
    $sizeClasses = match ($size) {
        'sm' => 'h-1.5',
        'md' => 'h-2.5',
        'lg' => 'h-4',
        default => 'h-2.5',
    };

    $fillClasses = match ($variant) {
        'emerald', 'success' => 'bg-emerald-600 dark:bg-emerald-500',
        'indigo', 'primary' => 'bg-indigo-600 dark:bg-indigo-500',
        'amber', 'warning' => 'bg-amber-500 dark:bg-amber-400',
        'red', 'danger' => 'bg-red-600 dark:bg-red-500',
        default => 'bg-zinc-900 dark:bg-zinc-100',
    };

    $clampedPercent = max(0, min(100, (float) $percent));
@endphp

<div {{ $attributes->merge(['class' => "w-full overflow-hidden rounded-full bg-zinc-200 dark:bg-zinc-800 {$sizeClasses}"]) }}>
    <div
        class="h-full rounded-full transition-all duration-300 ease-out {{ $fillClasses }}"
        style="width: {{ $clampedPercent }}%"
        role="progressbar"
        aria-valuenow="{{ $clampedPercent }}"
        aria-valuemin="0"
        aria-valuemax="100"
    ></div>
</div>
