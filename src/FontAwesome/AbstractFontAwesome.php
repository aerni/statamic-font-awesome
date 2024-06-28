<?php

namespace Aerni\FontAwesome\FontAwesome;

use Aerni\FontAwesome\Contracts\FontAwesome;
use Aerni\FontAwesome\Data\Icon;
use Aerni\FontAwesome\Data\Icons;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

abstract class AbstractFontAwesome implements FontAwesome
{
    abstract public function icons(): Icons;

    public function icon(string $id): ?Icon
    {
        return $this->icons()->icon($id);
    }

    public function styles(): Collection
    {
        return $this->icons()->styles();
    }

    protected function collectIcons(array $icons): Icons
    {
        return Icons::make($icons)->flatMap(function (array $icon) {
            $familyStyles = collect($icon['familyStylesByLicense'])->flatten(1)->unique();

            return $familyStyles->map(fn ($familyStyle) => new Icon(
                id: "{$familyStyle['family']}-{$familyStyle['style']}-{$icon['id']}",
                label: "{$icon['label']}".' ('.Str::title("{$familyStyle['family']} {$familyStyle['style']}").')',
                style: "{$familyStyle['family']}-{$familyStyle['style']}",
                class: $this->iconClass($icon['id'], $familyStyle['style'], $familyStyle['family']),
            ));
        });
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
