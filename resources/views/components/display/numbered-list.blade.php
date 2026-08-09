@props([
    'items' => [],
    'variant' => 'card', // 'card', 'grid', 'media', 'timeline', 'compact', 'simple', 'steps'
    'numbered' => true,
    'titleKey' => 'title',
    'subtitleKey' => 'subtitle',
    'descriptionKey' => 'description',
    'imageKey' => 'image',
    'badgeKey' => 'badge',
    'iconKey' => 'icon',
])

@php
    $itemsArray = is_array($items) ? $items : iterator_to_array($items);
@endphp

@if ($variant === 'media')
    {{-- Media List with Thumbnail Images & Individual Circular Action Icon Buttons --}}
    <div {{ $attributes->merge(['class' => 'space-y-3']) }}>
        @foreach($itemsArray as $index => $item)
            @php
                $title = is_array($item) ? ($item[$titleKey] ?? $item[0] ?? '') : (is_object($item) ? ($item->{$titleKey} ?? '') : $item);
                $subtitle = is_array($item) ? ($item[$subtitleKey] ?? null) : (is_object($item) ? ($item->{$subtitleKey} ?? null) : null);
                $description = is_array($item) ? ($item[$descriptionKey] ?? null) : (is_object($item) ? ($item->{$descriptionKey} ?? null) : null);
                $image = is_array($item) ? ($item[$imageKey] ?? $item['avatar'] ?? null) : (is_object($item) ? ($item->{$imageKey} ?? $item->avatar ?? null) : null);
                $badge = is_array($item) ? ($item[$badgeKey] ?? null) : (is_object($item) ? ($item->{$badgeKey} ?? null) : null);
            @endphp
            <div class="group flex flex-col sm:flex-row sm:items-center gap-4 p-4 sm:p-5 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl hover:border-zinc-400 dark:hover:border-zinc-700 transition-all duration-200 shadow-2xs">
                @if ($numbered)
                    {{-- Number Badge --}}
                    <div class="w-8 h-8 rounded-full bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 text-xs font-bold flex items-center justify-center shrink-0 shadow-xs">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </div>
                @endif

                {{-- Image Thumbnail if available --}}
                @if ($image)
                    <img src="{{ $image }}" alt="{{ $title }}" class="w-14 h-14 rounded-xl object-cover shrink-0 border border-zinc-200 dark:border-zinc-800 shadow-2xs" />
                @endif

                {{-- Content --}}
                <div class="flex-1 min-w-0 space-y-0.5">
                    <div class="flex items-center gap-2 flex-wrap">
                        <h4 class="text-sm sm:text-base font-bold text-zinc-900 dark:text-white tracking-tight">{{ $title }}</h4>
                        @if ($badge)
                            <x-aura::badge variant="neutral" size="sm">{{ $badge }}</x-aura::badge>
                        @endif
                    </div>
                    @if ($subtitle)
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 font-medium">{{ $subtitle }}</p>
                    @endif
                    @if ($description)
                        <p class="text-xs text-zinc-600 dark:text-zinc-300 leading-relaxed pt-1">{{ $description }}</p>
                    @endif
                </div>

                {{-- Individual Circular Action Icon Buttons --}}
                <div class="flex items-center gap-1.5 shrink-0 pt-2 sm:pt-0">
                    <x-aura::icon-button icon="show" variant="subtle" size="sm" shape="circle" label="View Item" />
                    <x-aura::icon-button icon="edit" variant="subtle" size="sm" shape="circle" label="Edit Item" />
                    <x-aura::icon-button icon="delete" variant="subtle-danger" size="sm" shape="circle" label="Delete Item" />
                </div>
            </div>
        @endforeach
    </div>

@elseif ($variant === 'grid')
    {{-- Card Grid List --}}
    <div {{ $attributes->merge(['class' => 'grid grid-cols-1 sm:grid-cols-2 gap-4']) }}>
        @foreach($itemsArray as $index => $item)
            @php
                $title = is_array($item) ? ($item[$titleKey] ?? $item[0] ?? '') : (is_object($item) ? ($item->{$titleKey} ?? '') : $item);
                $subtitle = is_array($item) ? ($item[$subtitleKey] ?? null) : (is_object($item) ? ($item->{$subtitleKey} ?? null) : null);
                $image = is_array($item) ? ($item[$imageKey] ?? $item['avatar'] ?? null) : (is_object($item) ? ($item->{$imageKey} ?? $item->avatar ?? null) : null);
                $badge = is_array($item) ? ($item[$badgeKey] ?? null) : (is_object($item) ? ($item->{$badgeKey} ?? null) : null);
            @endphp
            <div class="group relative bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl p-5 hover:shadow-xl hover:shadow-zinc-900/5 dark:hover:shadow-white/5 transition-all duration-300 flex flex-col justify-between space-y-4">
                <div class="flex items-start justify-between gap-3">
                    @if ($numbered)
                        <div class="w-8 h-8 rounded-xl bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 text-xs font-bold flex items-center justify-center shrink-0 shadow-xs">
                            {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </div>
                    @else
                        <div></div>
                    @endif
                    @if ($badge)
                        <x-aura::badge variant="positive" size="sm">{{ $badge }}</x-aura::badge>
                    @endif
                </div>

                @if ($image)
                    <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-32 rounded-xl object-cover border border-zinc-200 dark:border-zinc-800" />
                @endif

                <div class="space-y-1">
                    <h4 class="text-base font-bold text-zinc-900 dark:text-white tracking-tight">{{ $title }}</h4>
                    @if ($subtitle)
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 font-medium leading-relaxed">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

@elseif ($variant === 'steps')
    {{-- Process Step Bar --}}
    <div {{ $attributes->merge(['class' => 'grid grid-cols-1 sm:grid-cols-3 gap-4']) }}>
        @foreach($itemsArray as $index => $item)
            @php
                $title = is_array($item) ? ($item[$titleKey] ?? $item[0] ?? '') : (is_object($item) ? ($item->{$titleKey} ?? '') : $item);
                $subtitle = is_array($item) ? ($item[$subtitleKey] ?? null) : (is_object($item) ? ($item->{$subtitleKey} ?? null) : null);
            @endphp
            <div class="p-4 rounded-xl bg-zinc-50 dark:bg-zinc-900/80 border border-zinc-200 dark:border-zinc-800 flex items-start gap-3">
                @if ($numbered)
                    <div class="w-7 h-7 rounded-full bg-indigo-600 text-white text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">
                        {{ $index + 1 }}
                    </div>
                @endif
                <div class="min-w-0">
                    @if ($numbered)
                        <p class="text-xs font-bold text-zinc-900 dark:text-white uppercase tracking-wider">Step {{ $index + 1 }}</p>
                    @endif
                    <p class="text-sm font-semibold text-zinc-800 dark:text-zinc-200 truncate">{{ $title }}</p>
                    @if ($subtitle)
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 truncate mt-0.5">{{ $subtitle }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

@elseif ($variant === 'timeline')
    {{-- Timeline Variant --}}
    <div {{ $attributes->merge(['class' => 'relative space-y-6 pl-4 border-l-2 border-zinc-200 dark:border-zinc-800 ml-4']) }}>
        @foreach($itemsArray as $index => $item)
            @php
                $title = is_array($item) ? ($item[$titleKey] ?? $item[0] ?? '') : (is_object($item) ? ($item->{$titleKey} ?? '') : $item);
                $subtitle = is_array($item) ? ($item[$subtitleKey] ?? null) : (is_object($item) ? ($item->{$subtitleKey} ?? null) : null);
                $badge = is_array($item) ? ($item[$badgeKey] ?? null) : (is_object($item) ? ($item->{$badgeKey} ?? null) : null);
            @endphp
            <div class="relative pl-6 group">
                <div class="absolute -left-[25px] top-0 w-6 h-6 rounded-full bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 text-xs font-bold flex items-center justify-center shadow-xs">
                    @if ($numbered)
                        {{ $index + 1 }}
                    @else
                        <span class="w-2 h-2 rounded-full bg-zinc-400 dark:bg-zinc-600"></span>
                    @endif
                </div>
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h4 class="text-sm font-bold text-zinc-900 dark:text-white tracking-tight">{{ $title }}</h4>
                        @if ($subtitle)
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5 leading-relaxed">{{ $subtitle }}</p>
                        @endif
                    </div>
                    @if ($badge)
                        <x-aura::badge variant="neutral" size="sm">{{ $badge }}</x-aura::badge>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

@elseif ($variant === 'compact' || $variant === 'inline')
    {{-- Compact Row List --}}
    <div {{ $attributes->merge(['class' => 'divide-y divide-zinc-200 dark:divide-zinc-800 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 overflow-hidden']) }}>
        @foreach($itemsArray as $index => $item)
            @php
                $title = is_array($item) ? ($item[$titleKey] ?? $item[0] ?? '') : (is_object($item) ? ($item->{$titleKey} ?? '') : $item);
                $subtitle = is_array($item) ? ($item[$subtitleKey] ?? null) : (is_object($item) ? ($item->{$subtitleKey} ?? null) : null);
                $image = is_array($item) ? ($item[$imageKey] ?? $item['avatar'] ?? null) : (is_object($item) ? ($item->{$imageKey} ?? $item->avatar ?? null) : null);
                $badge = is_array($item) ? ($item[$badgeKey] ?? null) : (is_object($item) ? ($item->{$badgeKey} ?? null) : null);
            @endphp
            <div class="flex items-center gap-4 p-4 hover:bg-zinc-50 dark:hover:bg-zinc-800/40 transition-colors">
                @if ($numbered)
                    <div class="w-7 h-7 rounded-lg bg-zinc-100 dark:bg-zinc-800 text-zinc-900 dark:text-white text-xs font-bold flex items-center justify-center shrink-0">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </div>
                @endif
                @if ($image)
                    <img src="{{ $image }}" alt="{{ $title }}" class="w-8 h-8 rounded-full object-cover shrink-0" />
                @endif
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold text-zinc-900 dark:text-white truncate">{{ $title }}</p>
                    @if ($subtitle)
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 truncate">{{ $subtitle }}</p>
                    @endif
                </div>
                @if ($badge)
                    <x-aura::badge variant="positive" size="sm">{{ $badge }}</x-aura::badge>
                @endif
            </div>
        @endforeach
    </div>

@elseif ($variant === 'simple')
    {{-- Simple List --}}
    <ul {{ $attributes->merge(['class' => 'space-y-3']) }}>
        @foreach($itemsArray as $index => $item)
            @php
                $title = is_array($item) ? ($item[$titleKey] ?? $item[0] ?? '') : (is_object($item) ? ($item->{$titleKey} ?? '') : $item);
                $subtitle = is_array($item) ? ($item[$subtitleKey] ?? null) : (is_object($item) ? ($item->{$subtitleKey} ?? null) : null);
            @endphp
            <li class="flex items-start gap-3">
                @if ($numbered)
                    <span class="text-sm font-bold text-indigo-600 dark:text-indigo-400 font-mono w-5 shrink-0 pt-0.5">{{ $index + 1 }}.</span>
                @else
                    <span class="w-1.5 h-1.5 rounded-full bg-indigo-600 dark:bg-indigo-400 shrink-0 mt-2 ml-1"></span>
                @endif
                <div>
                    <span class="text-sm font-semibold text-zinc-900 dark:text-white">{{ $title }}</span>
                    @if ($subtitle)
                        <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ $subtitle }}</p>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>

@else
    {{-- Default Card Variant --}}
    <div {{ $attributes->merge(['class' => 'space-y-4']) }}>
        @foreach($itemsArray as $index => $item)
            @php
                $title = is_array($item) ? ($item[$titleKey] ?? $item[0] ?? '') : (is_object($item) ? ($item->{$titleKey} ?? '') : $item);
                $subtitle = is_array($item) ? ($item[$subtitleKey] ?? null) : (is_object($item) ? ($item->{$subtitleKey} ?? null) : null);
                $image = is_array($item) ? ($item[$imageKey] ?? $item['avatar'] ?? null) : (is_object($item) ? ($item->{$imageKey} ?? $item->avatar ?? null) : null);
            @endphp
            <div class="group relative bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl p-5 sm:p-6 hover:shadow-xl hover:shadow-zinc-900/5 dark:hover:shadow-white/5 hover:-translate-y-0.5 transition-all duration-300">
                @if ($numbered)
                    <div class="absolute -top-3 -left-3 w-8 h-8 bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 rounded-full flex items-center justify-center font-bold text-xs shadow-md transform group-hover:scale-110 transition-transform duration-300">
                        {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                    </div>
                @endif

                <div class="flex items-start gap-4">
                    @if ($image)
                        <img src="{{ $image }}" alt="{{ $title }}" class="w-12 h-12 rounded-xl object-cover shrink-0 border border-zinc-200 dark:border-zinc-800" />
                    @endif
                    <div class="space-y-1">
                        <p class="text-base sm:text-lg font-bold text-zinc-900 dark:text-white leading-tight tracking-tight">
                            {{ $title }}
                        </p>
                        @if ($subtitle)
                            <p class="text-xs sm:text-sm text-zinc-500 dark:text-zinc-400 font-medium">
                                {{ $subtitle }}
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
