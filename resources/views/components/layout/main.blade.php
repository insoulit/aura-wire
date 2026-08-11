@props([
    'container' => true,
    'hasSidebar' => false,
    'alignX' => 'center', // 'center', 'start', 'end'
    'alignY' => 'center', // 'center', 'start', 'end'
])

@php
    $xClass = match ($alignX) {
        'start' => 'items-start',
        'end' => 'items-end',
        default => 'items-center',
    };

    $yClass = match ($alignY) {
        'start' => 'justify-start',
        'end' => 'justify-end',
        default => 'justify-center',
    };
@endphp

<main {{ $attributes->merge(['class' => "flex-1 min-w-0 w-full flex flex-col {$xClass} {$yClass} transition-all duration-200 " . ($hasSidebar ? 'lg:pl-64' : '')]) }}>
    @if ($container)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 w-full flex-1 flex flex-col {{ $xClass }} {{ $yClass }} space-y-8">
            {{ $slot }}
        </div>
    @else
        {{ $slot }}
    @endif
</main>
