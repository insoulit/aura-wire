<?php

return [

    /*
    |--------------------------------------------------------------------------
    | AuraWire Component Prefix
    |--------------------------------------------------------------------------
    |
    | This value sets the prefix for Blade components registered by AuraWire.
    | By default, components will be available using <aura:button> or <x-aura::button>.
    |
    */

    'prefix' => 'aura',

    /*
    |--------------------------------------------------------------------------
    | Uber Base Design System Theme Options
    |--------------------------------------------------------------------------
    |
    | Configuration options for Uber Base Design System styling & defaults.
    |
    */

    'theme' => [
        'border_radius' => 'md', // 'none' | 'sm' | 'md' | 'lg' | 'full'
        'dark_mode' => 'class', // 'class' | 'media'
        'accent_color' => 'blue', // 'blue' | 'black' | 'indigo'
    ],

];
