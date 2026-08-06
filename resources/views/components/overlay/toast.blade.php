<x-aura::feedback.toast {{ $attributes }}>
    @if (isset($icon)) <x-slot:icon>{{ $icon }}</x-slot:icon> @endif
    @if (isset($action)) <x-slot:action>{{ $action }}</x-slot:action> @endif
    {{ $slot }}
</x-aura::feedback.toast>
