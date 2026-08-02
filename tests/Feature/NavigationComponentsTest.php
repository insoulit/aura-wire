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
        ->toContain('href="/dashboard"');
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

it('renders main layout container component', function () {
    $html = Blade::render('
        <x-aura::main>
            <h1>Dashboard Content</h1>
        </x-aura::main>
    ');

    expect($html)->toContain('Dashboard Content')
        ->toContain('lg:pl-64');
});

it('renders sidebar dropdown collapsible menu component', function () {
    $html = Blade::render('
        <x-aura::sidebar.dropdown label="Management" badge="New" :active="true">
            <x-aura::sidebar.item href="/roles">Roles</x-aura::sidebar.item>
        </x-aura::sidebar.dropdown>
    ');

    expect($html)->toContain('Management')
        ->toContain('New')
        ->toContain('Roles')
        ->toContain('href="/roles"');
});
