<?php

use Illuminate\Support\Facades\Blade;

it('renders alert component with title and description', function () {
    $html = Blade::render('
        <x-aura::alert title="System Update" description="A new version is ready to install." variant="info" />
    ');

    expect($html)->toContain('System Update')
        ->toContain('A new version is ready to install.')
        ->toContain('role="alert"');
});

it('renders alert with left-accent layout', function () {
    $html = Blade::render('
        <x-aura::alert title="Important Notice" description="Please back up your data." variant="warning" layout="left-accent" />
    ');

    expect($html)->toContain('Important Notice')
        ->toContain('border-l-4');
});

it('renders dismissible alert component', function () {
    $html = Blade::render('
        <x-aura::alert title="Dismissible Alert" dismissible />
    ');

    expect($html)->toContain('Dismissible Alert')
        ->toContain('Dismiss alert')
        ->toContain('x-data="{ show: true }"');
});

it('renders modal component with slots and variants', function () {
    $html = Blade::render('
        <x-aura::modal name="test-modal" title="Confirm Action">
            <p>Are you sure you want to proceed?</p>
            <x-slot:footer>
                <button>Cancel</button>
                <button>Confirm</button>
            </x-slot:footer>
        </x-aura::modal>
    ');

    expect($html)->toContain('Confirm Action')
        ->toContain('Are you sure you want to proceed?')
        ->toContain('Confirm')
        ->toContain('x-on:open-modal.window');
});

it('renders sheet drawer component with slots', function () {
    $html = Blade::render('
        <x-aura::sheet name="test-sheet" side="right" title="Filter Settings">
            <div>Sheet Content</div>
        </x-aura::sheet>
    ');

    expect($html)->toContain('Filter Settings')
        ->toContain('Sheet Content')
        ->toContain('right-0');
});

it('renders toast notification component', function () {
    $html = Blade::render('
        <x-aura::toast title="Settings Saved" description="Your preferences have been updated." variant="success" />
    ');

    expect($html)->toContain('Settings Saved')
        ->toContain('Your preferences have been updated.');
});

it('renders tooltip hover overlay component', function () {
    $html = Blade::render('
        <x-aura::tooltip text="Click to copy API Key" position="top">
            <button>Copy</button>
        </x-aura::tooltip>
    ');

    expect($html)->toContain('Click to copy API Key')
        ->toContain('Copy')
        ->toContain('bottom-full');
});

it('renders popover floating panel component with rounded-xl panel', function () {
    $html = Blade::render('
        <x-aura::popover align="left" width="64">
            <x-slot:trigger>
                <button>Filter Options</button>
            </x-slot:trigger>
            <div>Popover Form Content</div>
        </x-aura::popover>
    ');

    expect($html)->toContain('Filter Options')
        ->toContain('Popover Form Content')
        ->toContain('w-64')
        ->toContain('rounded-xl');
});

it('renders command palette modal component with group and item subcomponents', function () {
    $html = Blade::render('
        <x-aura::command placeholder="Search documentation..." key="k">
            <x-aura::command.group title="Navigation">
                <x-aura::command.item href="/components/button" icon="square-mouse-pointer" shortcut="⌘B">
                    Button Component
                </x-aura::command.item>
            </x-aura::command.group>
        </x-aura::command>
    ');

    expect($html)->toContain('Search documentation...')
        ->toContain('Navigation')
        ->toContain('Button Component')
        ->toContain('href="/components/button"')
        ->toContain('⌘B')
        ->toContain("e.key.toLowerCase() === 'k'");
});

it('renders banner component with message', function () {
    $html = Blade::render('<x-aura::banner variant="info">Maintenance scheduled for tonight at 12 AM UTC.</x-aura::banner>');

    expect($html)->toContain('Maintenance scheduled for tonight at 12 AM UTC.');
});

it('renders spinner component', function () {
    $html = Blade::render('<x-aura::spinner size="lg" />');

    expect($html)->toContain('animate-spin')
        ->toContain('h-8 w-8');
});
