<?php

namespace Aerni\FontAwesome\Contracts;

use Aerni\FontAwesome\Contracts\Icons;

interface FontAwesomeDriver
{
    public function icons(): Icons;
}
