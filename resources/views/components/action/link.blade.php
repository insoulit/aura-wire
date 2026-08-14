@props([
    'variant' => 'default', // 'default' | 'subtle' | 'muted' | 'primary' | 'danger'
    'size' => 'md', // 'xs' | 'sm' | 'md' | 'lg'
    'weight' => 'medium', // 'normal' | 'medium' | 'semibold' | 'bold'
    'icon' => null,
    'iconTrailing' => null,
    'external' => null, // true | false | null (auto-detect from target="_blank")
    'underline' => 'hover', // 'hover' | 'always' | 'none'
    'disabled' => false,
])

@php
    $isExternal = $external ?? $attributes->get('target') === '_blank';

    $variantClasses = match ($variant) {
        'default' => 'text-zinc-700 hover:text-zinc-900 dark:text-zinc-300 dark:hover:text-white',
        'subtle', 'muted' => 'text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200',
        'primary' => 'text-indigo-600 hover:text-indigo-700 dark:text-indigo-400 dark:hover:text-indigo-300',
        'danger' => 'text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300',
        default => 'text-zinc-700 hover:text-zinc-900 dark:text-zinc-300 dark:hover:text-white',
    };

    $sizeClasses = match ($size) {
        'xs' => 'text-xs gap-1',
        'sm' => 'text-sm gap-1',
        'md' => 'text-sm gap-1.5',
        'lg' => 'text-base gap-2',
        default => 'text-sm gap-1.5',
    };

    $weightClasses = match ($weight) {
        'normal' => 'font-normal',
        'medium' => 'font-medium',
        'semibold' => 'font-semibold',
        'bold' => 'font-bold',
        default => 'font-medium',
    };

    $underlineClasses = match ($underline) {
        'hover' => 'hover:underline underline-offset-4 decoration-current/30',
        'always' => 'underline underline-offset-4 decoration-current/30 hover:decoration-current/60',
        'none' => '',
        default => 'hover:underline underline-offset-4 decoration-current/30',
    };

    $disabledClasses = $disabled
        ? 'opacity-50 pointer-events-none cursor-not-allowed'
        : 'cursor-pointer';

    $iconSize = match ($size) {
        'xs' => 'xs',
        'sm' => 'xs',
        'md' => 'sm',
        'lg' => 'sm',
        default => 'sm',
    };
@endphp

<a
    {{ $attributes->merge([
        'class' => "inline-flex items-center transition-colors duration-150 {$variantClasses} {$sizeClasses} {$weightClasses} {$underlineClasses} {$disabledClasses}",
    ]) }}
    @if ($disabled) aria-disabled="true" tabindex="-1" @endif
    @if ($isExternal && !$attributes->has('rel')) rel="noopener noreferrer" @endif
>
    {{-- Leading Icon --}}
    @if (isset($icon) && $icon)
        <span class="inline-flex shrink-0">
            @if (is_string($icon))
                <x-aura::icon :name="$icon" :size="$iconSize" />
            @else
                {{ $icon }}
            @endif
        </span>
    @endif

    {{-- Link Content --}}
    <span>{{ $slot }}</span>

    {{-- Trailing Icon --}}
    @if (isset($iconTrailing) && $iconTrailing)
        <span class="inline-flex shrink-0">
            @if (is_string($iconTrailing))
                <x-aura::icon :name="$iconTrailing" :size="$iconSize" />
            @else
                {{ $iconTrailing }}
            @endif
        </span>
    @elseif ($isExternal)
        <span class="inline-flex shrink-0 opacity-60">
            <x-aura::icon name="external-link" :size="$iconSize" />
        </span>
    @endif
</a>
