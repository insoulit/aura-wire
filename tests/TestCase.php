<?php

namespace Insoulit\AuraWire\Tests;

use BladeUI\Icons\BladeIconsServiceProvider;
use BladeUI\Lucide\BladeLucideIconsServiceProvider;
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

        if (class_exists(BladeIconsServiceProvider::class)) {
            $providers[] = BladeIconsServiceProvider::class;
        }

        if (class_exists(BladeLucideIconsServiceProvider::class)) {
            $providers[] = BladeLucideIconsServiceProvider::class;
        }

        return $providers;
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
