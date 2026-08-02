@props([
    'paginator' => null,
])

<nav
    role="navigation"
    aria-label="Pagination Navigation"
    {{ $attributes->merge(['class' => 'flex items-center justify-between border-t border-zinc-200 dark:border-zinc-800 px-4 py-3 sm:px-6']) }}
>
    @if ($paginator && method_exists($paginator, 'links'))
        {{ $paginator->links() }}
    @else
        <div class="flex flex-1 justify-between sm:hidden">
            {{ $slot }}
        </div>
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
            {{ $slot }}
        </div>
    @endif
</nav>
