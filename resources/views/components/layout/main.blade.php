@props([
    'container' => true,
    'hasSidebar' => false,
    'alignX' => 'stretch', // 'stretch', 'center', 'start', 'end'
    'alignY' => 'start', // 'start', 'center', 'end'
])

@php
    $xClass = match ($alignX) {
        'start' => 'items-start',
        'end' => 'items-end',
        'center' => 'items-center',
        default => 'items-stretch',
    };

    $yClass = match ($alignY) {
        'center' => 'justify-center',
        'end' => 'justify-end',
        default => 'justify-start',
    };
@endphp

<main {{ $attributes->merge(['class' => "flex-1 min-w-0 w-full flex flex-col {$xClass} {$yClass} transition-all duration-200 " . ($hasSidebar ? 'lg:pl-64' : '')]) }}>
    @if ($container)
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full flex-1 flex flex-col {{ $xClass }} {{ $yClass }} space-y-8">
            {{ $slot }}
        </div>
    @else
        {{ $slot }}
    @endif
</main>
