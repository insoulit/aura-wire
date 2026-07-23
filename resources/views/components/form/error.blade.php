@props([
    'name' => null,
    'message' => null,
])

@php
    $errorMessage = $message;
    if (! $errorMessage && $name && isset($errors) && $errors->has($name)) {
        $errorMessage = $errors->first($name);
    }
@endphp

@if ($errorMessage)
    <p {{ $attributes->merge(['class' => 'mt-1 text-xs font-medium text-red-600 dark:text-red-400 flex items-center gap-1.5']) }}>
        <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>{{ $errorMessage }}</span>
    </p>
@endif
