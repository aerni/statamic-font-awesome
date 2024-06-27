<?php

namespace Aerni\FontAwesome;

use Aerni\FontAwesome\Tags\FontAwesomeTags;
use Statamic\Providers\AddonServiceProvider;
use Aerni\FontAwesome\Fieldtypes\FontAwesomeFieldtype;

class ServiceProvider extends AddonServiceProvider
{
    protected $fieldtypes = [
        FontAwesomeFieldtype::class,
    ];

    protected $tags = [
        FontAwesomeTags::class,
    ];

    protected $routes = [
        'actions' => __DIR__.'/../routes/actions.php',
    ];

    protected $scripts = [
        __DIR__.'/../resources/dist/js/cp.js',
    ];
}
