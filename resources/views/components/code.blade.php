@props([
    'title' => null,
    'code' => null,
    'language' => 'blade',
    'active' => 'preview', // 'preview' | 'code'
    'showTabs' => true,
])

@php
    $rawCode = $code ?? (isset($codeSlot) ? (string) $codeSlot : null);
@endphp

<div
    x-data="{
        tab: '{{ $active }}',
        copied: false,
        codeText: @js($rawCode),
        copy() {
            let textToCopy = this.codeText;
            if (!textToCopy && this.$refs.codeContent) {
                textToCopy = this.$refs.codeContent.innerText.trim();
            }
            if (textToCopy) {
                navigator.clipboard.writeText(textToCopy);
                this.copied = true;
                setTimeout(() => this.copied = false, 2000);
            }
        }
    }"
    {{ $attributes->merge(['class' => 'rounded-xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 overflow-hidden shadow-2xs transition-all']) }}
>
    {{-- Header Bar with Title & Preview / Code Tabs & Copy Button --}}
    <div class="px-4 py-3 bg-zinc-50 dark:bg-zinc-900/60 border-b border-zinc-200 dark:border-zinc-800 flex items-center justify-between gap-4 select-none">
        <div class="flex items-center gap-3">
            @if ($title)
                <h4 class="text-xs font-bold uppercase tracking-wider text-zinc-900 dark:text-white font-mono">{{ $title }}</h4>
            @endif

            @if ($showTabs)
                <div class="flex items-center p-0.5 rounded-lg bg-zinc-200/80 dark:bg-zinc-800 text-xs font-medium">
                    <button
                        type="button"
                        x-on:click="tab = 'preview'"
                        :class="tab === 'preview' ? 'bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white shadow-2xs font-bold' : 'text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white'"
                        class="px-2.5 py-1 rounded-md transition-all cursor-pointer"
                    >
                        Preview
                    </button>
                    <button
                        type="button"
                        x-on:click="tab = 'code'"
                        :class="tab === 'code' ? 'bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white shadow-2xs font-bold' : 'text-zinc-500 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white'"
                        class="px-2.5 py-1 rounded-md transition-all cursor-pointer"
                    >
                        Code
                    </button>
                </div>
            @endif
        </div>

        <div class="flex items-center gap-2">
            <span class="text-[10px] font-mono uppercase tracking-wider px-2 py-0.5 rounded bg-zinc-200 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400">
                {{ $language }}
            </span>

            {{-- Copy Code Action Button --}}
            <button
                type="button"
                x-on:click="copy()"
                class="inline-flex items-center gap-1.5 px-2.5 py-1 text-xs font-medium rounded-md text-zinc-700 dark:text-zinc-300 hover:bg-zinc-200/60 dark:hover:bg-zinc-800 transition-colors cursor-pointer"
                title="Copy code to clipboard"
            >
                <template x-if="!copied">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                </template>
                <template x-if="copied">
                    <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                </template>
                <span x-text="copied ? 'Copied!' : 'Copy'"></span>
            </button>
        </div>
    </div>

    {{-- Live Component Preview Area --}}
    <div x-show="tab === 'preview'" class="p-6 bg-white dark:bg-zinc-950 flex flex-wrap items-center justify-center gap-4 min-h-[120px]">
        @if (isset($preview))
            {{ $preview }}
        @else
            {{ $slot }}
        @endif
    </div>

    {{-- Formatted Code Display Area --}}
    <div x-show="tab === 'code'" class="bg-zinc-950 text-zinc-100 dark:bg-black p-4 overflow-x-auto font-mono text-xs leading-relaxed border-t border-zinc-900" style="display: none;">
        <pre x-ref="codeContent"><code>@if (isset($codeSlot)){{ $codeSlot }}@elseif($rawCode){{ $rawCode }}@else{{ $slot }}@endif</code></pre>
    </div>
</div>
