@props([
    'variant' => 'info', // 'info', 'success', 'warning', 'danger', 'primary', 'dark', 'gradient'
    'layout' => 'subtle', // 'subtle', 'solid', 'left-accent', 'announcement'
    'title' => null,
    'description' => null,
    'badge' => null,
    'icon' => null,
    'dismissible' => false,
    'action' => null,
])

@php
    $variantClasses = match ($layout) {
        'solid' => match ($variant) {
            'success' => 'bg-emerald-600 text-white border-transparent',
            'warning' => 'bg-amber-600 text-white border-transparent',
            'danger' => 'bg-red-600 text-white border-transparent',
            'primary', 'dark' => 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 border-transparent',
            'gradient' => 'bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white border-transparent',
            default => 'bg-indigo-600 text-white border-transparent',
        },

        'left-accent' => match ($variant) {
            'success' => 'bg-emerald-50/80 text-emerald-900 border-l-4 border-l-emerald-600 border-zinc-200 dark:bg-emerald-950/40 dark:text-emerald-200 dark:border-zinc-800 dark:border-l-emerald-500',
            'warning' => 'bg-amber-50/80 text-amber-900 border-l-4 border-l-amber-500 border-zinc-200 dark:bg-amber-950/40 dark:text-amber-200 dark:border-zinc-800 dark:border-l-amber-400',
            'danger' => 'bg-red-50/80 text-red-900 border-l-4 border-l-red-600 border-zinc-200 dark:bg-red-950/40 dark:text-red-200 dark:border-zinc-800 dark:border-l-red-500',
            'primary', 'dark' => 'bg-zinc-50 dark:bg-zinc-900 text-zinc-900 dark:text-white border-l-4 border-l-zinc-900 dark:border-l-white border-zinc-200 dark:border-zinc-800',
            default => 'bg-indigo-50/80 text-indigo-900 border-l-4 border-l-indigo-600 border-zinc-200 dark:bg-indigo-950/40 dark:text-indigo-200 dark:border-zinc-800 dark:border-l-indigo-500',
        },

        'announcement' => 'bg-zinc-900 text-white dark:bg-zinc-950 dark:text-zinc-100 border-zinc-800 shadow-md',

        default => match ($variant) {
            'success' => 'bg-emerald-50/80 text-emerald-900 border-emerald-200/80 dark:bg-emerald-950/40 dark:text-emerald-200 dark:border-emerald-800/80',
            'warning' => 'bg-amber-50/80 text-amber-900 border-amber-200/80 dark:bg-amber-950/40 dark:text-amber-200 dark:border-amber-800/80',
            'danger' => 'bg-red-50/80 text-red-900 border-red-200/80 dark:bg-red-950/40 dark:text-red-200 dark:border-red-800/80',
            'primary', 'dark' => 'bg-zinc-900 text-white border-zinc-800 dark:bg-white dark:text-zinc-900 dark:border-zinc-200',
            'gradient' => 'bg-gradient-to-r from-indigo-500/10 via-purple-500/10 to-pink-500/10 text-zinc-900 dark:text-white border-purple-200 dark:border-purple-800/60',
            default => 'bg-zinc-100/80 text-zinc-900 border-zinc-200/80 dark:bg-zinc-800/60 dark:text-zinc-200 dark:border-zinc-700/80',
        },
    };
@endphp

<div
    role="alert"
    @if ($dismissible) x-data="{ show: true }" x-show="show" x-transition @endif
    {{ $attributes->merge(['class' => "relative flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-4 sm:p-5 rounded-2xl border transition-all duration-200 shadow-2xs {$variantClasses}"]) }}
>
    <div class="flex items-start sm:items-center gap-3.5 min-w-0">
        @if ($badge)
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wider bg-white/20 dark:bg-black/20 shrink-0">
                {{ $badge }}
            </span>
        @endif

        @if ($icon)
            <div class="shrink-0 pt-0.5 sm:pt-0">
                @if (is_string($icon) && view()->exists("aura::components.icon.{$icon}"))
                    <x-dynamic-component :component="'aura::icon.'.$icon" size="sm" />
                @else
                    {{ $icon }}
                @endif
            </div>
        @endif

        <div class="space-y-0.5 min-w-0">
            @if ($title)
                <h4 class="text-sm font-bold tracking-tight leading-tight">{{ $title }}</h4>
            @endif
            @if ($description)
                <p class="text-xs sm:text-sm opacity-90 leading-relaxed">{{ $description }}</p>
            @endif
            @if (!$title && !$description)
                <div class="text-sm font-medium leading-normal">
                    {{ $slot }}
                </div>
            @endif
        </div>
    </div>

    <div class="flex items-center gap-2 shrink-0 self-end sm:self-center">
        @if (isset($action) && $action)
            <div>
                {{ $action }}
            </div>
        @endif

        @if ($dismissible)
            <button
                type="button"
                @click="show = false"
                class="p-1.5 rounded-xl hover:bg-black/10 dark:hover:bg-white/15 transition-colors cursor-pointer"
                aria-label="Dismiss alert"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        @endif
    </div>
</div>
