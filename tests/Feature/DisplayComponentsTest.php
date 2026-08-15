<?php

use Illuminate\Support\Facades\Blade;

it('renders card component with header and content', function () {
    $html = Blade::render('
        <x-aura::card>
            <x-slot:header>Card Header Title</x-slot:header>
            <p>Card body paragraph content.</p>
        </x-aura::card>
    ');

    expect($html)->toContain('Card Header Title')
        ->toContain('Card body paragraph content.');
});

it('renders card component as anchor tag when href is provided', function () {
    $html = Blade::render('<x-aura::card href="/components/footer">Card content</x-aura::card>');

    expect($html)->toContain('<a')
        ->toContain('href="/components/footer"')
        ->toContain('Card content');
});

it('renders avatar component with initials fallback', function () {
    $html = Blade::render('<x-aura::avatar initials="JD" status="online" size="md" />');

    expect($html)->toContain('JD')
        ->toContain('rounded-full');
});

it('renders separator component', function () {
    $html = Blade::render('<x-aura::separator />');

    expect($html)->toContain('w-full border-t');
});

it('renders icon component with size attribute', function () {
    $html = Blade::render('<x-aura::icon name="user" size="lg" />');

    expect($html)->toContain('<svg')
        ->toContain('w-6 h-6');
});

it('renders list component with items', function () {
    $items = [
        ['title' => 'Item 1', 'description' => 'Desc 1'],
        ['title' => 'Item 2', 'description' => 'Desc 2'],
    ];

    $html = Blade::render('<x-aura::list :items="$items" />', ['items' => $items]);

    expect($html)->toContain('Item 1')
        ->toContain('Item 2');
});

it('renders code preview component', function () {
    $html = Blade::render('<x-aura::code title="PHP Snippet">echo "Hello";</x-aura::code>');

    expect($html)->toContain('PHP Snippet')
        ->toContain('echo "Hello";');
});

it('renders table component with headers and rows', function () {
    $html = Blade::render('
        <x-aura::table>
            <x-slot:header>
                <th>Name</th>
                <th>Email</th>
            </x-slot:header>
            <tr>
                <td>Alex</td>
                <td>alex@example.com</td>
            </tr>
        </x-aura::table>
    ');

    expect($html)->toContain('<th>Name</th>')
        ->toContain('alex@example.com');
});

it('renders badge component with variants', function () {
    $html = Blade::render('<x-aura::badge variant="positive">Active</x-aura::badge>');

    expect($html)->toContain('Active')
        ->toContain('rounded-full');
});

it('renders tabs component with active item', function () {
    $html = Blade::render('
        <x-aura::tab active="tab-1">
            <x-aura::tab.item name="tab-1">Overview</x-aura::tab.item>
            <x-aura::tab.item name="tab-2">Settings</x-aura::tab.item>
        </x-aura::tab>
    ');

    expect($html)->toContain('Overview')
        ->toContain('Settings');
});

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
        ->toContain('vs last month');
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

it('renders timeline activity history component with solid and subtle variants', function () {
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

it('renders progress-bar component with percentage', function () {
    $html = Blade::render('<x-aura::progress-bar value="75" max="100" showValue />');

    expect($html)->toContain('aria-valuenow="75"');
});

it('renders empty-state component with title and description', function () {
    $html = Blade::render('<x-aura::empty-state title="No Transactions" description="Your account has no recent activity." />');

    expect($html)->toContain('No Transactions')
        ->toContain('Your account has no recent activity.');
});

it('renders numbered-list component with items', function () {
    $items = [
        ['title' => 'Account Setup', 'subtitle' => 'Create account'],
    ];

    $html = Blade::render('<x-aura::numbered-list :items="$items" />', ['items' => $items]);

    expect($html)->toContain('Account Setup')
        ->toContain('Create account');
});

it('renders image component with aspect ratio and rounded corners', function () {
    $html = Blade::render('<x-aura::image src="https://example.com/photo.jpg" alt="Sample Photo" aspect="4/3" rounded="xl" />');

    expect($html)->toContain('<img')
        ->toContain('src="https://example.com/photo.jpg"')
        ->toContain('aspect-4/3')
        ->toContain('rounded-xl');
});

it('renders tag component', function () {
    $html = Blade::render('<x-aura::tag variant="neutral" removable>Laravel</x-aura::tag>');

    expect($html)->toContain('Laravel')
        ->toContain('rounded-full');
});
