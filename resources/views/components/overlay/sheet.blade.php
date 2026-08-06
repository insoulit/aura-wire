<x-aura::feedback.sheet {{ $attributes }}>
    @if (isset($header)) <x-slot:header>{{ $header }}</x-slot:header> @endif
    @if (isset($footer)) <x-slot:footer>{{ $footer }}</x-slot:footer> @endif
    {{ $slot }}
</x-aura::feedback.sheet>
