<?php

use Illuminate\Support\Facades\Blade;

it('renders alert component with title and description', function () {
    $html = Blade::render('
        <x-aura::alert title="System Update" description="Version 2.0 is now live." variant="success" layout="solid" />
    ');

    expect($html)->toContain('System Update')
        ->toContain('Version 2.0 is now live.')
        ->toContain('bg-emerald-600')
        ->toContain('role="alert"');
});

it('renders dismissible alert component', function () {
    $html = Blade::render('
        <x-aura::alert title="Dismissible Alert" dismissible />
    ');

    expect($html)->toContain('Dismissible Alert')
        ->toContain('x-data="{ show: true }"')
        ->toContain('@click="show = false"')
        ->toContain('aria-label="Dismiss alert"');
});

it('renders alert with left-accent layout', function () {
    $html = Blade::render('
        <x-aura::alert title="Important Warning" variant="warning" layout="left-accent" />
    ');

    expect($html)->toContain('Important Warning')
        ->toContain('border-l-4')
        ->toContain('border-l-amber-500');
});

it('renders modal component with slots and variants', function () {
    $html = Blade::render('
        <x-aura::modal name="test-modal" title="Confirm Action" description="Are you sure?" variant="centered">
            Modal Body Content
            <x-slot:footer>
                <button>Cancel</button>
            </x-slot:footer>
        </x-aura::modal>
    ');

    expect($html)->toContain('Confirm Action')
        ->toContain('Are you sure?')
        ->toContain('Modal Body Content')
        ->toContain('Cancel')
        ->toContain("x-on:open-modal.window=\"if (\$event.detail === 'test-modal') open = true\"");
});

it('renders toast notification component', function () {
    $html = Blade::render('
        <x-aura::toast title="File Uploaded" description="Document.pdf saved successfully." variant="success" />
    ');

    expect($html)->toContain('File Uploaded')
        ->toContain('Document.pdf saved successfully.')
        ->toContain('x-data="{ show: true }"');
});

it('renders sheet drawer component with slots', function () {
    $html = Blade::render('
        <x-aura::sheet name="settings-drawer" title="Settings" side="right">
            Drawer content body
            <x-slot:footer>
                <button>Save</button>
            </x-slot:footer>
        </x-aura::sheet>
    ');

    expect($html)->toContain('Settings')
        ->toContain('Drawer content body')
        ->toContain('Save')
        ->toContain('x-on:open-sheet.window');
});
