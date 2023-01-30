<?php

namespace Aerni\FontAwesome;

use Facades\Aerni\FontAwesome\FontAwesome;
use Illuminate\Http\Request;

class FontAwesomeController
{
    public function index(Request $request)
    {
        $styles = $request->get('styles');

        $icons = $styles
            ? FontAwesome::get($styles)
            : FontAwesome::all();

        return response()->json($icons);
    }
}
