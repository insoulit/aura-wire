@props([
    'label' => null,
    'name' => null,
    'required' => false,
    'hint' => null,
    'error' => null,
])

<div {{ $attributes->merge(['class' => 'space-y-1.5']) }}>
    @if ($label)
        <x-aura::label :for="$name" :required="$required">
            {{ $label }}
        </x-aura::label>
    @endif

    {{ $slot }}

    @if ($hint)
        <p class="text-xs text-zinc-500 dark:text-zinc-400 leading-normal">{{ $hint }}</p>
    @endif

    <x-aura::error :name="$name" :message="$error" />
</div>
