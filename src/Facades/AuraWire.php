<?php

namespace Insoulit\AuraWire\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Insoulit\AuraWire\AuraWire
 */
class AuraWire extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Insoulit\AuraWire\AuraWire::class;
    }
}
