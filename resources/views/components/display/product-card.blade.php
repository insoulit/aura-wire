@props([
    'title' => null,
    'subtitle' => null,
    'price' => null,
    'originalPrice' => null,
    'badge' => null,
    'image' => null,
    'href' => null,
])

<div {{ $attributes->merge(['class' => 'group relative flex flex-col overflow-hidden rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 shadow-xs hover:shadow-xl hover:shadow-zinc-900/5 dark:hover:shadow-white/5 transition-all duration-300']) }}>
    @if ($badge)
        <div class="absolute top-3 left-3 z-10">
            <span class="inline-flex items-center rounded-full bg-zinc-900/90 dark:bg-white/90 backdrop-blur-md px-3 py-1 text-xs font-semibold text-white dark:text-zinc-900 shadow-sm">
                {{ $badge }}
            </span>
        </div>
    @endif

    @if ($image)
        <div class="aspect-4/3 w-full overflow-hidden bg-zinc-100 dark:bg-zinc-800">
            <img src="{{ $image }}" alt="{{ $title }}" class="h-full w-full object-cover object-center group-hover:scale-105 transition-transform duration-300" />
        </div>
    @endif

    <div class="flex flex-1 flex-col justify-between p-5 space-y-4">
        <div>
            @if ($subtitle)
                <p class="text-xs font-medium text-zinc-400 dark:text-zinc-500 uppercase tracking-wider mb-1">{{ $subtitle }}</p>
            @endif

            @if ($title)
                <h4 class="text-base sm:text-lg font-bold text-zinc-900 dark:text-white tracking-tight leading-snug">
                    @if ($href)
                        <a href="{{ $href }}" class="hover:underline">{{ $title }}</a>
                    @else
                        {{ $title }}
                    @endif
                </h4>
            @endif
        </div>

        <div class="flex items-center justify-between pt-2">
            @if ($price)
                <div class="flex items-baseline gap-2">
                    <span class="text-lg font-extrabold text-zinc-900 dark:text-white">{{ $price }}</span>
                    @if ($originalPrice)
                        <span class="text-xs text-zinc-400 dark:text-zinc-500 line-through">{{ $originalPrice }}</span>
                    @endif
                </div>
            @endif

            @if ($slot->isNotEmpty())
                <div>
                    {{ $slot }}
                </div>
            @endif
        </div>
    </div>
</div>
