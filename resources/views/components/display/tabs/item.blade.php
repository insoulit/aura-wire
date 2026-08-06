@props([
    'name' => '',
    'icon' => null,
])

<x-aura::tabs.tab :name="$name" :icon="$icon" {{ $attributes }}>
    {{ $slot }}
</x-aura::tabs.tab>
