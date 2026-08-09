@props([
    'placeholder' => 'Type a command or search...',
    'key' => 'k',
])

<div
    x-data="{
        open: false,
        search: '',
        init() {
            window.addEventListener('keydown', (e) => {
                if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === '{{ strtolower($key) }}') {
                    e.preventDefault();
                    this.open = !this.open;
                }
            });
        }
    }"
    x-on:open-command.window="open = true"
    x-on:close-command.window="open = false"
    x-on:keydown.escape.window="open = false"
>
    <template x-teleport="body">
        <div
            x-show="open"
            class="fixed inset-0 z-50 p-4 sm:p-6 md:p-20 flex items-start justify-center"
            style="display: none;"
        >
            {{-- Backdrop --}}
            <div
                x-show="open"
                x-transition:enter="ease-out duration-200"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/60 backdrop-blur-xs transition-opacity"
                @click="open = false"
            ></div>

            {{-- Palette Container --}}
            <div
                x-show="open"
                x-transition:enter="ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="relative w-full max-w-2xl overflow-hidden rounded-2xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 shadow-2xl z-10"
            >
                {{-- Search Input Bar --}}
                <div class="flex items-center border-b border-zinc-200 dark:border-zinc-800 px-4">
                    <svg class="w-5 h-5 text-zinc-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input
                        x-model="search"
                        type="text"
                        placeholder="{{ $placeholder }}"
                        class="w-full bg-transparent px-3 py-4 text-sm text-zinc-900 dark:text-white placeholder-zinc-400 outline-none border-none focus:ring-0"
                        x-init="$watch('open', value => value && setTimeout(() => $el.focus(), 50))"
                    />
                    <kbd class="hidden sm:inline-block px-2 py-0.5 text-xs font-mono font-semibold text-zinc-400 bg-zinc-100 dark:bg-zinc-800 rounded-md border border-zinc-200 dark:border-zinc-700">ESC</kbd>
                </div>

                {{-- Results Slot --}}
                <div class="max-h-96 overflow-y-auto p-2 space-y-1">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </template>
</div>
