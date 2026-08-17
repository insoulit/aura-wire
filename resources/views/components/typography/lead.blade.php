@props([
    'as' => 'p',
    'size' => 'lg', // '2xl' | 'xl' | 'lg' | 'md' | 'sm'
    'variant' => 'default',
    'weight' => 'normal',
    'align' => null,
    'pretty' => true,
])

<x-aura::typography.subheading
    :as="$as"
    :size="$size"
    :variant="$variant"
    :weight="$weight"
    :align="$align"
    :pretty="$pretty"
    {{ $attributes }}
>
    {{ $slot }}
</x-aura::typography.subheading>
