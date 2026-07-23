@props([
    'vertical' => false,
    'label' => null,
])

@if ($vertical)
    <div {{ $attributes->merge(['class' => 'inline-block self-stretch w-px bg-zinc-200 dark:bg-zinc-800 my-1']) }} role="separator"></div>
@else
    @if ($label)
        <div class="relative flex py-2 items-center w-full" role="separator">
            <div class="flex-grow border-t border-zinc-200 dark:border-zinc-800"></div>
            <span class="flex-shrink mx-4 text-xs font-semibold uppercase tracking-wider text-zinc-400 dark:text-zinc-500">{{ $label }}</span>
            <div class="flex-grow border-t border-zinc-200 dark:border-zinc-800"></div>
        </div>
    @else

        <hr {{ $attributes->merge(['class' => 'w-full border-t border-zinc-200 dark:border-zinc-800 my-4']) }} role="separator" />
    @endif
@endif
