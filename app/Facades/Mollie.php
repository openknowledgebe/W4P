<?php

namespace W4P\Facades;

use Illuminate\Support\Facades\Facade;

class Mollie extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mollie';
    }
}