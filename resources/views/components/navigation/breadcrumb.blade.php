@props([
    'items' => [], // Array of ['label' => '...', 'href' => '...', 'icon' => '...']
    'separator' => 'chevron', // 'chevron', 'slash', 'dot', 'arrow'
    'variant' => 'plain', // 'plain', 'rectangle', 'bar', 'pills'
    'homeIcon' => false,
])

@php
    $itemsArray = is_array($items) ? $items : iterator_to_array($items);

    $containerClasses = match ($variant) {
        'rectangle', 'bar', 'card' => 'px-4 py-2.5 rounded-lg bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 shadow-2xs',
        'pills' => 'p-1.5 rounded-full bg-zinc-100 dark:bg-zinc-800/90 border border-zinc-200 dark:border-zinc-700/80 inline-flex items-center shadow-2xs',
        default => '',
    };
@endphp

<nav aria-label="Breadcrumb" {{ $attributes->merge(['class' => "flex items-center {$containerClasses}"]) }}>
    <ol class="inline-flex items-center flex-wrap gap-1.5 sm:gap-2 text-sm text-zinc-500 dark:text-zinc-400">
        @if (count($itemsArray) > 0)
            @foreach ($itemsArray as $index => $item)
                @php
                    $label = is_array($item) ? ($item['label'] ?? $item[0] ?? '') : (is_object($item) ? ($item->label ?? '') : $item);
                    $href = is_array($item) ? ($item['href'] ?? null) : (is_object($item) ? ($item->href ?? null) : null);
                    $icon = is_array($item) ? ($item['icon'] ?? null) : (is_object($item) ? ($item->icon ?? null) : null);
                    $isLast = $index === count($itemsArray) - 1;
                    $isFirst = $index === 0;
                @endphp

                @if ($index > 0)
                    <li class="shrink-0 text-zinc-400 dark:text-zinc-600 select-none flex items-center">
                        @if ($separator === 'slash')
                            <span class="text-xs font-mono font-bold text-zinc-400 dark:text-zinc-600 px-0.5">/</span>
                        @elseif ($separator === 'dot' || $separator === 'bullet')
                            <span class="w-1.5 h-1.5 rounded-full bg-zinc-400 dark:bg-zinc-600"></span>
                        @elseif ($separator === 'arrow')
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        @else
                            {{-- Default Chevron --}}
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        @endif
                    </li>
                @endif

                <li class="flex items-center shrink-0">
                    @php
                        $itemClasses = match ($variant) {
                            'pills' => $isLast
                                ? 'px-3.5 py-1 rounded-full bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white font-bold shadow-xs border border-zinc-200 dark:border-zinc-700 text-xs'
                                : 'px-3.5 py-1 rounded-full text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white font-semibold hover:bg-white/70 dark:hover:bg-zinc-700/60 transition-all text-xs',
                            default => $isLast
                                ? 'font-bold text-zinc-900 dark:text-white'
                                : 'font-medium text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white transition-colors',
                        };
                    @endphp

                    @if ($href && !$isLast)
                        <a href="{{ $href }}" class="inline-flex items-center gap-1.5 {{ $itemClasses }}">
                            @if ($isFirst && ($homeIcon || $icon === 'home'))
                                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            @elseif ($icon)
                                <x-aura::icon :name="$icon" size="xs" />
                            @endif
                            <span>{{ $label }}</span>
                        </a>
                    @else
                        <span class="inline-flex items-center gap-1.5 {{ $itemClasses }}">
                            @if ($isFirst && ($homeIcon || $icon === 'home'))
                                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            @elseif ($icon)
                                <x-aura::icon :name="$icon" size="xs" />
                            @endif
                            <span>{{ $label }}</span>
                        </span>
                    @endif
                </li>
            @endforeach
        @else
            {{ $slot }}
        @endif
    </ol>
</nav>
