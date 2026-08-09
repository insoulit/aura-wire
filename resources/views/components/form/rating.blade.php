@props([
    'rating' => 0,
    'max' => 5,
    'name' => null,
    'readonly' => false,
    'size' => 'md', // 'sm', 'md', 'lg', 'xl'
])

@php
    $wireModel = $attributes->wire('model');
    $hasWireModel = $attributes->has('wire:model') && isset($__livewire);
    $numRating = (float) $rating;

    $pixelSize = match ($size) {
        'sm' => 16,
        'md' => 20,
        'lg' => 24,
        'xl' => 32,
        default => 20,
    };

    $sizeClasses = match ($size) {
        'sm' => 'w-4 h-4',
        'md' => 'w-5 h-5',
        'lg' => 'w-6 h-6',
        'xl' => 'w-8 h-8',
        default => 'w-5 h-5',
    };
@endphp

<div
    x-data="{
        rating: @if($hasWireModel) @entangle($wireModel) @else {{ $numRating }} @endif,
        hoverRating: 0,
        readonly: {{ $readonly ? 'true' : 'false' }},
        setRating(val) {
            if (this.readonly) return;
            this.rating = val;
            if (this.$refs.hiddenInput) {
                this.$refs.hiddenInput.value = val;
                this.$refs.hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
            }
        }
    }"
    {{ $attributes->merge(['class' => 'inline-flex items-center gap-1']) }}
>
    @if ($name)
        <input ref="hiddenInput" type="hidden" name="{{ $name }}" :value="rating" />
    @endif

    @for ($i = 1; $i <= (int) $max; $i++)
        @php
            $initialWidth = '0%';
            if ($numRating >= $i) {
                $initialWidth = '100%';
            } elseif ($numRating >= ($i - 0.5)) {
                $initialWidth = '50%';
            }
        @endphp
        <button
            type="button"
            @click="setRating({{ $i }})"
            @mouseenter="if (!readonly) hoverRating = {{ $i }}"
            @mouseleave="if (!readonly) hoverRating = 0"
            :disabled="readonly"
            class="p-0.5 transition-transform hover:scale-110 focus:outline-none disabled:cursor-default cursor-pointer"
            aria-label="Rate {{ $i }} out of {{ $max }}"
        >
            <div class="relative {{ $sizeClasses }}">
                <!-- Base Empty Star (Zinc Gray) -->
                <svg class="{{ $sizeClasses }} text-zinc-300 dark:text-zinc-700 fill-current block" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>

                <!-- Active Filled Star Overlay (Monochrome Black / White) -->
                <div
                    class="absolute top-0 left-0 bottom-0 overflow-hidden text-zinc-900 dark:text-white pointer-events-none"
                    style="width: {{ $initialWidth }};"
                    :style="{ width: hoverRating ? (hoverRating >= {{ $i }} ? '100%' : '0%') : (rating >= {{ $i }} ? '100%' : (rating >= {{ $i }} - 0.5 ? '50%' : '0%')) }"
                >
                    <svg class="fill-current block shrink-0" style="width: {{ $pixelSize }}px; height: {{ $pixelSize }}px; max-width: none;" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                </div>
            </div>
        </button>
    @endfor
</div>
