<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Font Awesome Driver
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default Font Awesome driver that should be used.
    |
    | Supported Drivers: "kit", "local"
    |
    */

    'driver' => 'kit',

    /*
    |--------------------------------------------------------------------------
    | Kit Driver Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration that should be used for the Kit driver.
    |
    */

    'kit' => [
        'api_token' => env('FA_API_TOKEN'),
        'kit_token' => env('FA_KIT_TOKEN'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Local Driver Options
    |--------------------------------------------------------------------------
    |
    | Here you may specify the configuration that should be used for the Local driver.
    |
    */

    'local' => [
        'metadata' => resource_path('fonts/fontawesome/metadata'),
        'css' => '/fonts/fontawesome/css/all.min.css',
    ],

];
