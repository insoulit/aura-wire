@props([
    'label' => null,
    'description' => null,
])

<label class="inline-flex items-start gap-3 cursor-pointer group select-none">
    <div class="relative flex items-center mt-0.5">
        <input
            type="checkbox"
            {{ $attributes->merge(['class' => 'peer sr-only']) }}
        />
        <div class="w-4 h-4 rounded-sm border border-zinc-400 dark:border-zinc-600 bg-white dark:bg-zinc-900 peer-checked:bg-zinc-900 dark:peer-checked:bg-white peer-checked:border-zinc-900 dark:peer-checked:border-white peer-focus-visible:ring-2 peer-focus-visible:ring-zinc-900 dark:peer-focus-visible:ring-white peer-focus-visible:ring-offset-2 transition-all flex items-center justify-center shadow-2xs']) }}>
            <svg class="w-3 h-3 text-white dark:text-zinc-900 opacity-0 peer-checked:opacity-100 transition-opacity stroke-current" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
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
