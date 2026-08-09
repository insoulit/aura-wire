@props([
    'name' => 'circle',
    'size' => 'sm', // 'xs', 'sm', 'md', 'lg', 'xl'
])

@php
    $sizeClasses = match ($size) {
        'xs' => 'w-3.5 h-3.5', // 14px
        'sm' => 'w-4 h-4',     // 16px
        'md' => 'w-5 h-5',     // 20px
        'lg' => 'w-6 h-6',     // 24px
        'xl' => 'w-8 h-8',     // 32px
        default => 'w-4 h-4',
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
    $attributesToPass = $attributes->except('class')->toArray();

    try {
        $svgHtml = function_exists('svg') ? svg($iconName, "shrink-0 {$sizeClasses} {$extraClasses}", $attributesToPass)->toHtml() : null;
    } catch (\Throwable $e) {
        $svgHtml = null;
    }
@endphp

@if ($svgHtml)
    {!! $svgHtml !!}
@else
    <svg class="shrink-0 {{ $sizeClasses }} {{ $extraClasses }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <circle cx="12" cy="12" r="9" stroke-width="2" />
    </svg>
@endif
