@props([
    'multiple' => false,
    'default' => null,
    'bordered' => true,
    'border' => null,
    'divided' => true,
])

@php
    $isBordered = $border !== null ? filter_var($border, FILTER_VALIDATE_BOOLEAN) : filter_var($bordered, FILTER_VALIDATE_BOOLEAN);
    $isDivided = filter_var($divided, FILTER_VALIDATE_BOOLEAN);

    $borderClass = $isBordered ? 'border-y border-zinc-200 dark:border-zinc-800' : '';
    $divideClass = $isDivided ? 'divide-y divide-zinc-200 dark:divide-zinc-800' : '';
@endphp

<div
    x-data="{
        multiple: {{ $multiple ? 'true' : 'false' }},
        active: {{ json_encode($default ? (is_array($default) ? $default : [$default]) : []) }},
        isOpen(id) {
            return this.active.includes(id);
        },
        toggle(id) {
            if (this.multiple) {
                if (this.active.includes(id)) {
                    this.active = this.active.filter(i => i !== id);
                } else {
                    this.active.push(id);
                }
            } else {
                this.active = this.active.includes(id) ? [] : [id];
            }
        }
    }"
    {{ $attributes->merge(['class' => "w-full {$divideClass} {$borderClass}"]) }}
>
    {{ $slot }}
</div>
