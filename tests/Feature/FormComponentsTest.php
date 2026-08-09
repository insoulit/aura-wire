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

it('renders textarea component with rows and placeholder', function () {
    $html = Blade::render('<x-aura::textarea name="bio" rows="5" placeholder="Tell us about yourself..." />');

    expect($html)->toContain('<textarea')
        ->toContain('id="bio"')
        ->toContain('rows="5"')
        ->toContain('placeholder="Tell us about yourself..."');
});

it('renders error validation message component', function () {
    $html = Blade::render('<x-aura::error message="The email field is required." />');

    expect($html)->toContain('The email field is required.')
        ->toContain('text-red-600');
});

it('renders rich-text editor component container', function () {
    $html = Blade::render('<x-aura::rich-text name="content" placeholder="Write something awesome..." />');

    expect($html)->toContain('name="content"')
        ->toContain('Write something awesome...');
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

it('renders rating star control component with half star clipping', function () {
    $html = Blade::render('<x-aura::rating rating="4.5" max="5" name="user_rating" />');

    expect($html)->toContain('name="user_rating"')
        ->toContain('width: 50%')
        ->toContain('text-zinc-900 dark:text-white')
        ->toContain('Rate 1 out of 5')
        ->toContain('Rate 5 out of 5');
});

it('renders file-upload component with label and hint', function () {
    $html = Blade::render('<x-aura::file-upload label="Upload Document" hint="PDF or DOCX up to 10MB" />');

    expect($html)->toContain('Upload Document')
        ->toContain('PDF or DOCX up to 10MB')
        ->toContain('type="file"');
});

it('renders pin-code component with length', function () {
    $html = Blade::render('<x-aura::pin-code length="6" size="lg" />');

    expect($html)->toContain('pin_0')
        ->toContain('pin_5')
        ->toContain('inputmode="numeric"');
});
