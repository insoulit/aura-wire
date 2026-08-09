<?php

namespace Insoulit\AuraWire\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Insoulit\AuraWire\AuraWireServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Insoulit\\AuraWire\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        $providers = [
            LivewireServiceProvider::class,
            AuraWireServiceProvider::class,
        ];

        if (class_exists(\BladeUI\Icons\BladeIconsServiceProvider::class)) {
            $providers[] = \BladeUI\Icons\BladeIconsServiceProvider::class;
        }

        if (class_exists(\BladeUI\Lucide\BladeLucideIconsServiceProvider::class)) {
            $providers[] = \BladeUI\Lucide\BladeLucideIconsServiceProvider::class;
        }

        return $providers;
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
