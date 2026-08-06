<?php

namespace Insoulit\AuraWire;

use Illuminate\Support\Facades\Blade;
use Insoulit\AuraWire\Commands\AuraWireCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AuraWireServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('aura-wire')
            ->hasConfigFile('aura-wire')
            ->hasViews('aura-wire')
            ->hasCommand(AuraWireCommand::class);
    }

    public function packageBooted(): void
    {
        $prefix = config('aura-wire.prefix', 'aura');

        // Register main components root
        Blade::anonymousComponentPath(__DIR__.'/../resources/views/components', $prefix);

        // Register group subfolders for direct tag access (e.g. <aura:input>, <aura:heading>, <aura:icon.edit>)
        $groups = ['action', 'typography', 'form', 'display', 'layout', 'overlay', 'feedback', 'navigation', 'icon'];

        foreach ($groups as $group) {
            Blade::anonymousComponentPath(__DIR__."/../resources/views/components/{$group}", $prefix);
        }
    }
}
