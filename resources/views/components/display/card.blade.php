@props([
    'title' => null,
    'description' => null,
    'divided' => true,
    'gap' => null,
    'size' => null, // 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl', 'full'
    'padding' => null, // 'none' | 'xs' | 'sm' | 'md' | 'lg' | 'xl'
])

@php
    $hasCustomPadding = str_contains($attributes->get('class', ''), 'p-') || str_contains($attributes->get('class', ''), 'px-') || str_contains($attributes->get('class', ''), 'py-');
    $paddingClass = match ($padding) {
        'none', false => 'p-0',
        'xs' => 'p-2.5',
        'sm' => 'p-3.5 sm:p-4',
        'md' => 'p-5 sm:p-6',
        'lg' => 'p-6 sm:p-8',
        'xl' => 'p-8 sm:p-10',
        default => $hasCustomPadding ? '' : 'p-6',
    };
    $radiusClass = match ($padding) {
        'xs', 'sm' => 'rounded-xl',
        'xl' => 'rounded-3xl',
        default => 'rounded-2xl',
    };
    $isDivided = filter_var($divided, FILTER_VALIDATE_BOOLEAN);
    $headerDivider = $isDivided ? 'mb-4 pb-4 border-b border-zinc-100 dark:border-zinc-800/80' : 'mb-3.5';
    $footerDivider = $isDivided ? 'mt-auto pt-4 border-t border-zinc-100 dark:border-zinc-800/80' : 'mt-auto pt-4';
    $headerClass = $hasCustomPadding ? ($isDivided ? 'p-4 sm:p-5 border-b border-zinc-200 dark:border-zinc-800' : 'p-4 sm:p-5') : $headerDivider;
    $footerClass = $hasCustomPadding ? ($isDivided ? 'p-4 border-t border-zinc-200 dark:border-zinc-800' : 'p-4') : $footerDivider;
    $tag = $attributes->has('href') ? 'a' : 'div';
    $hoverClass = $attributes->has('href') ? 'hover:bg-zinc-900 hover:text-white hover:border-zinc-900 dark:hover:bg-white dark:hover:text-zinc-900 dark:hover:border-white' : '';

    $sizeClass = match ($size) {
        'sm' => 'max-w-sm',
        'md' => 'max-w-md',
        'lg' => 'max-w-lg',
        'xl' => 'max-w-xl',
        '2xl' => 'max-w-2xl',
        '3xl' => 'max-w-3xl',
        '4xl' => 'max-w-4xl',
        '5xl' => 'max-w-5xl',
        '6xl' => 'max-w-6xl',
        'full' => 'max-w-full',
        default => $size ? "max-w-{$size}" : '',
    };

    $gapClass = match ($gap) {
        'none', '0' => 'gap-0',
        'xs', '1' => 'gap-1',
        'sm', '2' => 'gap-2',
        '3' => 'gap-3',
        'md', '4' => 'gap-4',
        '5' => 'gap-5',
        'lg', '6' => 'gap-6',
        'xl', '8' => 'gap-8',
        '10' => 'gap-10',
        '12' => 'gap-12',
        default => $gap ? "gap-{$gap}" : '',
    };
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "w-full bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 {$radiusClass} {$paddingClass} {$hoverClass} {$sizeClass} flex flex-col transition-all duration-200 group"]) }}>
    @if ($title || isset($header))
        <div class="{{ $headerClass }} flex items-center justify-between">
            @if (isset($header))
                {{ $header }}
            @else
                <div>
                    <h3 class="text-base sm:text-lg font-bold text-zinc-900 dark:text-white tracking-tight leading-snug text-balance">{{ $title }}</h3>
                    @if ($description)
                        <p class="text-xs sm:text-sm text-zinc-600 dark:text-zinc-400 mt-1 leading-relaxed text-pretty">{{ $description }}</p>
                    @endif
                </div>
            @endif
        </div>
    @endif

    <div class="flex flex-col flex-1 {{ $gapClass }}">
        {{ $slot }}
    </div>

    @if (isset($footer))
        <div class="{{ $footerClass }} flex flex-col sm:flex-row items-center justify-between gap-3 w-full">
            {{ $footer }}
        </div>
    @endif
</{{ $tag }}>
