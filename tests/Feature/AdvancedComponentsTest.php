<?php

use Illuminate\Support\Facades\Blade;

it('renders accordion component with items', function () {
    $html = Blade::render('
        <x-aura::accordion default="faq-1">
            <x-aura::accordion.item name="faq-1" title="What is AuraWire?">
                AuraWire is a sleek Blade component library.
            </x-aura::accordion.item>
            <x-aura::accordion.item name="faq-2" title="Is it free?">
                Yes, it is MIT licensed.
            </x-aura::accordion.item>
        </x-aura::accordion>
    ');

    expect($html)->toContain('What is AuraWire?')
        ->toContain('Is it free?')
        ->toContain('isOpen');
});

it('renders stat kpi card component', function () {
    $html = Blade::render('
        <x-aura::stat label="Total Revenue" value="$48,290" trend="+14.2%" trendDirection="up" description="vs last month" />
    ');

    expect($html)->toContain('Total Revenue')
        ->toContain('$48,290')
        ->toContain('+14.2%')
        ->toContain('vs last month')
        ->toContain('bg-emerald-50');
});

it('renders skeleton loader component with variants', function () {
    $html = Blade::render('
        <x-aura::skeleton variant="avatar" />
        <x-aura::skeleton variant="button" />
        <x-aura::skeleton variant="card" />
    ');

    expect($html)->toContain('rounded-full')
        ->toContain('rounded-xl')
        ->toContain('rounded-2xl')
        ->toContain('animate-pulse');
});

it('renders timeline activity history component', function () {
    $html = Blade::render('
        <x-aura::timeline>
            <x-aura::timeline.item title="Project Deployed" time="2 mins ago" variant="solid" description="v1.0.0 pushed to production." />
            <x-aura::timeline.item title="Build Started" time="5 mins ago" variant="subtle" />
        </x-aura::timeline>
    ');

    expect($html)->toContain('Project Deployed')
        ->toContain('v1.0.0 pushed to production.')
        ->toContain('2 mins ago')
        ->toContain('Build Started')
        ->toContain('bg-zinc-900')
        ->toContain('bg-zinc-100');
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

it('renders popover floating panel component', function () {
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

it('renders stepper progress workflow component', function () {
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

it('renders rating star control component with half star clipping', function () {
    $html = Blade::render('<x-aura::rating rating="4.5" max="5" name="user_rating" />');

    expect($html)->toContain('name="user_rating"')
        ->toContain('width: 50%')
        ->toContain('text-zinc-900 dark:text-white')
        ->toContain('Rate 1 out of 5')
        ->toContain('Rate 5 out of 5');
});

it('renders combobox searchable select component with monochrome checkmark', function () {
    $options = [
        ['value' => 'us', 'label' => 'United States'],
        ['value' => 'ca', 'label' => 'Canada'],
    ];

    $html = Blade::render('<x-aura::combobox :options="$options" value="us" name="country" placeholder="Choose Country" />', ['options' => $options]);

    expect($html)->toContain('Choose Country')
        ->toContain('United States')
        ->toContain('Canada')
        ->toContain('name="country"')
        ->toContain('text-zinc-900 dark:text-white');
});

it('renders date picker calendar input component with token date formatting', function () {
    $html = Blade::render('<x-aura::date-picker name="dob" value="2026-05-04" format="MMMM D, YYYY" placeholder="Select Date of Birth" />');

    expect($html)->toContain('Select Date of Birth')
        ->toContain('name="dob"')
        ->toContain('daysInMonth')
        ->toContain('MMMM D, YYYY')
        ->toContain('formatDate')
        ->toContain('rounded-full');
});
