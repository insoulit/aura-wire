@props([
    'container' => true,
    'hasSidebar' => true,
])

<main {{ $attributes->merge(['class' => 'flex-1 min-w-0 transition-all duration-200 ' . ($hasSidebar ? 'lg:pl-64' : '')]) }}>
    @if ($container)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
            {{ $slot }}
        </div>
    @else
        {{ $slot }}
    @endif
</main>
