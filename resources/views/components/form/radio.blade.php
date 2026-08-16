@props([
    'label' => null,
    'description' => null,
    'value' => null,
    'name' => null,
    'id' => null,
    'checked' => false,
    'disabled' => false,
    'size' => 'sm', // 'xs', 'sm', 'md', 'lg'
])

@php
    $wireModel = $attributes->wire('model');
    $modelName = $wireModel->value() ? str_replace(['.', '[', ']', '\'', '"'], '_', $wireModel->value()) : null;
    $valueSlug = $value !== null ? ('_' . Str::slug((string)$value, '_')) : '';
    $id = $id ?? ($name ? $name . $valueSlug : ($modelName ? $modelName . $valueSlug : ('radio_' . Str::random(8))));
    $hasContent = $label || !$slot->isEmpty();
    $alignItems = $description ? 'items-start' : 'items-center';
    $widthClass = $hasContent ? 'w-full' : 'inline-flex shrink-0';

    $boxSizeClass = match ($size) {
        'xs' => 'w-3 h-3',
        'sm' => 'w-3.5 h-3.5',
        'lg' => 'w-5 h-5',
        default => 'w-3.5 h-3.5',
    };

    $dotSizeClass = match ($size) {
        'xs' => 'w-1 h-1',
        'sm' => 'w-1.5 h-1.5',
        'lg' => 'w-2.5 h-2.5',
        default => 'w-1.5 h-1.5',
    };
@endphp

<label for="{{ $id }}" {{ $attributes->only('class')->merge(['class' => "flex {$alignItems} {$widthClass} gap-2.5 cursor-pointer group select-none " . ($disabled ? 'opacity-50 cursor-not-allowed' : '')]) }}>
    <div class="relative flex items-center shrink-0 {{ $description ? 'mt-[3px]' : '' }}">
        <input
            type="radio"
            id="{{ $id }}"
            @if($name) name="{{ $name }}" @endif
            @if($value !== null) value="{{ $value }}" @endif
            @if($checked) checked @endif
            @if($disabled) disabled @endif
            {{ $attributes->except('class')->merge(['class' => 'peer sr-only']) }}
        />
        <div class="{{ $boxSizeClass }} rounded-full border border-zinc-400 dark:border-zinc-600 bg-white dark:bg-zinc-900 peer-checked:border-zinc-900 dark:peer-checked:border-white peer-checked:bg-zinc-900 dark:peer-checked:bg-white peer-checked:[&>span]:scale-100 peer-checked:[&>span]:opacity-100 peer-focus-visible:ring-2 peer-focus-visible:ring-zinc-900 dark:peer-focus-visible:ring-white peer-focus-visible:ring-offset-2 transition-all flex items-center justify-center shadow-2xs shrink-0">
            <span class="{{ $dotSizeClass }} rounded-full bg-white dark:bg-zinc-900 scale-0 opacity-0 transition-all duration-150"></span>
        </div>
    </div>

    @if ($hasContent)
        <div class="flex flex-col flex-1">
            <span class="text-sm font-medium leading-5 text-zinc-900 dark:text-zinc-100 group-hover:text-zinc-700 dark:group-hover:text-zinc-300">
                {{ $label ?? $slot }}
            </span>
            @if ($description)
                <span class="text-xs text-zinc-500 dark:text-zinc-400 leading-normal mt-0.5">{{ $description }}</span>
            @endif
        </div>
    @endif
</label>
