@props([
    'step' => 1,
    'title' => null,
    'description' => null,
    'status' => 'pending', // 'completed', 'active', 'pending'
])

@php
    $badgeClasses = match ($status) {
        'completed', 'active' => 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 font-bold shadow-xs',
        default => 'bg-zinc-100 text-zinc-500 dark:bg-zinc-800/80 dark:text-zinc-400 border border-zinc-200 dark:border-zinc-700',
    };

    $ringClasses = $status === 'active' ? 'ring-4 ring-zinc-200 dark:ring-zinc-800' : '';
@endphp

<div {{ $attributes->merge(['class' => 'flex-1 flex items-center gap-3']) }}>
    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full text-xs font-bold font-mono transition-all {{ $badgeClasses }} {{ $ringClasses }}">
        @if ($status === 'completed')
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
            </svg>
        @else
            <span>{{ $step }}</span>
        @endif
    </div>

    <div class="hidden sm:block min-w-0">
        <h5 class="text-xs font-bold text-zinc-900 dark:text-white tracking-tight truncate">{{ $title }}</h5>
        @if ($description)
            <p class="text-xs text-zinc-500 dark:text-zinc-400 truncate">{{ $description }}</p>
        @endif
    </div>
</div>
