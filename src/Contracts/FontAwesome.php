<?php

namespace Aerni\FontAwesome\Contracts;

use Illuminate\Support\Collection;

interface FontAwesome
{
    public function all(): Collection;

    public function icon(string $icon): ?array;

    public function styles(): Collection;
}
