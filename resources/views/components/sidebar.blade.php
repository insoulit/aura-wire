@props([
    'title' => null,
])

<aside {{ $attributes->merge(['class' => 'w-64 shrink-0 min-h-screen bg-white dark:bg-zinc-950 border-r border-zinc-200 dark:border-zinc-800 p-4 flex flex-col justify-between']) }}>
    <div class="space-y-6">
        @if ($title || isset($header))
            <div class="px-3 py-2 flex items-center justify-between border-b border-zinc-100 dark:border-zinc-800">
                @if (isset($header))
                    {{ $header }}
                @else
                    <span class="font-black tracking-tight text-lg text-zinc-900 dark:text-white">{{ $title }}</span>
                @endif
            </div>
        @endif

        <nav class="space-y-1">
            {{ $slot }}
        </nav>
    </div>

    @if (isset($footer))
        <div class="pt-4 border-t border-zinc-100 dark:border-zinc-800">
            {{ $footer }}
        </div>
    @endif
</aside>
