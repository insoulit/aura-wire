@props([
    'multiple' => false,
    'default' => null,
])

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
    {{ $attributes->merge(['class' => 'w-full divide-y divide-zinc-200 dark:divide-zinc-800 border-y border-zinc-200 dark:border-zinc-800']) }}
>
    {{ $slot }}
</div>
