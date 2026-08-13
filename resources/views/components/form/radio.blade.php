@props([
    'label' => null,
    'description' => null,
    'value' => null,
    'name' => null,
    'id' => null,
    'checked' => false,
    'disabled' => false,
])

@php
    $id = $id ?? ($name ? $name . '_' . Str::slug($value ?? Str::random(6)) : 'radio_' . Str::random(8));
@endphp

<label for="{{ $id }}" class="inline-flex items-start gap-3 cursor-pointer group select-none {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}">
    <div class="relative flex items-center mt-0.5">
        <input
            type="radio"
            id="{{ $id }}"
            @if($name) name="{{ $name }}" @endif
            @if($value !== null) value="{{ $value }}" @endif
            @if($checked) checked @endif
            @if($disabled) disabled @endif
            {{ $attributes->merge(['class' => 'peer sr-only']) }}
        />
        <div class="w-4 h-4 rounded-full border border-zinc-400 dark:border-zinc-600 bg-white dark:bg-zinc-900 peer-checked:border-zinc-900 dark:peer-checked:border-white peer-checked:bg-zinc-900 dark:peer-checked:bg-white peer-checked:[&>span]:scale-100 peer-checked:[&>span]:opacity-100 peer-focus-visible:ring-2 peer-focus-visible:ring-zinc-900 dark:peer-focus-visible:ring-white peer-focus-visible:ring-offset-2 transition-all flex items-center justify-center shadow-2xs shrink-0">
            <span class="w-2 h-2 rounded-full bg-white dark:bg-zinc-900 scale-0 opacity-0 transition-all duration-150"></span>
        </div>
    </div>

    @if ($label || !$slot->isEmpty())
        <div class="flex flex-col">
            <span class="text-sm font-medium text-zinc-900 dark:text-zinc-100 group-hover:text-zinc-700 dark:group-hover:text-zinc-300">
                {{ $label ?? $slot }}
            </span>
            @if ($description)
                <span class="text-xs text-zinc-500 dark:text-zinc-400 leading-normal">{{ $description }}</span>
            @endif
        </div>
    @endif
</label>
