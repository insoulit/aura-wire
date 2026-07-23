<?php

use Illuminate\Support\Facades\Blade;

it('renders badge component with variants', function () {
    $html = Blade::render('<x-aura::badge variant="positive">Active</x-aura::badge>');

    expect($html)->toContain('Active')
        ->toContain('bg-emerald-600/10');
});

it('renders avatar component with initials fallback', function () {
    $html = Blade::render('<x-aura::avatar initials="UB" status="online" />');

    expect($html)->toContain('UB')
        ->toContain('bg-emerald-500');
});

it('renders card component with header and content', function () {
    $html = Blade::render('
        <x-aura::card title="Uber Card">
            <p>Card body content</p>
        </x-aura::card>
    ');

    expect($html)->toContain('Uber Card')
        ->toContain('Card body content');
});

it('renders separator component', function () {
    $html = Blade::render('<x-aura::separator label="OR" />');

    expect($html)->toContain('OR')
        ->toContain('role="separator"');
});

it('renders table component with headers and rows', function () {
    $html = Blade::render('
        <x-aura::table>
            <x-slot:header>
                <x-aura::table.column>Name</x-aura::table.column>
                <x-aura::table.column>Role</x-aura::table.column>
            </x-slot:header>

            <x-aura::table.row>
                <x-aura::table.cell>Alex</x-aura::table.cell>
                <x-aura::table.cell>Developer</x-aura::table.cell>
            </x-aura::table.row>
        </x-aura::table>
    ');

    expect($html)->toContain('Name')
        ->toContain('Alex')
        ->toContain('<table');
});

it('renders code preview component', function () {
    $html = Blade::render('<x-aura::code title="Button Snippet" code="&lt;aura:button&gt;Click&lt;/aura:button&gt;"><x-aura::button>Click</x-aura::button></x-aura::code>');

    expect($html)->toContain('Button Snippet')
        ->toContain('Copy')
        ->toContain('Click');
});

