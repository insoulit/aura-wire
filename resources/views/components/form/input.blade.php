@props([
    'label' => null,
    'name' => null,
    'required' => false,
    'hint' => null,
    'error' => null,
    'type' => 'text',
    'size' => 'md',
    'invalid' => false,
    'icon' => null,
    'iconTrailing' => null,
])

@php
    $wireModel = $attributes->wire('model');
    $id = $name ?? $attributes->get('id') ?? ($wireModel->value() ? str_replace('.', '_', $wireModel->value()) : null);

    $sizeClasses = match ($size) {
        'sm' => 'py-1.5 px-3 text-xs rounded-md',
        'md' => 'py-2 px-3.5 text-sm rounded-lg',
        'lg' => 'py-2.5 px-4 text-base rounded-xl',
        default => 'py-2 px-3.5 text-sm rounded-lg',
    };

    $iconSize = match ($size) {
        'sm' => 'xs',
        'lg' => 'md',
        default => 'sm',
    };

    $paddingLeft = (isset($icon) && $icon) ? ($size === 'sm' ? 'pl-8' : ($size === 'lg' ? 'pl-11' : 'pl-9')) : '';
    $paddingRight = (isset($iconTrailing) && $iconTrailing) ? ($size === 'sm' ? 'pr-8' : ($size === 'lg' ? 'pr-11' : 'pr-9')) : '';
    $iconLeftPos = $size === 'sm' ? 'left-2.5' : 'left-3';
    $iconRightPos = $size === 'sm' ? 'right-2.5' : 'right-3';

    $isInvalid = $invalid || ($name && isset($errors) && $errors->has($name));

    $borderClasses = $isInvalid
        ? 'border-red-600 dark:border-red-500 focus:border-red-600 focus:ring-1 focus:ring-red-600'
        : 'border-zinc-300 dark:border-zinc-700 focus:border-zinc-900 dark:focus:border-zinc-100 focus:ring-1 focus:ring-zinc-900 dark:focus:ring-zinc-100';

    $inputClasses = "w-full bg-zinc-50 dark:bg-zinc-900/90 text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500 border transition-all duration-150 shadow-2xs outline-none disabled:opacity-50 disabled:cursor-not-allowed {$sizeClasses} {$paddingLeft} {$paddingRight} {$borderClasses}";
@endphp

@if ($label || $hint || $error || ($name && isset($errors) && $errors->has($name)))
    <div class="space-y-1 w-full">
        @if ($label)
            <x-aura::label :for="$id" :required="$required" :size="$size === 'sm' ? 'xs' : ($size === 'lg' ? 'md' : 'sm')">
                {{ $label }}
            </x-aura::label>
        @endif

        <div {{ $attributes->only('class')->merge(['class' => 'relative flex items-center w-full']) }}>
            @if (isset($icon) && $icon)
                <div class="absolute {{ $iconLeftPos }} inset-y-0 flex items-center justify-center pointer-events-none text-zinc-400 dark:text-zinc-500">
                    @if (is_string($icon))
                        <x-aura::icon :name="$icon" :size="$iconSize" />
                    @else
                        {{ $icon }}
                    @endif
                </div>
            @endif

            <input
                @if($id) id="{{ $id }}" @endif
                type="{{ $type }}"
                {{ $attributes->except('class')->merge(['class' => $inputClasses]) }}
            />

            @if (isset($iconTrailing) && $iconTrailing)
                <div class="absolute {{ $iconRightPos }} inset-y-0 flex items-center justify-center pointer-events-none text-zinc-400 dark:text-zinc-500">
                    @if (is_string($iconTrailing))
                        <x-aura::icon :name="$iconTrailing" :size="$iconSize" />
                    @else
                        {{ $iconTrailing }}
                    @endif
                </div>
            @endif
        </div>

        @if ($hint)
            <p class="text-xs text-zinc-500 dark:text-zinc-400 leading-normal pt-0.5">{{ $hint }}</p>
        @endif

        <x-aura::error :name="$name" :message="$error" />
    </div>
@else
    <div {{ $attributes->only('class')->merge(['class' => 'relative flex items-center w-full']) }}>
        @if (isset($icon) && $icon)
            <div class="absolute {{ $iconLeftPos }} inset-y-0 flex items-center justify-center pointer-events-none text-zinc-400 dark:text-zinc-500">
                @if (is_string($icon))
                    <x-aura::icon :name="$icon" :size="$iconSize" />
                @else
                    {{ $icon }}
                @endif
            </div>
        @endif

        <input
            @if($id) id="{{ $id }}" @endif
            type="{{ $type }}"
            {{ $attributes->except('class')->merge(['class' => $inputClasses]) }}
        />

        @if (isset($iconTrailing) && $iconTrailing)
            <div class="absolute {{ $iconRightPos }} inset-y-0 flex items-center justify-center pointer-events-none text-zinc-400 dark:text-zinc-500">
                @if (is_string($iconTrailing))
                    <x-aura::icon :name="$iconTrailing" :size="$iconSize" />
                @else
                    {{ $iconTrailing }}
                @endif
            </div>
        @endif
    </div>
@endif
