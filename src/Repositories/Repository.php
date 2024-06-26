<?php

namespace Aerni\FontAwesome\Repositories;

use Aerni\FontAwesome\Contracts\FontAwesome;
use Illuminate\Support\Collection;

abstract class Repository implements FontAwesome
{
    public function all(): Collection
    {
        return $this->icons()->flatten(1)->sortBy('label')->values();
    }

    abstract public function icons(): Collection;

    public function icon(string $icon): ?array
    {
        return $this->all()->firstWhere('class', $icon);
    }

    public function styles(): Collection
    {
        return $this->icons()->keys();
    }

    protected function iconClass(string $icon, string $style, string $family): string
    {
        if ($this->isVersion5()) {
            return match (true) {
                ($family === 'duotone') => 'fa'.substr($family, 0, 1)." fa-{$icon}",
                default => 'fa'.substr($style, 0, 1)." fa-{$icon}",
            };
        }

        return match (true) {
            ($family === 'duotone') => "fa-{$family} fa-{$icon}",
            ($family === 'classic') => "fa-{$style} fa-{$icon}",
            default => "fa-{$family} fa-{$style} fa-{$icon}",
        };
    }

    abstract protected function isVersion5(): bool;

    public function isUsingLocalDriver(): bool
    {
        return app(FontAwesome::class) instanceof LocalRepository;
    }
}
