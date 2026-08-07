<?php

use Illuminate\Support\Facades\Blade;

it('renders label component with required indicator', function () {
    $html = Blade::render('<x-aura::label required>Full Name</x-aura::label>');

    expect($html)->toContain('Full Name')
        ->toContain('*');
});

it('renders input component with placeholder and value', function () {
    $html = Blade::render('<x-aura::input name="email" placeholder="john@example.com" value="test@example.com" />');

    expect($html)->toContain('<input')
        ->toContain('placeholder="john@example.com"')
        ->toContain('value="test@example.com"');
});

it('renders field wrapper component with label and hint', function () {
    $html = Blade::render('
        <x-aura::field label="Username" hint="Must be unique">
            <x-aura::input name="username" />
        </x-aura::field>
    ');

    expect($html)->toContain('Username')
        ->toContain('Must be unique')
        ->toContain('<input');
});

it('renders select component with options', function () {
    $html = Blade::render('
        <x-aura::select name="role">
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </x-aura::select>
    ');

    expect($html)->toContain('<select')
        ->toContain('value="admin"')
        ->toContain('Admin');
});

it('renders checkbox component', function () {
    $html = Blade::render('<x-aura::checkbox label="Accept terms" />');

    expect($html)->toContain('type="checkbox"')
        ->toContain('Accept terms');
});

it('renders radio group component', function () {
    $html = Blade::render('
        <x-aura::form.radio-group label="Plan">
            <x-aura::radio name="plan" value="free" label="Free Plan" />
            <x-aura::radio name="plan" value="pro" label="Pro Plan" />
        </x-aura::form.radio-group>
    ');

    expect($html)->toContain('type="radio"')
        ->toContain('Free Plan')
        ->toContain('Pro Plan');
});

it('renders switch toggle component', function () {
    $html = Blade::render('<x-aura::switch label="Enable Notifications" />');

    expect($html)->toContain('type="checkbox"')
        ->toContain('Enable Notifications');
});
