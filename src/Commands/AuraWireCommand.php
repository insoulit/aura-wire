<?php

namespace Insoulit\AuraWire\Commands;

use Illuminate\Console\Command;

class AuraWireCommand extends Command
{
    public $signature = 'aura-wire:install';

    public $description = 'Install and publish AuraWire package assets and configuration';

    public function handle(): int
    {
        $this->info('Publishing AuraWire configuration...');
        $this->callSilent('vendor:publish', [
            '--tag' => 'aura-wire-config',
        ]);

        $this->info('Publishing AuraWire component views...');
        $this->callSilent('vendor:publish', [
            '--tag' => 'aura-wire-views',
        ]);

        $this->comment('AuraWire components and config installed successfully!');

        return self::SUCCESS;
    }
}
