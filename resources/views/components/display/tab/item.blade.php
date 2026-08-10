@props([
    'name' => '',
    'icon' => null,
])

<x-aura::tab.tab :name="$name" :icon="$icon" {{ $attributes }}>
    {{ $slot }}
</x-aura::tab.tab>
