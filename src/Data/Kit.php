<?php

namespace Aerni\FontAwesome\Data;

class Kit
{
    public function __construct(
        public string $id,
        public string $url,
        public string $license,
        public string $version,
        public array $customIcons,
    ) {}
}
