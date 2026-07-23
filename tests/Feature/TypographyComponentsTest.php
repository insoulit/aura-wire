<?php

use Illuminate\Support\Facades\Blade;

it('renders heading component with levels and display size', function () {
    $html = Blade::render('<x-aura::heading level="1" size="display-xl">Uber Display</x-aura::heading>');

    expect($html)->toContain('<h1')
        ->toContain('Uber Display')
        ->toContain('text-5xl');
});

it('renders text component with variants and sizes', function () {
    $html = Blade::render('<x-aura::text variant="subtle" size="lg">Section description</x-aura::text>');

    expect($html)->toContain('<p')
        ->toContain('Section description')
        ->toContain('text-zinc-600');
});

it('renders kicker metadata component', function () {
    $html = Blade::render('<x-aura::kicker>Overview</x-aura::kicker>');

    expect($html)->toContain('Overview')
        ->toContain('font-mono')
        ->toContain('uppercase');
});

it('renders subheading lead component', function () {
    $html = Blade::render('<x-aura::subheading>Lead paragraph</x-aura::subheading>');

    expect($html)->toContain('Lead paragraph')
        ->toContain('text-zinc-600');
});
