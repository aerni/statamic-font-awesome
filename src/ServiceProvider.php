<?php

namespace Aerni\FontAwesome;

use Statamic\Providers\AddonServiceProvider;
use Statamic\Contracts\GraphQL\ResponseCache;
use Aerni\FontAwesome\GraphQL\SafeResponseCache;

class ServiceProvider extends AddonServiceProvider
{
    protected $vite = [
        'input' => [
            'resources/js/cp.js',
        ],
        'publicDirectory' => 'resources/dist',
    ];

    public function boot(): void
    {
        parent::boot();

        $this->app->bind(ResponseCache::class, SafeResponseCache::class);
    }
}
