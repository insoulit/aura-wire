<?php

use Illuminate\Support\Facades\Blade;

it('renders icon button component with size and variant', function () {
    $html = Blade::render('<x-aura::icon-button icon="plus" variant="primary" size="lg" aria-label="Add Item" />');

    expect($html)->toContain('<button')
        ->toContain('aria-label="Add Item"')
        ->toContain('w-10 h-10');
});

it('renders icon button as anchor tag when href is provided', function () {
    $html = Blade::render('<x-aura::icon-button icon="settings" href="/settings" aria-label="Settings" />');

    expect($html)->toContain('<a')
        ->toContain('href="/settings"')
        ->toContain('aria-label="Settings"');
});

it('renders dropdown with header, items, and separator', function () {
    $html = Blade::render('
        <x-aura::dropdown>
            <x-slot:trigger>
                <button>Open Menu</button>
            </x-slot:trigger>

            <x-aura::dropdown.header>Account</x-aura::dropdown.header>
            <x-aura::dropdown.item href="/profile">Profile Settings</x-aura::dropdown.item>
            <x-aura::dropdown.separator />
            <x-aura::dropdown.item variant="danger">Logout</x-aura::dropdown.item>
        </x-aura::dropdown>
    ');

    expect($html)->toContain('Open Menu')
        ->toContain('Account')
        ->toContain('Profile Settings')
        ->toContain('Logout')
        ->toContain('text-red-600');
});
