@props([
    'label' => null,
    'name' => null,
    'required' => false,
    'hint' => null,
    'error' => null,
    'rows' => 3,
    'invalid' => false,
])

@php
    $wireModel = $attributes->wire('model');
    $id = $name ?? $attributes->get('id') ?? ($wireModel->value() ? str_replace('.', '_', $wireModel->value()) : null);
    $isInvalid = $invalid || ($name && isset($errors) && $errors->has($name));

    $borderClasses = $isInvalid
        ? 'border-red-600 dark:border-red-500 focus:border-red-600 focus:ring-1 focus:ring-red-600'
        : 'border-zinc-300 dark:border-zinc-700 focus:border-zinc-900 dark:focus:border-zinc-100 focus:ring-1 focus:ring-zinc-900 dark:focus:ring-zinc-100';
@endphp

@if ($label || $hint || $error || ($name && isset($errors) && $errors->has($name)))
    <div class="space-y-1 w-full">
        @if ($label)
            <x-aura::label :for="$id" :required="$required">
                {{ $label }}
            </x-aura::label>
        @endif

        <textarea
            @if($id) id="{{ $id }}" @endif
            rows="{{ $rows }}"
            {{ $attributes->merge(['class' => "w-full bg-zinc-50 dark:bg-zinc-900/90 text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500 border rounded-lg p-3 text-sm transition-all duration-150 shadow-2xs outline-none disabled:opacity-50 disabled:cursor-not-allowed {$borderClasses}"]) }}
        >{{ $slot }}</textarea>

        @if ($hint)
            <p class="text-xs text-zinc-500 dark:text-zinc-400 leading-normal pt-0.5">{{ $hint }}</p>
        @endif

        <x-aura::error :name="$name" :message="$error" />
    </div>
@else
    <textarea
        @if($id) id="{{ $id }}" @endif
        rows="{{ $rows }}"
        {{ $attributes->merge(['class' => "w-full bg-zinc-50 dark:bg-zinc-900/90 text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500 border rounded-lg p-3 text-sm transition-all duration-150 shadow-2xs outline-none disabled:opacity-50 disabled:cursor-not-allowed {$borderClasses}"]) }}
    >{{ $slot }}</textarea>
@endif
