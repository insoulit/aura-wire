@props([
    'items' => [],
    'variant' => 'card', // 'card', 'grid', 'media', 'compact', 'simple'
    'numbered' => false,
    'titleKey' => 'title',
    'subtitleKey' => 'subtitle',
    'descriptionKey' => 'description',
    'imageKey' => 'image',
    'badgeKey' => 'badge',
    'iconKey' => 'icon',
])

<x-aura::data.numbered-list
    :items="$items"
    :variant="$variant"
    :numbered="$numbered"
    :titleKey="$titleKey"
    :subtitleKey="$subtitleKey"
    :descriptionKey="$descriptionKey"
    :imageKey="$imageKey"
    :badgeKey="$badgeKey"
    :iconKey="$iconKey"
    {{ $attributes }}
>
    {{ $slot }}
</x-aura::data.numbered-list>
