<?php

namespace Aerni\FontAwesome;

use Aerni\FontAwesome\Data\Icon;
use Aerni\FontAwesome\Data\Icons;
use Aerni\FontAwesome\Data\Kit;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $vite = [
        'input' => [
            'resources/js/cp.js',
        ],
        'publicDirectory' => 'resources/dist',
    ];

    public function register(): void
    {
        $this->registerSerializableClasses([
            Icon::class,
            Icons::class,
            Kit::class,
        ]);
    }
}
