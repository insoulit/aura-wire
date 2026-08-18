@props([
    'size' => 'xl', // '3xl' | '2xl' | 'xl' | 'lg' | 'md' | 'sm'
    'as' => 'h1',
    'weight' => 'extrabold', // 'black' | 'extrabold' | 'bold' | 'semibold' | 'medium' | 'normal'
    'gradient' => false, // false | true | 'default' | 'primary' | 'sunset' | 'ocean' | 'emerald'
    'align' => null, // 'left' | 'center' | 'right' | 'justify'
    'balance' => true,
    'tracking' => null, // 'tighter' | 'tight' | 'normal' | 'wide'
    'truncate' => false,
    'nowrap' => false,
])

@php
    $tag = $as;

    $sizeClasses = match ($size) {
        '3xl' => 'text-6xl sm:text-7xl lg:text-9xl leading-none',
        '2xl' => 'text-5xl sm:text-6xl lg:text-8xl leading-none',
        'xl' => 'text-4xl sm:text-5xl lg:text-7xl leading-none',
        'lg' => 'text-3xl sm:text-4xl lg:text-6xl leading-tight',
        'md' => 'text-2xl sm:text-3xl lg:text-5xl leading-tight',
        'sm' => 'text-xl sm:text-2xl lg:text-4xl leading-tight',
        default => 'text-4xl sm:text-5xl lg:text-7xl leading-none',
    };

    $weightClasses = match ($weight) {
        'black' => 'font-black',
        'extrabold' => 'font-extrabold',
        'bold' => 'font-bold',
        'semibold' => 'font-semibold',
        'medium' => 'font-medium',
        'normal' => 'font-normal',
        default => 'font-extrabold',
    };

    $trackingClasses = match ($tracking) {
        'tighter' => 'tracking-tighter',
        'tight' => 'tracking-tight',
        'normal' => 'tracking-normal',
        'wide' => 'tracking-wide',
        default => '',
    };

    $gradientPreset = ($gradient === true || $gradient === 'true' || $gradient === '1' || $gradient === 1)
        ? 'default'
        : (is_string($gradient) && $gradient !== '' && $gradient !== 'false' && $gradient !== '0' ? $gradient : null);

    $colorClasses = match ($gradientPreset) {
        'default', 'zinc' => 'bg-gradient-to-r from-zinc-950 via-zinc-600 to-zinc-950 dark:from-white dark:via-zinc-400 dark:to-white bg-clip-text text-transparent',
        'subtle', 'muted' => 'bg-gradient-to-r from-zinc-900 via-zinc-600 to-zinc-400 dark:from-zinc-100 dark:via-zinc-400 dark:to-zinc-600 bg-clip-text text-transparent',
        'fade' => 'bg-gradient-to-b from-zinc-950 via-zinc-700 to-zinc-400 dark:from-white dark:via-zinc-300 dark:to-zinc-600 bg-clip-text text-transparent',
        'contrast' => 'bg-gradient-to-br from-zinc-950 via-zinc-500 to-zinc-800 dark:from-white dark:via-zinc-400 dark:to-zinc-500 bg-clip-text text-transparent',
        default => 'text-zinc-900 dark:text-white',
    };

    $alignClasses = match ($align) {
        'left', 'start' => 'text-left',
        'center' => 'text-center',
        'right', 'end' => 'text-right',
        'justify' => 'text-justify',
        default => '',
    };

    $balanceClass = $balance ? 'text-balance' : '';
    $truncateClass = $truncate ? 'truncate' : '';
    $nowrapClass = $nowrap ? 'whitespace-nowrap' : '';
@endphp

<{{ $tag }} {{ $attributes->merge(['class' => "transition-colors {$sizeClasses} {$weightClasses} {$trackingClasses} {$colorClasses} {$alignClasses} {$balanceClass} {$truncateClass} {$nowrapClass}"]) }}>
    {{ $slot }}
</{{ $tag }}>
