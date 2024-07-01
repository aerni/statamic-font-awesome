<?php

namespace Aerni\FontAwesome\FontAwesome;

use Aerni\FontAwesome\Contracts\FontAwesome;
use Illuminate\Support\Manager;

class FontAwesomeManager extends Manager
{
    public function getDefaultDriver(): string
    {
        return $this->config->get('font-awesome.driver');
    }

    public function createKitDriver(): FontAwesome
    {
        return new KitFontAwesome(
            apiToken: config('font-awesome.kit.api_token'),
            kitToken: config('font-awesome.kit.kit_token')
        );
    }

    public function createLocalDriver(): FontAwesome
    {
        return new LocalFontAwesome(
            metadata: $this->config->get('font-awesome.local.metadata'),
            css: $this->config->get('font-awesome.local.css'),
        );
    }

    public function isUsingLocalDriver(): bool
    {
        return $this->driver() instanceof LocalFontAwesome;
    }
}
