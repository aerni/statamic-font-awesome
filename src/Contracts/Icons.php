<?php

namespace Aerni\FontAwesome\Contracts;

use Aerni\FontAwesome\Data\Icon;
use Illuminate\Support\Collection;

interface Icons
{
    public function icon(string $id): ?Icon;

    public function styles(): Collection;

    public function groupByStyle(): Collection;
}
