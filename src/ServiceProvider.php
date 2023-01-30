<?php

namespace Aerni\FontAwesome;

use Facades\Aerni\FontAwesome\FontAwesome;
use Statamic\Providers\AddonServiceProvider;

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

    public function bootAddon(): void
    {
        if (app()->runningInConsole()) {
            return;
        }

        $this->registerExternalScript(FontAwesome::kit()->get('url'));
    }
}
