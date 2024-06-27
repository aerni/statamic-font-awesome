<?php

namespace Aerni\FontAwesome\FontAwesome;

use Statamic\Facades\YAML;
use Aerni\FontAwesome\Data\Icons;
use Illuminate\Support\Facades\Cache;
use Aerni\FontAwesome\Contracts\FontAwesome;

class LocalFontAwesome extends AbstractFontAwesome implements FontAwesome
{
    public function __construct(protected string $metadata, protected string $css)
    {
        //
    }

    public function icons(): Icons
    {
        return Cache::rememberForever('font_awesome::local::icons', function () {
            $icons = YAML::file("{$this->metadata}/icon-families.yml")->parse();

            foreach ($icons as $id => $icon) {
                $icons[$id]['id'] = $id;
            }

            return $this->collectIcons($icons);
        });
    }

    public function css(): string
    {
        return url($this->css);
    }
}
