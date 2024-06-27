<?php

namespace Aerni\FontAwesome\FontAwesome;

use Statamic\Facades\YAML;
use Illuminate\Support\Str;
use Aerni\FontAwesome\Data\Icon;
use Aerni\FontAwesome\Data\Icons;
use Illuminate\Support\Facades\Cache;
use Aerni\FontAwesome\Contracts\FontAwesomeDriver;

class LocalFontAwesome implements FontAwesomeDriver
{
    public function __construct(protected string $metadata, protected string $css)
    {
        //
    }

    public function icons(): Icons
    {
        return Cache::rememberForever('font_awesome::icons', function () {
            $icons = YAML::file("{$this->metadata}/icon-families.yml")->parse();

            return Icons::make($icons)->flatMap(function (array $icon, string $id) {
                $familyStyles = collect($icon['familyStylesByLicense'])->flatten(1)->unique();

                return $familyStyles->map(fn ($familyStyle) => new Icon(
                    id: "{$familyStyle['family']}-{$familyStyle['style']}-{$id}",
                    label: "{$icon['label']}".' ('.Str::title("{$familyStyle['family']} {$familyStyle['style']}").')',
                    style: "{$familyStyle['family']}-{$familyStyle['style']}",
                    class: $this->iconClass($id, $familyStyle['style'], $familyStyle['family']),
                ));
            });
        });
    }

    public function css(): string
    {
        return url($this->css);
    }

    protected function iconClass(string $id, string $style, string $family): string
    {
        return match (true) {
            ($family === 'duotone') => "fa-{$family} fa-{$id}",
            ($family === 'classic') => "fa-{$style} fa-{$id}",
            default => "fa-{$family} fa-{$style} fa-{$id}",
        };
    }
}
