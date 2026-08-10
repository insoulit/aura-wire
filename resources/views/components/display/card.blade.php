@props([
    'title' => null,
    'description' => null,
])

@php
    $hasCustomPadding = str_contains($attributes->get('class', ''), 'p-') || str_contains($attributes->get('class', ''), 'px-') || str_contains($attributes->get('class', ''), 'py-');
    $paddingClass = $hasCustomPadding ? '' : 'p-6';
    $headerClass = $hasCustomPadding ? 'p-4 sm:p-5 border-b border-zinc-200 dark:border-zinc-800' : 'mb-4 pb-4 border-b border-zinc-100 dark:border-zinc-800/80';
    $footerClass = $hasCustomPadding ? 'p-4 border-t border-zinc-200 dark:border-zinc-800' : 'mt-4 pt-4 border-t border-zinc-100 dark:border-zinc-800/80';
@endphp

<div {{ $attributes->merge(['class' => "bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl {$paddingClass} shadow-sm flex flex-col justify-between transition-all duration-200"]) }}>
    @if ($title || isset($header))
        <div class="{{ $headerClass }} flex items-center justify-between">
            @if (isset($header))
                {{ $header }}
            @else
                <div>
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white tracking-tight">{{ $title }}</h3>
                    @if ($description)
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1 leading-relaxed">{{ $description }}</p>
                    @endif
                </div>
            @endif
        </div>
    @endif

    <div class="flex-1 flex flex-col">
        {{ $slot }}
    </div>

    @if (isset($footer))
        <div class="{{ $footerClass }} flex items-center justify-between gap-3">
            {{ $footer }}
        </div>
    @endif
</div>
