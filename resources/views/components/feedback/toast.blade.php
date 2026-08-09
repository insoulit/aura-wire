@props([
    'variant' => 'neutral', // 'neutral', 'success', 'warning', 'danger', 'info', 'subtle'
    'title' => null,
    'description' => null,
    'message' => null,
    'icon' => null,
    'dismissible' => true,
    'action' => null,
])

@php
    $descText = $description ?? $message;

    $variantClasses = match ($variant) {
        'success', 'positive' => 'bg-emerald-950/90 text-emerald-100 border-emerald-800 shadow-emerald-950/30',
        'warning' => 'bg-amber-950/90 text-amber-100 border-amber-800 shadow-amber-950/30',
        'danger', 'negative', 'error' => 'bg-red-950/90 text-red-100 border-red-800 shadow-red-950/30',
        'info', 'accent' => 'bg-indigo-950/90 text-indigo-100 border-indigo-800 shadow-indigo-950/30',
        'subtle' => 'bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white border-zinc-200 dark:border-zinc-800 shadow-xl',
        default => 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 border-zinc-800 dark:border-zinc-200 shadow-xl',
    };

    $iconColor = match ($variant) {
        'success', 'positive' => 'text-emerald-400',
        'warning' => 'text-amber-400',
        'danger', 'negative', 'error' => 'text-red-400',
        'info', 'accent' => 'text-indigo-400',
        'subtle' => 'text-zinc-600 dark:text-zinc-400',
        default => 'text-white dark:text-zinc-900',
    };
@endphp

<div
    @if ($dismissible) x-data="{ show: true }" x-show="show" x-transition @endif
    x-bind:class="{
        'bg-emerald-950/90 text-emerald-100 border-emerald-800 shadow-emerald-950/30': (typeof t !== 'undefined' && t.variant === 'success'),
        'bg-red-950/90 text-red-100 border-red-800 shadow-red-950/30': (typeof t !== 'undefined' && t.variant === 'danger'),
        'bg-indigo-950/90 text-indigo-100 border-indigo-800 shadow-indigo-950/30': (typeof t !== 'undefined' && t.variant === 'info'),
        'bg-amber-950/90 text-amber-100 border-amber-800 shadow-amber-950/30': (typeof t !== 'undefined' && t.variant === 'warning')
    }"
    {{ $attributes->merge(['class' => "rounded-xl border p-4 shadow-xl flex items-center gap-3.5 transition-all duration-200 w-full max-w-sm relative pointer-events-auto {$variantClasses}"]) }}
    role="alert"
>
    {{-- Status Icon --}}
    <div class="shrink-0 {{ $iconColor }}">
        @if ($icon && is_string($icon) && view()->exists("aura::components.icon.{$icon}"))
            <x-dynamic-component :component="'aura::icon.'.$icon" size="sm" />
        @elseif ($icon)
            {{ $icon }}
        @else
            <template x-if="typeof t !== 'undefined' && t.variant === 'success'">
                <svg class="w-5 h-5 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </template>
            <template x-if="typeof t !== 'undefined' && t.variant === 'danger'">
                <svg class="w-5 h-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </template>
            <template x-if="typeof t !== 'undefined' && t.variant === 'info'">
                <svg class="w-5 h-5 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </template>
            <template x-if="typeof t === 'undefined'">
                @if ($variant === 'success' || $variant === 'positive')
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                @elseif ($variant === 'warning')
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                @elseif ($variant === 'danger' || $variant === 'negative' || $variant === 'error')
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                @elseif ($variant === 'info' || $variant === 'accent')
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                @else
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                @endif
            </template>
        @endif
    </div>

    {{-- Content --}}
    <div class="flex-1 min-w-0 text-sm">
        @if ($title)
            <h4 class="font-bold tracking-tight leading-snug" x-text="typeof t !== 'undefined' ? t.title : '{{ $title }}'">{{ $title }}</h4>
        @else
            <h4 class="font-bold tracking-tight leading-snug" x-show="typeof t !== 'undefined' && t.title" x-text="typeof t !== 'undefined' ? t.title : ''"></h4>
        @endif

        @if ($descText)
            <p class="text-xs opacity-90 leading-relaxed mt-0.5" x-text="typeof t !== 'undefined' ? t.description : '{{ $descText }}'">{{ $descText }}</p>
        @else
            <p class="text-xs opacity-90 leading-relaxed mt-0.5" x-show="typeof t !== 'undefined' && t.description" x-text="typeof t !== 'undefined' ? t.description : ''"></p>
        @endif

        @if (!$title && !$descText)
            <div class="leading-normal" x-show="typeof t === 'undefined'">{{ $slot }}</div>
        @endif

        @if (isset($action) && $action)
            <div class="mt-2 pt-1">
                {{ $action }}
            </div>
        @endif
    </div>

    {{-- Dismiss Trigger --}}
    @if ($dismissible)
        <button
            type="button"
            @click="show = false"
            class="p-1 rounded-lg hover:bg-black/10 dark:hover:bg-white/10 opacity-70 hover:opacity-100 transition-opacity cursor-pointer shrink-0"
            aria-label="Dismiss toast"
        >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    @endif
</div>
