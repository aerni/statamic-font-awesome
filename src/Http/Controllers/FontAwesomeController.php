<?php

namespace Aerni\FontAwesome\Http\Controllers;

use Illuminate\Routing\Controller;
use Aerni\FontAwesome\Facades\FontAwesome;

class FontAwesomeController extends Controller
{
    public function __invoke()
    {
        return response()->json(FontAwesome::icons());
    }
}
