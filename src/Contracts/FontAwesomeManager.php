<?php

namespace Aerni\FontAwesome\Contracts;

use Aerni\FontAwesome\Data\Icon;
use Illuminate\Support\Collection;

interface FontAwesomeManager
{
    public function icons(): Collection;

    public function icon(string $id): ?Icon;

    public function styles(): Collection;

    public function isUsingLocalDriver(): bool;
}
