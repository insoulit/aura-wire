@props([
    'items' => [], // Array of ['label' => '...', 'href' => '...']
])

<nav
    class="flex"
    aria-label="Breadcrumb"
    {{ $attributes }}
>
    <ol class="inline-flex items-center space-x-1 sm:space-x-2 text-sm text-zinc-500 dark:text-zinc-400">
        @if (count($items) > 0)
            @foreach ($items as $index => $item)
                @if ($index > 0)
                    <li>
                        <svg class="w-4 h-4 text-zinc-400 dark:text-zinc-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </li>
                @endif
                <li>
                    @if (isset($item['href']) && $index < count($items) - 1)
                        <a href="{{ $item['href'] }}" class="hover:text-zinc-900 dark:hover:text-white font-medium transition-colors">
                            {{ $item['label'] }}
                        </a>
                    @else
                        <span class="font-semibold text-zinc-900 dark:text-white">
                            {{ $item['label'] ?? $item }}
                        </span>
                    @endif
                </li>
            @endforeach
        @else
            {{ $slot }}
        @endif
    </ol>
</nav>
