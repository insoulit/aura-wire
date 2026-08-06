@props([
    'variant' => 'secondary',
    'size' => 'md',
    'shape' => 'circle',
    'type' => 'button',
    'href' => null,
    'icon' => null,
    'label' => null,
    'ariaLabel' => null,
    'disabled' => false,
    'loading' => null,
])

<x-aura::icon-button
    :variant="$variant"
    :size="$size"
    :shape="$shape"
    :type="$type"
    :href="$href"
    :icon="$icon"
    :label="$label"
    :ariaLabel="$ariaLabel"
    :disabled="$disabled"
    :loading="$loading"
    {{ $attributes }}
>
    {{ $slot }}
</x-aura::icon-button>
