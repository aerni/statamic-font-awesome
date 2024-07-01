<?php

namespace Aerni\FontAwesome\Facades;

use Aerni\FontAwesome\FontAwesome\FontAwesomeManager;
use Illuminate\Support\Facades\Facade;

class FontAwesome extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FontAwesomeManager::class;
    }
}
