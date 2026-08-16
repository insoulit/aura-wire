@props([
    'title' => null,
    'description' => null,
    'divided' => true,
])

@php
    $hasCustomPadding = str_contains($attributes->get('class', ''), 'p-') || str_contains($attributes->get('class', ''), 'px-') || str_contains($attributes->get('class', ''), 'py-');
    $paddingClass = $hasCustomPadding ? '' : 'p-6';
    $isDivided = filter_var($divided, FILTER_VALIDATE_BOOLEAN);
    $headerDivider = $isDivided ? 'mb-4 pb-4 border-b border-zinc-100 dark:border-zinc-800/80' : 'mb-3.5';
    $footerDivider = $isDivided ? 'mt-4 pt-4 border-t border-zinc-100 dark:border-zinc-800/80' : 'mt-4';
    $headerClass = $hasCustomPadding ? ($isDivided ? 'p-4 sm:p-5 border-b border-zinc-200 dark:border-zinc-800' : 'p-4 sm:p-5') : $headerDivider;
    $footerClass = $hasCustomPadding ? ($isDivided ? 'p-4 border-t border-zinc-200 dark:border-zinc-800' : 'p-4') : $footerDivider;
    $tag = $attributes->has('href') ? 'a' : 'div';
    $hoverClass = $attributes->has('href') ? 'hover:bg-zinc-900 hover:text-white hover:border-zinc-900 dark:hover:bg-white dark:hover:text-zinc-900 dark:hover:border-white' : '';
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "w-full bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl {$paddingClass} {$hoverClass} flex flex-col transition-all duration-200 group"]) }}>
    @if ($title || isset($header))
        <div class="{{ $headerClass }} flex items-center justify-between">
            @if (isset($header))
                {{ $header }}
            @else
                <div>
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white tracking-tight">{{ $title }}</h3>
                    @if ($description)
                        <p class="text-sm text-zinc-500 dark:text-zinc-400 mt-1 leading-relaxed">{{ $description }}</p>
                    @endif
                </div>
            @endif
        </div>
    @endif

    <div class="flex-1">
        {{ $slot }}
    </div>

    @if (isset($footer))
        <div class="{{ $footerClass }} flex flex-col sm:flex-row items-center justify-between gap-3 w-full">
            {{ $footer }}
        </div>
    @endif
</{{ $tag }}>
