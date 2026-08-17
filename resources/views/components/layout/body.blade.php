<body {{ $attributes->merge(['class' => 'font-sans text-sm min-h-full bg-zinc-50 dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 selection:bg-zinc-900 selection:text-white dark:selection:bg-white dark:selection:text-zinc-900 flex flex-col transition-colors duration-200 antialiased']) }}>
    {{ $slot }}
</body>
