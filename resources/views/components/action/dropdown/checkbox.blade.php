@props([
    'label' => null,
    'name' => null,
    'id' => null,
    'checked' => false,
    'disabled' => false,
    'size' => 'sm',
])

@php
    $wireModel = $attributes->wire('model');
    $modelName = $wireModel->value() ? str_replace(['.', '[', ']', '\'', '"'], '_', $wireModel->value()) : null;
    $id = $id ?? $name ?? $modelName ?? ('dropdown_check_' . Str::random(8));

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

<label for="{{ $id }}" class="group flex items-center justify-between w-full px-3 py-1.5 text-xs font-medium rounded-lg text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800/80 hover:text-zinc-900 dark:hover:text-white transition-colors cursor-pointer select-none {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}">
    <span>{{ $label ?? $slot }}</span>
    <div class="relative flex items-center shrink-0">
        <input
            type="checkbox"
            id="{{ $id }}"
            @if($name) name="{{ $name }}" @endif
            @if($checked) checked @endif
            @if($disabled) disabled @endif
            {{ $attributes->merge(['class' => 'peer sr-only']) }}
        />
        <div class="{{ $boxSizeClass }} border border-zinc-400 dark:border-zinc-600 bg-white dark:bg-zinc-900 peer-checked:bg-zinc-900 dark:peer-checked:bg-white peer-checked:border-zinc-900 dark:peer-checked:border-white peer-checked:[&>svg]:scale-100 peer-checked:[&>svg]:opacity-100 transition-all flex items-center justify-center shadow-2xs shrink-0">
            <svg class="{{ $iconSizeClass }} text-white dark:text-zinc-900 scale-0 opacity-0 transition-all duration-150 stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>
    </div>
</label>
