@props([
    'label' => null,
    'description' => null,
    'value' => null,
])

<label class="inline-flex items-start gap-3 cursor-pointer group select-none">
    <div class="relative flex items-center mt-0.5">
        <input
            type="radio"
            value="{{ $value }}"
            {{ $attributes->merge(['class' => 'peer sr-only']) }}
        />
        <div class="w-4 h-4 rounded-full border border-zinc-400 dark:border-zinc-600 bg-white dark:bg-zinc-900 peer-checked:border-zinc-900 dark:peer-checked:border-white peer-focus-visible:ring-2 peer-focus-visible:ring-zinc-900 dark:peer-focus-visible:ring-white peer-focus-visible:ring-offset-2 transition-all flex items-center justify-center shadow-2xs">
            <div class="w-2 h-2 rounded-full bg-zinc-900 dark:bg-white opacity-0 peer-checked:opacity-100 transition-opacity"></div>
        </div>
    </div>

    @if ($label || $slot->isNotEmpty())
        <div class="flex flex-col">
            <span class="text-sm font-medium text-zinc-900 dark:text-zinc-100 group-hover:text-zinc-700 dark:group-hover:text-zinc-300">
                {{ $label ?? $slot }}
            </span>
            @if ($description)
                <span class="text-xs text-zinc-500 dark:text-zinc-400 leading-normal">{{ $description }}</span>
            @endif
        </div>
    @endif
</label>
