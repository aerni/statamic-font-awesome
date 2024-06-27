<?php

namespace Aerni\FontAwesome\Data;

use Aerni\FontAwesome\Contracts\Icons as IconsContract;
use Illuminate\Support\Collection;

class Icons extends Collection implements IconsContract
{
    public function icon(string $id): ?Icon
    {
        return $this->firstWhere('id', $id);
    }

    public function styles(): Collection
    {
        return $this->groupByStyle()->keys();
    }

    public function groupByStyle(): Collection
    {
        return $this->groupBy('style')->sortKeys();
    }
}
