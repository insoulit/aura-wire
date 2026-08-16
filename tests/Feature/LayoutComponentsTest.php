<?php

use Illuminate\Support\Facades\Blade;

it('renders navbar layout component with brand, navigation, and variant support', function () {
    $default = Blade::render('
        <x-aura::navbar brand="AuraWire">
            <x-slot:navigation>
                <a href="/docs">Docs</a>
                <a href="/components">Components</a>
            </x-slot:navigation>
        </x-aura::navbar>
    ');

    $dark = Blade::render('<x-aura::navbar variant="dark" brand="AuraDark" />');
    $bordered = Blade::render('<x-aura::navbar variant="bordered" brand="AuraBordered" />');
    $minimal = Blade::render('<x-aura::navbar variant="minimal" brand="AuraMinimal" />');

    expect($default)->toContain('AuraWire')
        ->toContain('Docs')
        ->toContain('Components')
        ->toContain('<header');

    expect($dark)->toContain('bg-zinc-900')
        ->toContain('text-white');

    expect($bordered)->toContain('border-zinc-200/80');

    expect($minimal)->toContain('bg-transparent');
});

it('renders footer layout component with copyright text, variants, and bottom slot', function () {
    $default = Blade::render('
        <x-aura::footer brand="AuraWire">
            <a href="/privacy">Privacy Policy</a>
            <x-slot:bottom>
                <span>© 2026 Insoulit Inc.</span>
            </x-slot:bottom>
        </x-aura::footer>
    ');

    $dark = Blade::render('<x-aura::footer variant="dark" brand="AuraDark" />');

    expect($default)->toContain('AuraWire')
        ->toContain('Privacy Policy')
        ->toContain('© 2026 Insoulit Inc.')
        ->toContain('<footer');

    expect($dark)->toContain('bg-zinc-900')
        ->toContain('text-zinc-300');
});

it('renders header component with items, variants, and responsive props', function () {
    $header = Blade::render('
        <x-aura::header variant="bordered" :sticky="false">
            <x-slot:brand>AuraApp</x-slot:brand>
            <x-aura::header.item href="/dashboard" active icon="layout-dashboard">Dashboard</x-aura::header.item>
            <x-aura::header.item href="/settings" :block="true">Settings</x-aura::header.item>
        </x-aura::header>
    ');

    expect($header)->toContain('AuraApp')
        ->toContain('Dashboard')
        ->toContain('Settings')
        ->toContain('flex w-full justify-start')
        ->toContain('<header');
});

it('renders container component with size presets', function () {
    $sm = Blade::render('<x-aura::container size="sm">Small Content</x-aura::container>');
    $lg = Blade::render('<x-aura::container size="lg">Large Content</x-aura::container>');
    $default = Blade::render('<x-aura::container>Default Content</x-aura::container>');

    expect($sm)->toContain('max-w-sm')
        ->toContain('Small Content');

    expect($lg)->toContain('max-w-lg')
        ->toContain('Large Content');

    expect($default)->toContain('max-w-7xl')
        ->toContain('Default Content');
});

it('renders main layout component with axis alignment options', function () {
    $main = Blade::render('
        <x-aura::main alignX="center" alignY="center">
            <p>Main Center Content</p>
        </x-aura::main>
    ');

    expect($main)->toContain('items-center')
        ->toContain('justify-center')
        ->toContain('Main Center Content')
        ->toContain('<main');
});

it('renders body layout component', function () {
    $body = Blade::render('
        <x-aura::body>
            <p>Application Body</p>
        </x-aura::body>
    ');

    expect($body)->toContain('min-h-full')
        ->toContain('Application Body');
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

it('renders flex layout component with align, justify, gap, and direction props', function () {
    $flex = Blade::render('
        <x-aura::flex align="center" justify="between" gap="4">
            <div>Left</div>
            <div>Right</div>
        </x-aura::flex>
    ');

    $col = Blade::render('<x-aura::flex direction="col" align="start" justify="end" gap="2">Column Content</x-aura::flex>');

    expect($flex)->toContain('flex flex-row')
        ->toContain('items-center')
        ->toContain('justify-between')
        ->toContain('gap-4')
        ->toContain('Left')
        ->toContain('Right');

    expect($col)->toContain('flex-col')
        ->toContain('items-start')
        ->toContain('justify-end')
        ->toContain('gap-2');
});

it('renders center layout component horizontally and vertically', function () {
    $center = Blade::render('
        <x-aura::center gap="3">
            <p>Centered Item</p>
        </x-aura::center>
    ');

    expect($center)->toContain('flex')
        ->toContain('items-center')
        ->toContain('justify-center')
        ->toContain('gap-3')
        ->toContain('Centered Item');
});

it('renders stack layout component with spacing and direction', function () {
    $stack = Blade::render('
        <x-aura::stack gap="6">
            <p>Item 1</p>
            <p>Item 2</p>
        </x-aura::stack>
    ');

    expect($stack)->toContain('flex flex-col')
        ->toContain('gap-6')
        ->toContain('Item 1')
        ->toContain('Item 2');
});

