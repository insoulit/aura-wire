@props([
    'length' => 4,
    'size' => 'md',
    'invalid' => false,
    'disabled' => false,
])

@php
    $sizeClasses = match ($size) {
        'sm' => 'h-10 w-10 text-base rounded-md',
        'md' => 'h-12 w-12 text-lg rounded-lg',
        'lg' => 'h-14 w-14 text-xl rounded-xl',
        default => 'h-12 w-12 text-lg rounded-lg',
    };

    $borderClasses = $invalid
        ? 'border-red-600 dark:border-red-500 focus:border-red-600 focus:ring-1 focus:ring-red-600'
        : 'border-zinc-300 dark:border-zinc-700 focus:border-zinc-900 dark:focus:border-zinc-100 focus:ring-1 focus:ring-zinc-900 dark:focus:ring-zinc-100';
@endphp

<div
    x-data="{
        handleInput(e, index) {
            if (e.target.value.length >= 1) {
                let next = this.$refs['pin_' + (index + 1)];
                if (next) next.focus();
            }
        },
        handleKeydown(e, index) {
            if (e.key === 'Backspace' && !e.target.value) {
                let prev = this.$refs['pin_' + (index - 1)];
                if (prev) prev.focus();
            }
        }
    }"
    {{ $attributes->merge(['class' => 'flex items-center gap-2']) }}
>
    @for ($i = 0; $i < $length; $i++)
        <input
            type="text"
            maxlength="1"
            inputmode="numeric"
            pattern="[0-9]*"
            x-ref="pin_{{ $i }}"
            x-on:input="handleInput($event, {{ $i }})"
            x-on:keydown="handleKeydown($event, {{ $i }})"
            @if($disabled) disabled @endif
            class="block bg-zinc-50 dark:bg-zinc-900/90 text-center font-semibold text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500 border transition-all duration-150 shadow-2xs outline-none disabled:opacity-50 disabled:cursor-not-allowed {{ $sizeClasses }} {{ $borderClasses }}"
        />
    @endfor
</div>
