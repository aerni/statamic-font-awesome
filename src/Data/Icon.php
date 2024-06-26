<?php

namespace Aerni\FontAwesome\Data;

class Icon
{
    public function __construct(
        public string $style,
        public string $id,
        public string $label,
        public string $class,
    ) {
    }
}
