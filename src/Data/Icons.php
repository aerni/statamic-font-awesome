<?php

namespace Aerni\FontAwesome\Data;

use Illuminate\Support\Collection;

class Icons extends Collection
{
    public function styles(): Collection
    {
        return $this->groupByStyle()->keys();
    }

    public function groupByStyle(): Collection
    {
        return $this->groupBy('style')->sortKeys();
    }
}
