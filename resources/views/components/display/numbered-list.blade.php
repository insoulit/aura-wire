@props([
    'items' => [],
    'titleKey' => 'title',
    'subtitleKey' => 'subtitle',
])

<div {{ $attributes->merge(['class' => 'space-y-4']) }}>
    @foreach($items as $index => $item)
        <div class="group relative bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-5 sm:p-6 hover:shadow-xl hover:shadow-zinc-900/5 dark:hover:shadow-white/5 hover:-translate-y-0.5 transition-all duration-300">
            {{-- Number Badge --}}
            <div class="absolute -top-3 -left-3 w-8 h-8 bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 rounded-full flex items-center justify-center font-bold text-xs shadow-md transform group-hover:scale-110 transition-transform duration-300">
                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
            </div>

            <div class="space-y-2">
                <p class="text-base sm:text-lg font-bold text-zinc-900 dark:text-white leading-tight tracking-tight">
                    @if(is_array($item))
                        {{ $item[$titleKey] ?? $item[0] ?? '' }}
                    @elseif(is_object($item))
                        {{ $item->{$titleKey} ?? '' }}
                    @else
                        {{ $item }}
                    @endif
                </p>
                @if(is_array($item) && isset($item[$subtitleKey]))
                    <p class="text-xs sm:text-sm text-zinc-500 dark:text-zinc-400 font-medium">
                        {{ $item[$subtitleKey] }}
                    </p>
                @elseif(is_object($item) && isset($item->{$subtitleKey}))
                    <p class="text-xs sm:text-sm text-zinc-500 dark:text-zinc-400 font-medium">
                        {{ $item->{$subtitleKey} }}
                    </p>
                @endif
            </div>
        </div>
    @endforeach

    @if (empty($items) && $slot->isNotEmpty())
        {{ $slot }}
    @endif
</div>
