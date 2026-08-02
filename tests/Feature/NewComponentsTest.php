<?php

use Illuminate\Support\Facades\Blade;

it('renders pin-code component with length', function () {
    $html = Blade::render('<x-aura::pin-code length="6" />');

    expect($html)->toContain('<input')
        ->toContain('maxlength="1"');

    // Should render 6 input boxes
    expect(substr_count($html, 'maxlength="1"'))->toBe(6);
});

it('renders file-upload component with label and hint', function () {
    $html = Blade::render('<x-aura::file-upload label="Upload Document" hint="PDF only" />');

    expect($html)->toContain('Upload Document')
        ->toContain('PDF only')
        ->toContain('type="file"');
});

it('renders progress-bar component with percentage', function () {
    $html = Blade::render('<x-aura::progress-bar percent="75" variant="emerald" />');

    expect($html)->toContain('width: 75%')
        ->toContain('role="progressbar"')
        ->toContain('aria-valuenow="75"');
});

it('renders empty-state component with title and description', function () {
    $html = Blade::render('<x-aura::empty-state title="No items found" description="Try searching for something else." />');

    expect($html)->toContain('No items found')
        ->toContain('Try searching for something else.');
});

it('renders numbered-list component with items', function () {
    $items = [
        ['title' => 'First Step', 'subtitle' => 'Get started'],
        ['title' => 'Second Step', 'subtitle' => 'Configure options'],
    ];

    $html = Blade::render('<x-aura::numbered-list :items="$items" />', ['items' => $items]);

    expect($html)->toContain('First Step')
        ->toContain('Get started')
        ->toContain('Second Step')
        ->toContain('Configure options')
        ->toContain('01')
        ->toContain('02');
});

it('renders product-card component with price and title', function () {
    $html = Blade::render('<x-aura::product-card title="Premium Headphones" price="$199" originalPrice="$249" badge="Sale" />');

    expect($html)->toContain('Premium Headphones')
        ->toContain('$199')
        ->toContain('$249')
        ->toContain('Sale');
});

it('renders banner component with message', function () {
    $html = Blade::render('<x-aura::banner variant="success">Operation completed successfully!</x-aura::banner>');

    expect($html)->toContain('Operation completed successfully!')
        ->toContain('role="alert"');
});

it('renders tag component', function () {
    $html = Blade::render('<x-aura::tag variant="primary">New Feature</x-aura::tag>');

    expect($html)->toContain('New Feature');
});

it('renders spinner component', function () {
    $html = Blade::render('<x-aura::spinner size="lg" />');

    expect($html)->toContain('<svg')
        ->toContain('animate-spin');
});

it('renders sheet drawer component', function () {
    $html = Blade::render('<x-aura::sheet name="filter-sheet">Filter Panel</x-aura::sheet>');

    expect($html)->toContain('Filter Panel')
        ->toContain('open-sheet.window');
});

it('renders breadcrumbs component with items', function () {
    $items = [
        ['label' => 'Home', 'href' => '/'],
        ['label' => 'Shop', 'href' => '/shop'],
        ['label' => 'Products'],
    ];

    $html = Blade::render('<x-aura::breadcrumbs :items="$items" />', ['items' => $items]);

    expect($html)->toContain('Home')
        ->toContain('Shop')
        ->toContain('Products')
        ->toContain('aria-label="Breadcrumb"');
});

it('renders pagination component', function () {
    $html = Blade::render('<x-aura::pagination><span class="text-xs">Page 1 of 5</span></x-aura::pagination>');

    expect($html)->toContain('Page 1 of 5')
        ->toContain('aria-label="Pagination Navigation"');
});
