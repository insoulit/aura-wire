@props([
    'label' => 'Click to upload or drag and drop',
    'hint' => 'SVG, PNG, JPG, GIF or PDF',
    'disabled' => false,
])

<div class="flex w-full items-center justify-center">
    <label
        class="relative flex h-52 w-full cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-zinc-300 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-900/50 hover:bg-zinc-100 dark:hover:bg-zinc-800/80 hover:border-zinc-400 dark:hover:border-zinc-600 transition-all duration-200 group {{ $disabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}"
    >
        <div class="flex flex-col items-center justify-center pb-6 pt-5 px-4 text-center">
            <svg
                class="mb-3 h-10 w-10 text-zinc-400 dark:text-zinc-500 group-hover:text-zinc-600 dark:group-hover:text-zinc-300 transition-colors duration-200"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 20 16"
            >
                <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"
                />
            </svg>
            <p class="mb-1 text-sm text-zinc-600 dark:text-zinc-300 font-medium">
                {{ $label }}
            </p>
            @if ($hint)
                <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $hint }}</p>
            @endif
        </div>
        <input
            type="file"
            @if($disabled) disabled @endif
            {{ $attributes->merge(['class' => 'hidden']) }}
        />
    </label>
</div>
