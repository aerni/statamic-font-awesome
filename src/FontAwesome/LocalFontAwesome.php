<?php

namespace Aerni\FontAwesome\FontAwesome;

use Aerni\FontAwesome\Contracts\FontAwesome;
use Aerni\FontAwesome\Data\Icons;
use Illuminate\Support\Str;
use Statamic\Facades\YAML;

class LocalFontAwesome extends AbstractFontAwesome implements FontAwesome
{
    protected ?Icons $cachedIcons = null;

    public function __construct(protected string $metadata, protected string $css)
    {
        //
    }

    public function iconCacheKey(): string
    {
        return 'local';
    }

    public function icons(): Icons
    {
        if ($this->cachedIcons) {
            return $this->cachedIcons;
        }

        $cached = $this->readIconCache('local');

        if ($cached !== null) {
            return $this->cachedIcons = $this->iconsFromArray($cached);
        }

        $icons = YAML::file("{$this->metadata}/icon-families.yml")->parse();

        foreach ($icons as $id => $icon) {
            $icons[$id]['id'] = $id;
            $icons[$id]['label'] = Str::title($icon['label']);
        }

        $this->cachedIcons = $this->collectIcons($icons);
        unset($icons);
        $this->writeIconCache('local', $this->cachedIcons);

        return $this->cachedIcons;
    }

    public function css(): string
    {
        return url($this->css);
    }
}
