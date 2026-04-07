<?php

namespace Aerni\FontAwesome\Http\Controllers;

use Aerni\FontAwesome\Facades\FontAwesome;
use Illuminate\Routing\Controller;

class FontAwesomeController extends Controller
{
    public function __invoke()
    {
        $cachePath = FontAwesome::iconsCachePath();

        if ($cachePath !== null) {
            return response()->file($cachePath);
        }

        return response()->json(FontAwesome::icons());
    }
}
