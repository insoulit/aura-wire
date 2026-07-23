<?php

namespace Insoulit\AuraWire\Commands;

use Illuminate\Console\Command;

class AuraWireCommand extends Command
{
    public $signature = 'aura-wire';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
