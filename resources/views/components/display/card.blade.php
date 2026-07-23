@props([
    'title' => null,
    'description' => null,
])

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-6 shadow-sm flex flex-col justify-between transition-all duration-200']) }}>
    @if ($title || isset($header))
        <div class="mb-4 pb-4 border-b border-zinc-100 dark:border-zinc-800/80 flex items-center justify-between">
            @if (isset($header))
                {{ $header }}
            @else
                <div>
                    <h3 class="text-lg font-bold text-zinc-900 dark:text-white tracking-tight">{{ $title }}</h3>
                    @if ($description)
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1 leading-relaxed">{{ $description }}</p>
                    @endif
                </div>
            @endif
        </div>
    @endif

    <div class="flex-1 space-y-4">
        {{ $slot }}
    </div>

    @if (isset($footer))
        <div class="mt-6 pt-4 border-t border-zinc-100 dark:border-zinc-800/80 flex items-center justify-end gap-3">
            {{ $footer }}
        </div>
    @endif
</div>
