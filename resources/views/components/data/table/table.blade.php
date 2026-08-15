@props([
    'headers' => null,
    'striped' => false,
    'hover' => true,
    'compact' => false,
])

<div class="w-full overflow-x-auto rounded-xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 shadow-2xs">
    <table {{ $attributes->merge(['class' => 'w-full text-left border-collapse text-sm']) }}>
        @if (isset($header))
            <thead class="bg-zinc-50/80 dark:bg-zinc-800/60 border-b border-zinc-200 dark:border-zinc-800 text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 select-none">
                {{ $header }}
            </thead>
        @endif

        <tbody @class([
            'divide-y divide-zinc-200 dark:divide-zinc-800/80 text-zinc-800 dark:text-zinc-200',
            '[&>tr:nth-child(even)]:bg-zinc-50/50 dark:[&>tr:nth-child(even)]:bg-zinc-800/30' => $striped,
            '[&>tr]:hover:bg-zinc-50/80 dark:[&>tr]:hover:bg-zinc-800/50 [&>tr]:transition-colors' => $hover,
        ])>
            {{ $slot }}
        </tbody>

        @if (isset($footer))
            <tfoot class="bg-zinc-50/80 dark:bg-zinc-800/60 border-t border-zinc-200 dark:border-zinc-800 text-xs font-medium text-zinc-600 dark:text-zinc-400">
                {{ $footer }}
            </tfoot>
        @endif
    </table>
</div>
