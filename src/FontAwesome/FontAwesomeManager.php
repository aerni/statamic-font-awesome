<?php

namespace Aerni\FontAwesome\FontAwesome;

use Illuminate\Support\Manager;
use Aerni\FontAwesome\Data\Icon;
use Illuminate\Support\Collection;
use Aerni\FontAwesome\Contracts\FontAwesomeDriver;
use Aerni\FontAwesome\Contracts\FontAwesomeManager as FontAwesomeManagerContract;

class FontAwesomeManager extends Manager implements FontAwesomeManagerContract
{
    public function getDefaultDriver(): string
    {
        return $this->config->get('font-awesome.driver');
    }

    public function createKitDriver(): FontAwesomeDriver
    {
        return new KitFontAwesome(
            apiToken: config('font-awesome.kit.api_token'),
            kitToken: config('font-awesome.kit.kit_token')
        );
    }

    public function createLocalDriver(): FontAwesomeDriver
    {
        return new LocalFontAwesome(
            metadata: $this->config->get('font-awesome.local.metadata'),
            css: $this->config->get('font-awesome.local.css'),
        );
    }

    public function icons(): Collection
    {
        return $this->driver()->icons();
    }

    public function icon(string $id): ?Icon
    {
        return $this->driver()->icons()->icon($id);
    }

    public function styles(): Collection
    {
        return $this->driver()->icons()->styles();
    }

    public function isUsingLocalDriver(): bool
    {
        return $this->driver() instanceof LocalFontAwesome;
    }
}
