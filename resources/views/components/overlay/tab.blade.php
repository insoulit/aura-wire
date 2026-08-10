@props([
    'active' => null,
])

<div x-data="{ activeTab: '{{ $active }}' }" {{ $attributes->merge(['class' => 'w-full']) }}>
    <div class="border-b border-zinc-200 dark:border-zinc-800">
        <nav class="-mb-px flex space-x-6 overflow-x-auto" aria-label="Tabs">
            {{ $slot }}
        </nav>
    </div>
</div>
