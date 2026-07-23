<?php

use Illuminate\Support\Facades\Blade;

it('renders a default button component', function () {
    $rendered = Blade::render('<x-aura::button>Click me</x-aura::button>');

    expect($rendered)->toContain('<button')
        ->toContain('type="button"')
        ->toContain('Click me')
        ->toContain('bg-white');
});

it('renders button with primary variant and sm size', function () {
    $rendered = Blade::render('<x-aura::button variant="primary" size="sm">Save</x-aura::button>');

    expect($rendered)->toContain('bg-zinc-900')
        ->toContain('px-2.5 py-1.5')
        ->toContain('Save');
});

it('renders an anchor tag when href attribute is passed', function () {
    $rendered = Blade::render('<x-aura::button href="https://example.com">Go Link</x-aura::button>');

    expect($rendered)->toContain('<a')
        ->toContain('href="https://example.com"')
        ->toContain('Go Link');
});

it('renders disabled state properly', function () {
    $rendered = Blade::render('<x-aura::button disabled>Disabled</x-aura::button>');

    expect($rendered)->toContain('disabled');
});

it('renders button group container', function () {
    $rendered = Blade::render('
        <x-aura::button.group>
            <x-aura::button>Left</x-aura::button>
            <x-aura::button>Right</x-aura::button>
        </x-aura::button.group>
    ');

    expect($rendered)->toContain('role="group"')
        ->toContain('Left')
        ->toContain('Right');
});
