<?php

namespace Aerni\FontAwesome\Http\Controllers;

use Aerni\FontAwesome\Facades\FontAwesome;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;

class FontAwesomeController extends Controller
{
    public function __invoke()
    {
        $json = Cache::rememberForever('font_awesome::icons', fn () => FontAwesome::icons()->toJson());

        return response($json)->header('Content-Type', 'application/json');
    }
}
