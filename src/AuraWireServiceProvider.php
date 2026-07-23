<?php

namespace Insoulit\AuraWire;

use Insoulit\AuraWire\Commands\AuraWireCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AuraWireServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('aura-wire')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_aura_wire_table')
            ->hasCommand(AuraWireCommand::class);
    }
}
