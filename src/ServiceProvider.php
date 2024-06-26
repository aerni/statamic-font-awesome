<?php

namespace Aerni\FontAwesome;

use Illuminate\Support\Facades\Storage;
use Aerni\FontAwesome\Tags\FontAwesomeTags;
use Aerni\FontAwesome\Contracts\FontAwesome;
use Statamic\Providers\AddonServiceProvider;
use Aerni\FontAwesome\Repositories\KitRepository;
use Aerni\FontAwesome\Repositories\LocalRepository;
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

    public function bootAddon()
    {
        config('font-awesome.local', false)
            ? $this->bootLocalDriver()
            : $this->bootKitDriver();
    }

    protected function bootLocalDriver(): void
    {
        $this->app->singleton(FontAwesome::class, function () {
            $store = Storage::build([
                'driver' => 'local',
                'root' => config('font-awesome.path'),
                'url' => '/fonts/fontawesome',
            ]);

            return new LocalRepository($store);
        });
    }

    protected function bootKitDriver(): void
    {
        $this->app->singleton(FontAwesome::class, function () {
            return new KitRepository(
                apiToken: config('font-awesome.api_token'),
                kitToken: config('font-awesome.kit_token')
            );
        });
    }
}
