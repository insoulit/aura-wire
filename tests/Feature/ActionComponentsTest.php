<?php

use Illuminate\Support\Facades\Blade;

it('renders icon button component with size, shape, and variant', function () {
    $html = Blade::render('<x-aura::icon-button icon="plus" variant="primary" size="lg" aria-label="Add Item" />');
    $ghost = Blade::render('<x-aura::icon-button icon="bell" variant="ghost" size="sm" aria-label="Notifications" />');

    expect($html)->toContain('<button')
        ->toContain('aria-label="Add Item"')
        ->toContain('w-10 h-10');

    expect($ghost)->toContain('bg-transparent')
        ->toContain('aria-label="Notifications"');
});

it('renders icon button as anchor tag when href is provided', function () {
    $html = Blade::render('<x-aura::icon-button icon="settings" href="/settings" aria-label="Settings" />');

    expect($html)->toContain('<a')
        ->toContain('href="/settings"')
        ->toContain('aria-label="Settings"');
});

it('renders link component with icon, underline, and external target', function () {
    $link = Blade::render('<x-aura::action.link href="https://example.com" icon="external-link" external>Documentation</x-aura::action.link>');

    expect($link)->toContain('<a')
        ->toContain('href="https://example.com"')
        ->toContain('target="_blank"')
        ->toContain('rel="noopener noreferrer"')
        ->toContain('Documentation');
});

it('renders dropdown with header, items, and separator', function () {
    $html = Blade::render('
        <x-aura::dropdown align="right" width="56">
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
        ->toContain('x-teleport="body"')
        ->toContain('-translate-x-full')
        ->toContain('w-56')
        ->toContain('text-red-600');
});

it('renders dropdown checkbox item for toggle lists', function () {
    $html = Blade::render('<x-aura::dropdown.checkbox name="show_role" label="Role" :checked="true" />');

    expect($html)->toContain('Role')
        ->toContain('name="show_role"')
        ->toContain('checked')
        ->toContain('type="checkbox"');
});
