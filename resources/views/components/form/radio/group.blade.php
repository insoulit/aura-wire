@props([
    'label' => null,
    'description' => null,
    'vertical' => true,
])

<div {{ $attributes->merge(['class' => 'space-y-2']) }}>
    @if ($label)
        <legend class="block text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400">
            {{ $label }}
        </legend>
    @endif

    <div class="{{ $vertical ? 'flex flex-col space-y-2.5' : 'flex flex-wrap items-center gap-4' }}">
        {{ $slot }}
    </div>

    @if ($description)
        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">{{ $description }}</p>
    @endif
</div>
