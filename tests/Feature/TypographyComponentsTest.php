<?php

use Illuminate\Support\Facades\Blade;

it('renders display component with sizes and gradients', function () {
    $html = Blade::render('<x-aura::display size="xl" gradient="true">Hero Title</x-aura::display>');

    expect($html)->toContain('<h1')
        ->toContain('Hero Title')
        ->toContain('bg-clip-text')
        ->toContain('text-transparent')
        ->toContain('text-4xl sm:text-5xl lg:text-7xl');
});

it('renders heading component with levels and display size', function () {
    $html = Blade::render('<x-aura::heading level="1" size="display-xl">Uber Display</x-aura::heading>');

    expect($html)->toContain('<h1')
        ->toContain('Uber Display')
        ->toContain('text-5xl');
});

it('renders heading with custom levels, weights, and alignment', function () {
    $html = Blade::render('<x-aura::heading level="3" weight="bold" align="center" variant="primary">Section Title</x-aura::heading>');

    expect($html)->toContain('<h3')
        ->toContain('Section Title')
        ->toContain('text-center')
        ->toContain('text-indigo-600')
        ->toContain('font-bold');
});

it('renders text component with variants and sizes', function () {
    $html = Blade::render('<x-aura::text variant="subtle" size="lg">Section description</x-aura::text>');

    expect($html)->toContain('<p')
        ->toContain('Section description')
        ->toContain('text-zinc-700');
});

it('renders text component with clamp and formatting options', function () {
    $html = Blade::render('<x-aura::text clamp="2" italic pretty>Long paragraph text</x-aura::text>');

    expect($html)->toContain('Long paragraph text')
        ->toContain('line-clamp-2')
        ->toContain('italic')
        ->toContain('text-pretty');
});

it('renders kicker metadata component', function () {
    $html = Blade::render('<x-aura::kicker>Overview</x-aura::kicker>');

    expect($html)->toContain('Overview')
        ->toContain('font-sans')
        ->toContain('uppercase');
});

it('renders kicker component with icon', function () {
    $html = Blade::render('<x-aura::kicker icon="sparkles" variant="primary">Featured</x-aura::kicker>');

    expect($html)->toContain('Featured')
        ->toContain('text-indigo-600')
        ->toContain('svg');
});

it('renders subheading lead component with size variants', function () {
    $html = Blade::render('
        <x-aura::subheading size="sm">Small Lead</x-aura::subheading>
        <x-aura::subheading size="lg">Large Lead</x-aura::subheading>
    ');

    expect($html)->toContain('Small Lead')
        ->toContain('text-xs sm:text-sm')
        ->toContain('Large Lead')
        ->toContain('text-base sm:text-lg');
});

it('renders blockquote component with citation and author', function () {
    $html = Blade::render('<x-aura::blockquote author="John Doe" cite="CTO at Acme">Clean architecture is essential.</x-aura::blockquote>');

    expect($html)->toContain('Clean architecture is essential.')
        ->toContain('John Doe')
        ->toContain('CTO at Acme')
        ->toContain('border-l-2');
});

it('renders kbd keyboard shortcut component', function () {
    $html = Blade::render('<x-aura::kbd size="sm">Ctrl + K</x-aura::kbd>');

    expect($html)->toContain('<kbd')
        ->toContain('Ctrl + K')
        ->toContain('font-mono');
});

it('renders inline-code component', function () {
    $html = Blade::render('<x-aura::inline-code>npm install</x-aura::inline-code>');

    expect($html)->toContain('<code')
        ->toContain('npm install')
        ->toContain('font-mono');
});

it('renders lead component proxying to subheading', function () {
    $html = Blade::render('<x-aura::lead>This is a lead paragraph.</x-aura::lead>');

    expect($html)->toContain('This is a lead paragraph.')
        ->toContain('text-base sm:text-lg');
});
