@props([
    'options' => [],
    'name' => null,
    'placeholder' => 'Select option...',
    'label' => null,
    'value' => null,
])

@php
    $wireModel = $attributes->wire('model');
    $hasWireModel = $attributes->has('wire:model') && isset($__livewire);

    // Normalize options array into standard label/value format
    $normalizedOptions = collect($options)->map(function ($opt, $key) {
        if (is_array($opt)) {
            return ['value' => $opt['value'] ?? $key, 'label' => $opt['label'] ?? $opt['name'] ?? $key];
        }
        return ['value' => $key, 'label' => $opt];
    })->values()->toArray();
@endphp

<div
    x-data="{
        open: false,
        search: '',
        selected: @if($hasWireModel) @entangle($wireModel) @else {{ json_encode($value) }} @endif,
        options: {{ json_encode($normalizedOptions) }},
        get filteredOptions() {
            if (!this.search) return this.options;
            return this.options.filter(o => o.label.toLowerCase().includes(this.search.toLowerCase()));
        },
        get selectedLabel() {
            const found = this.options.find(o => o.value == this.selected);
            return found ? found.label : '';
        },
        select(optValue) {
            this.selected = optValue;
            this.open = false;
            this.search = '';
            if (this.$refs.hiddenInput) {
                this.$refs.hiddenInput.value = optValue;
                this.$refs.hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
            }
        }
    }"
    @click.outside="open = false"
    :class="open ? 'relative w-full space-y-1 z-30' : 'relative w-full space-y-1 z-0'"
>
    @if ($label)
        <x-aura::label>{{ $label }}</x-aura::label>
    @endif

    @if ($name)
        <input ref="hiddenInput" type="hidden" name="{{ $name }}" :value="selected" />
    @endif

    <button
        type="button"
        @click="open = !open"
        class="w-full bg-zinc-50 dark:bg-zinc-900/90 text-zinc-900 dark:text-white border border-zinc-300 dark:border-zinc-700 rounded-md p-3 text-sm text-left flex items-center justify-between shadow-2xs outline-none focus:border-zinc-900 dark:focus:border-zinc-100 cursor-pointer"
    >
        <span x-text="selectedLabel || '{{ $placeholder }}'" :class="{ 'text-zinc-400': !selectedLabel }"></span>
        <svg class="w-4 h-4 text-zinc-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute left-0 right-0 z-50 mt-1 rounded-xl bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 shadow-xl p-2 space-y-1 max-h-60 overflow-y-auto"
        style="display: none;"
    >
        <input
            x-model="search"
            type="text"
            placeholder="Filter..."
            class="w-full bg-zinc-100 dark:bg-zinc-800 text-zinc-900 dark:text-white rounded-lg p-2 text-xs border-none outline-none focus:ring-1 focus:ring-zinc-900 dark:focus:ring-white mb-1"
        />

        <template x-for="opt in filteredOptions" :key="opt.value">
            <button
                type="button"
                @click="select(opt.value)"
                class="w-full text-left px-3 py-2 text-xs rounded-lg flex items-center justify-between hover:bg-zinc-100 dark:hover:bg-zinc-800 text-zinc-900 dark:text-zinc-100 transition-colors cursor-pointer"
                :class="{ 'font-bold bg-zinc-100 dark:bg-zinc-800': selected == opt.value }"
            >
                <span x-text="opt.label"></span>
                <span x-show="selected == opt.value" class="text-zinc-900 dark:text-white font-bold">
                    <svg class="w-4 h-4 text-zinc-900 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </span>
            </button>
        </template>
    </div>
</div>
