@props([
    'label' => null,
    'description' => null,
    'name' => null,
    'id' => null,
    'value' => null,
    'checked' => false,
    'disabled' => false,
    'size' => 'sm', // 'xs', 'sm', 'md', 'lg'
])

@php
    $wireModel = $attributes->wire('model');
    $modelName = $wireModel->value() ? str_replace(['.', '[', ']', '\'', '"'], '_', $wireModel->value()) : null;
    $valueSuffix = $value !== null ? ('_' . str_replace(['.', '[', ']', '\'', '"', ' '], '_', (string)$value)) : '';
    $id = $id ?? ($name ? $name . $valueSuffix : ($modelName ? $modelName . $valueSuffix : ('checkbox_' . Str::random(8))));
    $hasContent = $label || !$slot->isEmpty();
    $alignItems = $description ? 'items-start' : 'items-center';
    $widthClass = $hasContent ? 'w-full' : 'inline-flex shrink-0';

    $boxSizeClass = match ($size) {
        'xs' => 'w-3 h-3 rounded-[3px]',
        'sm' => 'w-3.5 h-3.5 rounded-[4px]',
        'lg' => 'w-5 h-5 rounded-lg',
        default => 'w-3.5 h-3.5 rounded-[4px]',
    };

    $iconSizeClass = match ($size) {
        'xs' => 'w-2 h-2',
        'sm' => 'w-2.5 h-2.5',
        'lg' => 'w-3.5 h-3.5',
        default => 'w-2.5 h-2.5',
    };
@endphp

<label for="{{ $id }}" {{ $attributes->only('class')->merge(['class' => "flex {$alignItems} {$widthClass} gap-2 cursor-pointer group select-none " . ($disabled ? 'opacity-50 cursor-not-allowed' : '')]) }}>
    <div class="relative flex items-center shrink-0 {{ $description ? 'mt-0.5' : '' }}">
        <input
            type="checkbox"
            id="{{ $id }}"
            @if($name) name="{{ $name }}" @endif
            @if($value !== null) value="{{ $value }}" @endif
            @if($checked) checked @endif
            @if($disabled) disabled @endif
            {{ $attributes->except('class')->merge(['class' => 'peer sr-only']) }}
        />
        <div class="{{ $boxSizeClass }} border border-zinc-400 dark:border-zinc-600 bg-white dark:bg-zinc-900 peer-checked:bg-zinc-900 dark:peer-checked:bg-white peer-checked:border-zinc-900 dark:peer-checked:border-white peer-checked:[&>svg]:scale-100 peer-checked:[&>svg]:opacity-100 peer-focus-visible:ring-2 peer-focus-visible:ring-zinc-900 dark:peer-focus-visible:ring-white peer-focus-visible:ring-offset-2 transition-all flex items-center justify-center shadow-2xs shrink-0">
            <svg class="{{ $iconSizeClass }} text-white dark:text-zinc-900 scale-0 opacity-0 transition-all duration-150 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
    </div>

    @if ($hasContent)
        <div class="flex flex-col flex-1">
            <span class="text-sm font-medium text-zinc-900 dark:text-zinc-100 group-hover:text-zinc-700 dark:group-hover:text-zinc-300">
                {{ $label ?? $slot }}
            </span>
            @if ($description)
                <span class="text-xs text-zinc-500 dark:text-zinc-400 leading-normal">{{ $description }}</span>
            @endif
        </div>
    @endif
</label>
