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

    public function isUsingLocalDriver(): bool
    {
        return app(FontAwesome::class) instanceof LocalRepository;
    }

    protected function iconClass(string $id, string $style, string $family): string
    {
        return match (true) {
            ($family === 'duotone') => "fa-{$family} fa-{$id}",
            ($family === 'classic') => "fa-{$style} fa-{$id}",
            default => "fa-{$family} fa-{$style} fa-{$id}",
        };
    }
}
