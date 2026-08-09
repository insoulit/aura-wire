@props([
    'label' => null,
    'name' => null,
    'required' => false,
    'hint' => null,
    'error' => null,
    'size' => 'md',
    'invalid' => false,
    'placeholder' => null,
    'options' => [],
])

@php
    $wireModel = $attributes->wire('model');
    $id = $name ?? $attributes->get('id') ?? ($wireModel->value() ? str_replace('.', '_', $wireModel->value()) : null);
    $isInvalid = $invalid || ($name && isset($errors) && $errors->has($name));

    $optionsArray = is_array($options) ? $options : iterator_to_array($options);

    $sizeClasses = match ($size) {
        'sm' => 'py-1.5 pl-3 pr-8 text-xs rounded-md',
        'md' => 'py-2 pl-3.5 pr-9 text-sm rounded-lg',
        'lg' => 'py-2.5 pl-4 pr-10 text-base rounded-xl',
        default => 'py-2 pl-3.5 pr-9 text-sm rounded-lg',
    };

    $borderClasses = $isInvalid
        ? 'border-red-600 dark:border-red-500 focus:border-red-600 focus:ring-1 focus:ring-red-600'
        : 'border-zinc-300 dark:border-zinc-700 focus:border-zinc-900 dark:focus:border-zinc-100 focus:ring-1 focus:ring-zinc-900 dark:focus:ring-zinc-100';
@endphp

@if ($label || $hint || $error || ($name && isset($errors) && $errors->has($name)))
    <div class="space-y-1 w-full">
        @if ($label)
            <x-aura::label :for="$id" :required="$required" :size="$size === 'sm' ? 'xs' : ($size === 'lg' ? 'md' : 'sm')">
                {{ $label }}
            </x-aura::label>
        @endif

        <div class="relative w-full">
            <select
                @if($id) id="{{ $id }}" @endif
                {{ $attributes->merge(['class' => "w-full appearance-none bg-zinc-50 dark:bg-zinc-900/90 text-zinc-900 dark:text-white border transition-all duration-150 shadow-2xs outline-none disabled:opacity-50 disabled:cursor-not-allowed {$sizeClasses} {$borderClasses}"]) }}
            >
                @if ($placeholder)
                    <option value="" disabled selected>{{ $placeholder }}</option>
                @endif
                @if (!empty($optionsArray))
                    @foreach ($optionsArray as $key => $val)
                        @php
                            $optValue = is_numeric($key) ? $val : $key;
                            $optLabel = $val;
                        @endphp
                        <option value="{{ $optValue }}">{{ $optLabel }}</option>
                    @endforeach
                @endif
                {{ $slot }}
            </select>

            <div class="absolute right-3 inset-y-0 flex items-center pointer-events-none text-zinc-500 dark:text-zinc-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>

        @if ($hint)
            <p class="text-xs text-zinc-500 dark:text-zinc-400 leading-normal pt-0.5">{{ $hint }}</p>
        @endif

        <x-aura::error :name="$name" :message="$error" />
    </div>
@else
    <div class="relative w-full">
        <select
            @if($id) id="{{ $id }}" @endif
            {{ $attributes->merge(['class' => "w-full appearance-none bg-zinc-50 dark:bg-zinc-900/90 text-zinc-900 dark:text-white border transition-all duration-150 shadow-2xs outline-none disabled:opacity-50 disabled:cursor-not-allowed {$sizeClasses} {$borderClasses}"]) }}
        >
            @if ($placeholder)
                <option value="" disabled selected>{{ $placeholder }}</option>
            @endif
            @if (!empty($optionsArray))
                @foreach ($optionsArray as $key => $val)
                    @php
                        $optValue = is_numeric($key) ? $val : $key;
                        $optLabel = $val;
                    @endphp
                    <option value="{{ $optValue }}">{{ $optLabel }}</option>
                @endforeach
            @endif
            {{ $slot }}
        </select>

        <div class="absolute right-3 inset-y-0 flex items-center pointer-events-none text-zinc-500 dark:text-zinc-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </div>
@endif
