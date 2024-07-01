<?php

namespace Aerni\FontAwesome\FontAwesome;

use Statamic\Facades\YAML;
use Illuminate\Support\Str;
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
                $icons[$id]['id'] = $id; /* Make sure we have an ID to work with. */
                $icons[$id]['label'] = Str::title($icon['label']); /* Ensure custom icons also use title case. */
            }

            return $this->collectIcons($icons);
        });
    }

    public function css(): string
    {
        return url($this->css);
    }
}
