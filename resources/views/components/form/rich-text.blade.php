@props([
    'name' => null,
    'value' => null,
    'placeholder' => 'Write your content here...',
    'minHeight' => '180px',
    'invalid' => false,
    'disabled' => false,
    'toolbar' => 'full',
    'showCount' => false,
])

@php
    $wireModel = $attributes->wire('model');
    $hasWireModel = $wireModel->value() !== null;

    $borderClasses = $invalid
        ? 'border-red-600 dark:border-red-500 focus-within:border-red-600 focus-within:ring-1 focus-within:ring-red-600'
        : 'border-zinc-300 dark:border-zinc-700 focus-within:border-zinc-900 dark:focus-within:border-zinc-100 focus-within:ring-1 focus-within:ring-zinc-900 dark:focus-within:ring-zinc-100';
@endphp

<div
    x-data="{
        content: @if($hasWireModel) @entangle($wireModel) @else {{ json_encode($value ?? '') }} @endif,
        disabled: {{ $disabled ? 'true' : 'false' }},
        placeholder: '{{ addslashes($placeholder) }}',
        activeStates: {
            bold: false,
            italic: false,
            underline: false,
            strike: false,
            h1: false,
            h2: false,
            h3: false,
            ul: false,
            ol: false,
            quote: false,
            alignLeft: false,
            alignCenter: false,
            alignRight: false,
        },
        init() {
            if (this.$refs.editor) {
                this.$refs.editor.innerHTML = this.content || '';
                this.updateActiveStates();
            }
            this.$watch('content', (val) => {
                if (this.$refs.editor && this.$refs.editor.innerHTML !== val) {
                    this.$refs.editor.innerHTML = val || '';
                }
            });
        },
        onInput() {
            if (this.disabled) return;
            this.content = this.$refs.editor.innerHTML;
            if (this.$refs.hiddenInput) {
                this.$refs.hiddenInput.value = this.content;
                this.$refs.hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
            }
            this.updateActiveStates();
        },
        exec(command, value = null) {
            if (this.disabled) return;
            this.$refs.editor.focus();
            document.execCommand(command, false, value);
            this.onInput();
        },
        formatBlock(tag) {
            if (this.disabled) return;
            this.$refs.editor.focus();
            document.execCommand('formatBlock', false, tag);
            this.onInput();
        },
        addLink() {
            if (this.disabled) return;
            const url = prompt('Enter link URL (e.g. https://example.com):');
            if (url) {
                this.exec('createLink', url);
            }
        },
        removeLink() {
            if (this.disabled) return;
            this.exec('unlink');
        },
        updateActiveStates() {
            try {
                this.activeStates.bold = document.queryCommandState('bold');
                this.activeStates.italic = document.queryCommandState('italic');
                this.activeStates.underline = document.queryCommandState('underline');
                this.activeStates.strike = document.queryCommandState('strikeThrough');
                this.activeStates.ul = document.queryCommandState('insertUnorderedList');
                this.activeStates.ol = document.queryCommandState('insertOrderedList');
                this.activeStates.alignLeft = document.queryCommandState('justifyLeft');
                this.activeStates.alignCenter = document.queryCommandState('justifyCenter');
                this.activeStates.alignRight = document.queryCommandState('justifyRight');
            } catch (e) {}
        },
        get wordCount() {
            const text = (this.$refs.editor ? this.$refs.editor.innerText : '') || '';
            return text.trim() ? text.trim().split(/\s+/).length : 0;
        },
        get charCount() {
            return ((this.$refs.editor ? this.$refs.editor.innerText : '') || '').length;
        }
    }"
    {{ $attributes->whereDoesntStartWith('wire:model')->merge(['class' => "w-full rounded-xl bg-zinc-50 dark:bg-zinc-900/90 border shadow-2xs overflow-hidden transition-all duration-150 {$borderClasses} " . ($disabled ? 'opacity-60 cursor-not-allowed' : '')]) }}
>
    <!-- Hidden input for standard HTML form submission -->
    @if ($name)
        <input type="hidden" name="{{ $name }}" x-ref="hiddenInput" :value="content" />
    @endif

    <!-- Toolbar -->
    <div class="flex flex-wrap items-center gap-1 p-2 bg-zinc-100/80 dark:bg-zinc-800/80 border-b border-zinc-200 dark:border-zinc-700/80 text-zinc-700 dark:text-zinc-300 select-none">
        <!-- Formatting Tools: Bold, Italic, Underline, Strike -->
        <button
            type="button"
            x-on:click="exec('bold')"
            :class="activeStates.bold ? 'bg-zinc-200 dark:bg-zinc-700 text-zinc-900 dark:text-white font-bold' : 'hover:bg-zinc-200/70 dark:hover:bg-zinc-700/60'"
            class="p-1.5 rounded-lg transition-colors text-xs flex items-center justify-center w-7 h-7"
            title="Bold (Ctrl+B)"
            @if($disabled) disabled @endif
        >
            <span class="font-bold text-sm">B</span>
        </button>

        <button
            type="button"
            x-on:click="exec('italic')"
            :class="activeStates.italic ? 'bg-zinc-200 dark:bg-zinc-700 text-zinc-900 dark:text-white' : 'hover:bg-zinc-200/70 dark:hover:bg-zinc-700/60'"
            class="p-1.5 rounded-lg transition-colors text-xs flex items-center justify-center w-7 h-7"
            title="Italic (Ctrl+I)"
            @if($disabled) disabled @endif
        >
            <span class="italic font-serif text-sm">I</span>
        </button>

        <button
            type="button"
            x-on:click="exec('underline')"
            :class="activeStates.underline ? 'bg-zinc-200 dark:bg-zinc-700 text-zinc-900 dark:text-white' : 'hover:bg-zinc-200/70 dark:hover:bg-zinc-700/60'"
            class="p-1.5 rounded-lg transition-colors text-xs flex items-center justify-center w-7 h-7"
            title="Underline (Ctrl+U)"
            @if($disabled) disabled @endif
        >
            <span class="underline text-sm">U</span>
        </button>

        <button
            type="button"
            x-on:click="exec('strikeThrough')"
            :class="activeStates.strike ? 'bg-zinc-200 dark:bg-zinc-700 text-zinc-900 dark:text-white' : 'hover:bg-zinc-200/70 dark:hover:bg-zinc-700/60'"
            class="p-1.5 rounded-lg transition-colors text-xs flex items-center justify-center w-7 h-7"
            title="Strikethrough"
            @if($disabled) disabled @endif
        >
            <span class="line-through text-sm">S</span>
        </button>

        <span class="h-4 w-px bg-zinc-300 dark:bg-zinc-700 mx-1"></span>

        <!-- Headings: H1, H2, H3, Paragraph -->
        @if ($toolbar !== 'compact')
            <button
                type="button"
                x-on:click="formatBlock('<h1>')"
                class="px-2 py-1 rounded-lg hover:bg-zinc-200/70 dark:hover:bg-zinc-700/60 transition-colors text-xs font-bold"
                title="Heading 1"
                @if($disabled) disabled @endif
            >
                H1
            </button>

            <button
                type="button"
                x-on:click="formatBlock('<h2>')"
                class="px-2 py-1 rounded-lg hover:bg-zinc-200/70 dark:hover:bg-zinc-700/60 transition-colors text-xs font-bold"
                title="Heading 2"
                @if($disabled) disabled @endif
            >
                H2
            </button>

            <button
                type="button"
                x-on:click="formatBlock('<h3>')"
                class="px-2 py-1 rounded-lg hover:bg-zinc-200/70 dark:hover:bg-zinc-700/60 transition-colors text-xs font-bold"
                title="Heading 3"
                @if($disabled) disabled @endif
            >
                H3
            </button>

            <button
                type="button"
                x-on:click="formatBlock('<p>')"
                class="px-2 py-1 rounded-lg hover:bg-zinc-200/70 dark:hover:bg-zinc-700/60 transition-colors text-xs font-medium"
                title="Paragraph"
                @if($disabled) disabled @endif
            >
                ¶
            </button>

            <span class="h-4 w-px bg-zinc-300 dark:bg-zinc-700 mx-1"></span>
        @endif

        <!-- Lists & Quote -->
        <button
            type="button"
            x-on:click="exec('insertUnorderedList')"
            :class="activeStates.ul ? 'bg-zinc-200 dark:bg-zinc-700 text-zinc-900 dark:text-white' : 'hover:bg-zinc-200/70 dark:hover:bg-zinc-700/60'"
            class="p-1.5 rounded-lg transition-colors text-xs flex items-center justify-center w-7 h-7"
            title="Bulleted List"
            @if($disabled) disabled @endif
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>

        <button
            type="button"
            x-on:click="exec('insertOrderedList')"
            :class="activeStates.ol ? 'bg-zinc-200 dark:bg-zinc-700 text-zinc-900 dark:text-white' : 'hover:bg-zinc-200/70 dark:hover:bg-zinc-700/60'"
            class="p-1.5 rounded-lg transition-colors text-xs flex items-center justify-center w-7 h-7"
            title="Numbered List"
            @if($disabled) disabled @endif
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 6h13M7 12h13M7 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
        </button>

        <button
            type="button"
            x-on:click="formatBlock('<blockquote>')"
            class="p-1.5 rounded-lg hover:bg-zinc-200/70 dark:hover:bg-zinc-700/60 transition-colors text-xs flex items-center justify-center w-7 h-7 font-serif text-sm font-bold"
            title="Blockquote"
            @if($disabled) disabled @endif
        >
            “
        </button>

        <!-- Link & Code -->
        <span class="h-4 w-px bg-zinc-300 dark:bg-zinc-700 mx-1"></span>

        <button
            type="button"
            x-on:click="addLink()"
            class="p-1.5 rounded-lg hover:bg-zinc-200/70 dark:hover:bg-zinc-700/60 transition-colors text-xs flex items-center justify-center w-7 h-7"
            title="Insert Link"
            @if($disabled) disabled @endif
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/></svg>
        </button>

        <button
            type="button"
            x-on:click="removeLink()"
            class="p-1.5 rounded-lg hover:bg-zinc-200/70 dark:hover:bg-zinc-700/60 transition-colors text-xs flex items-center justify-center w-7 h-7 text-zinc-400"
            title="Remove Link"
            @if($disabled) disabled @endif
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
        </button>

        <!-- Alignments -->
        @if ($toolbar === 'full')
            <span class="h-4 w-px bg-zinc-300 dark:bg-zinc-700 mx-1"></span>

            <button
                type="button"
                x-on:click="exec('justifyLeft')"
                :class="activeStates.alignLeft ? 'bg-zinc-200 dark:bg-zinc-700 text-zinc-900 dark:text-white' : 'hover:bg-zinc-200/70 dark:hover:bg-zinc-700/60'"
                class="p-1.5 rounded-lg transition-colors text-xs flex items-center justify-center w-7 h-7"
                title="Align Left"
                @if($disabled) disabled @endif
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h10M4 18h14"/></svg>
            </button>

            <button
                type="button"
                x-on:click="exec('justifyCenter')"
                :class="activeStates.alignCenter ? 'bg-zinc-200 dark:bg-zinc-700 text-zinc-900 dark:text-white' : 'hover:bg-zinc-200/70 dark:hover:bg-zinc-700/60'"
                class="p-1.5 rounded-lg transition-colors text-xs flex items-center justify-center w-7 h-7"
                title="Align Center"
                @if($disabled) disabled @endif
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M7 12h10M5 18h14"/></svg>
            </button>

            <button
                type="button"
                x-on:click="exec('justifyRight')"
                :class="activeStates.alignRight ? 'bg-zinc-200 dark:bg-zinc-700 text-zinc-900 dark:text-white' : 'hover:bg-zinc-200/70 dark:hover:bg-zinc-700/60'"
                class="p-1.5 rounded-lg transition-colors text-xs flex items-center justify-center w-7 h-7"
                title="Align Right"
                @if($disabled) disabled @endif
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M10 12h10M6 18h14"/></svg>
            </button>
        @endif

        <!-- Clear formatting -->
        <div class="ml-auto flex items-center gap-1">
            <button
                type="button"
                x-on:click="exec('removeFormat')"
                class="p-1.5 rounded-lg hover:bg-zinc-200/70 dark:hover:bg-zinc-700/60 transition-colors text-xs flex items-center justify-center w-7 h-7 text-zinc-500 hover:text-zinc-900 dark:hover:text-white"
                title="Clear Formatting"
                @if($disabled) disabled @endif
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
        </div>
    </div>

    <!-- Contenteditable Area -->
    <div
        x-ref="editor"
        contenteditable="{{ $disabled ? 'false' : 'true' }}"
        x-on:input="onInput()"
        x-on:keyup="updateActiveStates()"
        x-on:mouseup="updateActiveStates()"
        x-on:focus="updateActiveStates()"
        style="min-height: {{ $minHeight }};"
        class="w-full p-4 text-sm text-zinc-900 dark:text-zinc-100 outline-none overflow-y-auto prose dark:prose-invert max-w-none focus:outline-none placeholder:text-zinc-400 empty:before:content-[attr(data-placeholder)] empty:before:text-zinc-400 dark:empty:before:text-zinc-500 empty:before:pointer-events-none"
        :data-placeholder="placeholder"
    ></div>

    <!-- Footer Stats / Count Bar -->
    @if ($showCount)
        <div class="px-3 py-1.5 bg-zinc-100/60 dark:bg-zinc-800/40 border-t border-zinc-200/60 dark:border-zinc-800/60 flex items-center justify-end gap-3 text-[11px] font-mono text-zinc-500 dark:text-zinc-400">
            <span>Words: <strong class="font-bold text-zinc-700 dark:text-zinc-300" x-text="wordCount">0</strong></span>
            <span>Characters: <strong class="font-bold text-zinc-700 dark:text-zinc-300" x-text="charCount">0</strong></span>
        </div>
    @endif
</div>
