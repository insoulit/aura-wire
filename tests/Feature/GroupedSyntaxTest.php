<?php

use Illuminate\Support\Facades\Blade;

it('supports both grouped dot syntax and flat tag syntax for components', function () {
    // Grouped dot syntax
    $groupedForm = Blade::render('<x-aura::form.input name="email" placeholder="test@uber.com" />');
    $groupedHeading = Blade::render('<x-aura::typography.heading level="2">Grouped Title</x-aura::typography.heading>');
    $groupedCard = Blade::render('<x-aura::display.card title="Grouped Card" />');
    $groupedSidebar = Blade::render('<x-aura::layout.sidebar brand="Grouped Brand" />');

    expect($groupedForm)->toContain('placeholder="test@uber.com"')
        ->and($groupedHeading)->toContain('Grouped Title')
        ->and($groupedCard)->toContain('Grouped Card')
        ->and($groupedSidebar)->toContain('Grouped Brand');

    // Direct flat tag syntax
    $flatForm = Blade::render('<x-aura::input name="email" placeholder="test@uber.com" />');
    $flatHeading = Blade::render('<x-aura::heading level="2">Flat Title</x-aura::heading>');
    $flatCard = Blade::render('<x-aura::card title="Flat Card" />');
    $flatSidebar = Blade::render('<x-aura::sidebar brand="Flat Brand" />');

    expect($flatForm)->toContain('placeholder="test@uber.com"')
        ->and($flatHeading)->toContain('Flat Title')
        ->and($flatCard)->toContain('Flat Card')
        ->and($flatSidebar)->toContain('Flat Brand');
});
