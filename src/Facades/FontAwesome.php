<?php

namespace Aerni\FontAwesome\Facades;

use Illuminate\Support\Facades\Facade;

class FontAwesome extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Aerni\FontAwesome\Contracts\FontAwesome::class;
    }
}
