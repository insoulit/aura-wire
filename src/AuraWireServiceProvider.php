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
        /*
         * Package Service Provider configuration
         */
        $package
            ->name('aura-wire')
            ->hasConfigFile('aura-wire')
            ->hasViews('aura-wire')
            ->hasMigration('create_aura_wire_table')
            ->hasCommand(AuraWireCommand::class);
    }

    public function packageBooted(): void
    {
        $prefix = config('aura-wire.prefix', 'aura');
        Blade::anonymousComponentPath(__DIR__.'/../resources/views/components', $prefix);
    }
}
