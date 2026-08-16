@props([
    'align' => 'left', // 'left', 'center', 'right'
    'sortable' => false,
    'sorted' => null, // null, 'asc', 'desc'
])

@php
    $alignClass = match ($align) {
        'center' => 'text-center',
        'right' => 'text-right',
        default => 'text-left',
    };

    $justifyClass = match ($align) {
        'center' => 'justify-center',
        'right' => 'justify-end',
        default => 'justify-start',
    };

    $isSortable = filter_var($sortable, FILTER_VALIDATE_BOOLEAN) || !empty($sorted);
    $sortClass = $isSortable ? ' cursor-pointer select-none group/col hover:text-zinc-900 dark:hover:text-white transition-colors' : '';
@endphp

<th {{ $attributes->merge(['class' => "px-4 py-3 align-middle text-xs font-semibold uppercase tracking-wider text-zinc-500 dark:text-zinc-400 first:rounded-l-xl last:rounded-r-xl {$alignClass}{$sortClass}"]) }}>
    @if ($isSortable)
        <div class="inline-flex items-center gap-1.5 {{ $justifyClass }}">
            <span>{{ $slot }}</span>
            <span class="shrink-0 text-zinc-400 group-hover/col:text-zinc-600 dark:group-hover/col:text-zinc-300 transition-colors">
                @if ($sorted === 'asc')
                    <x-aura::icon name="chevron-up" size="xs" />
                @elseif ($sorted === 'desc')
                    <x-aura::icon name="chevron-down" size="xs" />
                @else
                    <x-aura::icon name="chevrons-up-down" size="xs" />
                @endif
            </span>
        </div>
    @else
        {{ $slot }}
    @endif
</th>
