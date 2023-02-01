<?php

namespace Aerni\FontAwesome;

use Facades\Aerni\FontAwesome\FontAwesome;

class FontAwesomeController
{
    public function index()
    {
        return response()->json(FontAwesome::all());
    }
}
