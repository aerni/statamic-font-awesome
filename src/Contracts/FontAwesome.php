<?php

namespace Aerni\FontAwesome\Contracts;

use Aerni\FontAwesome\Data\Icon;
use Aerni\FontAwesome\Data\Icons;
use Illuminate\Support\Collection;

interface FontAwesome
{
    public function icons(): Icons;

    public function icon(string $id): ?Icon;

    public function styles(): Collection;
}
