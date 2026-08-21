@props([
    'name' => 'circle',
    'size' => 'sm', // 'xs', 'sm', 'md', 'lg', 'xl'
    'variant' => null, // null (bare SVG), 'subtle', 'secondary', 'primary', 'dark', 'outline', 'positive', 'success', 'warning', 'danger', 'info'
    'shape' => 'rounded', // 'rounded', 'circle', 'square', 'sm', 'lg'
    'container' => false,
])

@php
    $hasContainer = $container || !empty($variant);

    $svgSizeClasses = match ($size) {
        'xs' => 'w-3.5 h-3.5', // 14px
        'sm' => 'w-4 h-4',     // 16px
        'md' => $hasContainer ? 'w-4 h-4' : 'w-5 h-5',     // 20px
        'lg' => $hasContainer ? 'w-5 h-5' : 'w-6 h-6',     // 24px
        'xl' => $hasContainer ? 'w-6 h-6' : 'w-8 h-8',     // 32px
        default => 'w-4 h-4',
    };

    $containerSizeClasses = match ($size) {
        'xs' => 'w-7 h-7',
        'sm' => 'w-8 h-8',
        'md' => 'w-10 h-10',
        'lg' => 'w-11 h-11',
        'xl' => 'w-14 h-14',
        default => 'w-10 h-10',
    };

    $shapeClasses = match ($shape) {
        'circle', 'full' => 'rounded-full',
        'square' => 'rounded-none',
        'sm' => 'rounded-md',
        'lg' => 'rounded-2xl',
        default => 'rounded-xl',
    };

    $variantClasses = match ($variant) {
        'primary', 'dark' => 'bg-zinc-900 text-white dark:bg-white dark:text-zinc-900 border border-zinc-800 dark:border-zinc-200 shadow-2xs group-hover:bg-white group-hover:text-zinc-900 group-hover:border-white dark:group-hover:bg-zinc-900 dark:group-hover:text-white dark:group-hover:border-zinc-900 transition-colors duration-200',
        'outline' => 'bg-transparent border border-zinc-200 dark:border-zinc-700 text-zinc-700 dark:text-zinc-300 group-hover:border-white/40 dark:group-hover:border-zinc-900/40 transition-colors duration-200',
        'positive', 'success' => 'bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800/60 text-emerald-600 dark:text-emerald-400 shadow-2xs',
        'warning' => 'bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800/60 text-amber-600 dark:text-amber-400 shadow-2xs',
        'danger', 'negative' => 'bg-red-50 dark:bg-red-950/40 border border-red-200 dark:border-red-800/60 text-red-600 dark:text-red-400 shadow-2xs',
        'info' => 'bg-indigo-50 dark:bg-indigo-950/40 border border-indigo-200 dark:border-indigo-800/60 text-indigo-600 dark:text-indigo-400 shadow-2xs',
        default => 'bg-zinc-100 dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 text-zinc-900 dark:text-white shadow-2xs group-hover:bg-white group-hover:text-zinc-900 group-hover:border-white dark:group-hover:bg-zinc-900 dark:group-hover:text-white dark:group-hover:border-zinc-900 transition-colors duration-200',
    };

    // Alias mapping for common legacy icon names to Lucide equivalents
    $mappedName = match ($name) {
        'show' => 'eye',
        'edit' => 'pencil',
        'delete' => 'trash-2',
        'trash' => 'trash-2',
        'close' => 'x',
        'add' => 'plus',
        default => $name,
    };

    $iconName = 'lucide-'.$mappedName;
    $extraClasses = $attributes->get('class', '');
    $attributesToPass = $attributes->except('class')->all();

    try {
        $svgHtml = function_exists('svg') ? svg($iconName, "shrink-0 inline-block {$svgSizeClasses}", $attributesToPass)->toHtml() : null;
    } catch (\Throwable $e) {
        $svgHtml = null;
    }
@endphp

@if ($hasContainer)
    <div {{ $attributes->merge(['class' => "{$containerSizeClasses} {$shapeClasses} {$variantClasses} inline-flex items-center justify-center shrink-0"]) }}>
        @if ($svgHtml)
            {!! $svgHtml !!}
        @else
            <svg class="shrink-0 inline-block {{ $svgSizeClasses }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <circle cx="12" cy="12" r="9" stroke-width="2" />
            </svg>
        @endif
    </div>
@else
    @if ($svgHtml)
        {!! $svgHtml !!}
    @else
        <svg class="shrink-0 inline-block {{ $svgSizeClasses }} {{ $extraClasses }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <circle cx="12" cy="12" r="9" stroke-width="2" />
        </svg>
    @endif
@endif
