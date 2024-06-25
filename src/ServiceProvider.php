<?php

namespace Aerni\FontAwesome;

use Aerni\FontAwesome\Contracts\FontAwesome;
use Statamic\Providers\AddonServiceProvider;
use Aerni\FontAwesome\Repositories\KitRepository;
use Aerni\FontAwesome\Repositories\LocalRepository;

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

    public function bootAddon()
    {
        config('font-awesome.local', false)
            ? $this->app->singleton(FontAwesome::class, LocalRepository::class)
            : $this->app->singleton(FontAwesome::class, KitRepository::class);
    }
}
