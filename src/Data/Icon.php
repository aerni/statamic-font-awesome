<?php

namespace Aerni\FontAwesome\Data;

class Icon
{
    public function __construct(
        public string $id,
        public string $label,
        public string $style,
        public string $class,
    )
    { }
}
