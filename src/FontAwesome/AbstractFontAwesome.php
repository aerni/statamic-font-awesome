<?php

namespace Aerni\FontAwesome\FontAwesome;

use Aerni\FontAwesome\Data\Icon;
use Aerni\FontAwesome\Data\Icons;
use Illuminate\Support\Collection;
use Aerni\FontAwesome\Contracts\FontAwesome;

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
            return collect($icon['familyStylesByLicense'])
                ->flatten(1)
                ->unique()
                ->map(fn ($familyStyle) => ($familyStyle['family'] !== 'kit')
                    ? $this->makeIcon($familyStyle, $icon)
                    : $this->makeCustomIcon($familyStyle, $icon)
                );
        });
    }

    protected function makeIcon(array $familyStyle, array $icon): Icon
    {
        return new Icon(
            id: "{$familyStyle['family']}-{$familyStyle['style']}-{$icon['id']}",
            label: str("{$icon['label']} ({$familyStyle['family']} {$familyStyle['style']})")->title(),
            style: "{$familyStyle['family']}-{$familyStyle['style']}",
            class: $this->iconClass($icon['id'], $familyStyle['family'], $familyStyle['style']),
        );
    }

    protected function makeCustomIcon(array $familyStyle, array $icon): Icon
    {
        return new Icon(
            id: "{$familyStyle['style']}-{$icon['id']}",
            label: str("{$icon['label']} (Custom)")->title(),
            style: $familyStyle['style'],
            class: $this->customIconClass($icon['id'], $icon['duotone'] ?? false),
        );
    }

    protected function iconClass(string $id, string $family, string $style): string
    {
        return match (true) {
            ($family === 'classic') => "fa-{$style} fa-{$id}",
            ($family === 'duotone') => "fa-{$family} fa-{$id}",
            default => "fa-{$family} fa-{$style} fa-{$id}",
        };
    }

    protected function customIconClass(string $id, bool $duotone): string
    {
        return $duotone ? "fa-kit-duotone fa-{$id}" : "fa-kit fa-{$id}";
    }
}
