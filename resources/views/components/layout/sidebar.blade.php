@props([
    'brand' => null,
    'collapsible' => true,
])

<div
    x-data="{ sidebarOpen: false }"
    x-on:open-sidebar.window="sidebarOpen = true"
    x-on:close-sidebar.window="sidebarOpen = false"
    class="relative"
>
    {{-- Mobile Backdrop --}}
    <div
        x-show="sidebarOpen"
        x-transition:enter="transition-opacity ease-linear duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        x-on:click="sidebarOpen = false"
        class="fixed inset-0 bg-black/60 backdrop-blur-xs z-40 lg:hidden"
        style="display: none;"
    ></div>

    {{-- Mobile Trigger Button --}}
    <div class="lg:hidden fixed top-3.5 left-4 z-30">
        <button
            type="button"
            x-on:click="sidebarOpen = !sidebarOpen"
            class="p-2 rounded-lg bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 text-zinc-700 dark:text-zinc-200 shadow-sm hover:bg-zinc-50 dark:hover:bg-zinc-800"
            aria-label="Toggle sidebar navigation"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </div>

    {{-- Sidebar Panel Container --}}
    <aside
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        {{ $attributes->merge(['class' => 'fixed lg:sticky top-0 bottom-0 lg:h-screen left-0 z-40 lg:z-30 w-64 shrink-0 bg-white dark:bg-zinc-950 border-r border-zinc-200 dark:border-zinc-800 p-4 flex flex-col justify-between transition-transform duration-200 ease-in-out overflow-y-auto scrollbar-thin']) }}
    >
        <div class="space-y-6">
            {{-- Header / Brand --}}
            <div class="flex items-center justify-between px-2 py-1">
                @if (isset($header))
                    {{ $header }}
                @elseif ($brand)
                    <div class="font-extrabold tracking-tight text-lg text-zinc-900 dark:text-white flex items-center gap-2">
                        {{ $brand }}
                    </div>
                @endif

                <button
                    type="button"
                    x-on:click="sidebarOpen = false"
                    class="lg:hidden p-1 rounded-lg text-zinc-400 hover:text-zinc-700 dark:hover:text-zinc-200"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Nav items --}}
            <nav class="space-y-1">
                {{ $slot }}
            </nav>
        </div>

        @if (isset($footer))
            <div class="pt-4 border-t border-zinc-100 dark:border-zinc-800/80">
                {{ $footer }}
            </div>
        @endif
    </aside>
</div>
