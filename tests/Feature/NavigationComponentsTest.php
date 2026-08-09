<?php

use Illuminate\Support\Facades\Blade;

it('renders header and header item components', function () {
    $html = Blade::render('
        <x-aura::header>
            <x-slot:brand>App Logo</x-slot:brand>
            <x-aura::header.item href="/dashboard" active>Dashboard</x-aura::header.item>
        </x-aura::header>
    ');

    expect($html)->toContain('App Logo')
        ->toContain('Dashboard')
        ->toContain('href="/dashboard"')
        ->toContain('mobileOpen')
        ->toContain('Toggle navigation menu');
});

it('renders non-responsive header with horizontal scrolling when responsive is false', function () {
    $html = Blade::render('
        <x-aura::header :responsive="false">
            <x-slot:brand>App Logo</x-slot:brand>
            <x-aura::header.item href="/dashboard" active>Dashboard</x-aura::header.item>
        </x-aura::header>
    ');

    expect($html)->toContain('App Logo')
        ->toContain('Dashboard')
        ->toContain('overflow-x-auto')
        ->not->toContain('mobileOpen');
});

it('renders sidebar layout and item components', function () {
    $html = Blade::render('
        <x-aura::sidebar brand="Uber Admin">
            <x-aura::sidebar.heading>Navigation</x-aura::sidebar.heading>
            <x-aura::sidebar.item href="/users" active badge="12">Users</x-aura::sidebar.item>
        </x-aura::sidebar>
    ');

    expect($html)->toContain('Uber Admin')
        ->toContain('Navigation')
        ->toContain('Users')
        ->toContain('12');
});

it('renders sidebar dropdown collapsible menu component', function () {
    $html = Blade::render('
        <x-aura::sidebar.dropdown label="Settings" icon="cog" active>
            <x-aura::sidebar.item href="/profile">Profile</x-aura::sidebar.item>
        </x-aura::sidebar.dropdown>
    ');

    expect($html)->toContain('Settings')
        ->toContain('Profile')
        ->toContain('x-data="{ open: true }"');
});

it('renders main layout container component', function () {
    $html = Blade::render('<x-aura::main>Main Page Content</x-aura::main>');

    expect($html)->toContain('Main Page Content')
        ->toContain('<main');
});

it('renders stepper progress workflow component with active and completed statuses', function () {
    $html = Blade::render('
        <x-aura::stepper active="2">
            <x-aura::stepper.step step="1" title="Account" status="completed" />
            <x-aura::stepper.step step="2" title="Billing" status="active" />
            <x-aura::stepper.step step="3" title="Review" status="pending" />
        </x-aura::stepper>
    ');

    expect($html)->toContain('Account')
        ->toContain('Billing')
        ->toContain('Review')
        ->toContain('bg-zinc-900')
        ->toContain('ring-4 ring-zinc-200');
});

it('renders breadcrumbs component with items', function () {
    $items = [
        ['label' => 'Dashboard', 'href' => '/dashboard'],
        ['label' => 'Settings'],
    ];

    $html = Blade::render('<x-aura::breadcrumbs :items="$items" />', ['items' => $items]);

    expect($html)->toContain('Dashboard')
        ->toContain('Settings')
        ->toContain('aria-label="Breadcrumb"');
});

it('renders pagination component', function () {
    $html = Blade::render('<x-aura::pagination :currentPage="2" :totalPages="5" />');

    expect($html)->toContain('aria-label="Pagination Navigation"')
        ->toContain('2');
});
