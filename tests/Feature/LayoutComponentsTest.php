<?php

use Illuminate\Support\Facades\Blade;

it('renders navbar layout component with brand and navigation slot', function () {
    $html = Blade::render('
        <x-aura::navbar brand="AuraWire">
            <x-slot:navigation>
                <a href="/docs">Docs</a>
                <a href="/components">Components</a>
            </x-slot:navigation>
        </x-aura::navbar>
    ');

    expect($html)->toContain('AuraWire')
        ->toContain('Docs')
        ->toContain('Components')
        ->toContain('<header');
});

it('renders footer layout component with copyright text', function () {
    $html = Blade::render('
        <x-aura::footer copyright="© 2026 Insoulit Inc. All rights reserved.">
            <a href="/privacy">Privacy Policy</a>
        </x-aura::footer>
    ');

    expect($html)->toContain('© 2026 Insoulit Inc. All rights reserved.')
        ->toContain('Privacy Policy')
        ->toContain('<footer');
});

it('renders sidebar collapsible dropdown component', function () {
    $html = Blade::render('
        <x-aura::sidebar.dropdown label="Administration">
            <x-aura::sidebar.item href="/admin/users">Users</x-aura::sidebar.item>
            <x-aura::sidebar.item href="/admin/settings">Settings</x-aura::sidebar.item>
        </x-aura::sidebar.dropdown>
    ');

    expect($html)->toContain('Administration')
        ->toContain('Users')
        ->toContain('Settings')
        ->toContain('x-data="{ open:');
});
