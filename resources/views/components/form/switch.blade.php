@props([
    'label' => null,
    'description' => null,
    'size' => 'md',
])

@php
    $trackSize = match ($size) {
        'sm' => 'w-8 h-4',
        'md' => 'w-10 h-5',
        'lg' => 'w-12 h-6',
        default => 'w-10 h-5',
    };

    $thumbSize = match ($size) {
        'sm' => 'w-3 h-3 peer-checked:translate-x-4',
        'md' => 'w-4 h-4 peer-checked:translate-x-5',
        'lg' => 'w-5 h-5 peer-checked:translate-x-6',
        default => 'w-4 h-4 peer-checked:translate-x-5',
    };
@endphp

<label class="inline-flex items-center justify-between gap-4 cursor-pointer select-none group w-full">
    @if ($label || !$slot->isEmpty())
        <div class="flex flex-col">
            <span class="text-sm font-medium text-zinc-900 dark:text-zinc-100 group-hover:text-zinc-700 dark:group-hover:text-zinc-300">
                {{ $label ?? $slot }}
            </span>
            @if ($description)
                <span class="text-xs text-zinc-500 dark:text-zinc-400 leading-normal">{{ $description }}</span>
            @endif
        </div>
    @endif

    <div class="relative inline-flex items-center">
        <input
            type="checkbox"
            {{ $attributes->merge(['class' => 'peer sr-only']) }}
        />
        <div class="{{ $trackSize }} rounded-full bg-zinc-300 dark:bg-zinc-700 peer-checked:bg-zinc-900 dark:peer-checked:bg-white peer-focus-visible:ring-2 peer-focus-visible:ring-zinc-900 dark:peer-focus-visible:ring-white peer-focus-visible:ring-offset-2 transition-colors duration-200 shadow-inner"></div>
        <div class="absolute left-0.5 {{ $thumbSize }} rounded-full bg-white dark:bg-zinc-900 peer-checked:dark:bg-zinc-900 transition-transform duration-200 shadow-sm"></div>
    </div>
</label>
