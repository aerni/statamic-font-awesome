<?php

namespace Aerni\FontAwesome;

use Aerni\FontAwesome\Facades\FontAwesome;

class FontAwesomeController
{
    public function index()
    {
        return response()->json(FontAwesome::all());
    }
}
