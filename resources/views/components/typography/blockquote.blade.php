@props([
    'author' => null,
    'cite' => null,
    'avatar' => null,
    'variant' => 'default', // 'default' | 'subtle' | 'accent' | 'dark'
    'size' => 'md', // 'sm' | 'md' | 'lg' | 'xl'
    'border' => true,
])

@php
    $sizeClasses = match ($size) {
        'sm' => 'text-sm leading-relaxed',
        'lg' => 'text-lg sm:text-xl leading-relaxed',
        'xl' => 'text-xl sm:text-2xl leading-relaxed',
        default => 'text-base sm:text-lg leading-relaxed',
    };

    $borderClasses = $border ? 'pl-4 sm:pl-6 border-l-2 sm:border-l-4 border-zinc-900 dark:border-white' : '';

    $variantClasses = match ($variant) {
        'accent' => 'text-zinc-900 dark:text-white font-medium',
        'subtle' => 'text-zinc-600 dark:text-zinc-400',
        'dark' => 'text-zinc-900 dark:text-zinc-100',
        default => 'text-zinc-800 dark:text-zinc-200',
    };
@endphp

<figure {{ $attributes->merge(['class' => "space-y-3 {$borderClasses}"]) }}>
    <blockquote class="italic {{ $sizeClasses }} {{ $variantClasses }} text-pretty">
        <p>{{ $slot }}</p>
    </blockquote>

    @if ($author || $cite || isset($footer))
        <figcaption class="flex items-center gap-3 text-xs sm:text-sm text-zinc-600 dark:text-zinc-400 not-italic">
            @if ($avatar)
                <img src="{{ $avatar }}" alt="{{ $author }}" class="w-6 h-6 sm:w-8 sm:h-8 rounded-full object-cover shrink-0" />
            @endif

            @if (isset($footer))
                {{ $footer }}
            @else
                <div class="flex items-center gap-1.5 flex-wrap font-medium">
                    @if ($author)
                        <span class="font-semibold text-zinc-900 dark:text-white">{{ $author }}</span>
                    @endif
                    @if ($author && $cite)
                        <span class="text-zinc-400 dark:text-zinc-600">&bull;</span>
                    @endif
                    @if ($cite)
                        <cite class="not-italic text-zinc-500 dark:text-zinc-400">{{ $cite }}</cite>
                    @endif
                </div>
            @endif
        </figcaption>
    @endif
</figure>
