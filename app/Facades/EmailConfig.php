<?php

namespace W4P\Facades;

use Illuminate\Support\Facades\Facade;

class EmailConfig extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'emailconfig';
    }
}