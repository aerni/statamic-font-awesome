<?php

namespace Aerni\FontAwesome;

use Aerni\FontAwesome\Contracts\FontAwesome;
use Aerni\FontAwesome\Repositories\KitRepository;
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

    public function register()
    {
        $this->app->singleton(FontAwesome::class, KitRepository::class);
    }
}
