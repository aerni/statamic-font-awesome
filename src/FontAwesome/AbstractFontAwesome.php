<?php

namespace Aerni\FontAwesome\FontAwesome;

use Aerni\FontAwesome\Contracts\FontAwesome;
use Aerni\FontAwesome\Data\Icon;
use Aerni\FontAwesome\Data\Icons;
use Illuminate\Support\Collection;

abstract class AbstractFontAwesome implements FontAwesome
{
    abstract public function icons(): Icons;

    public function icon(string $id): ?Icon
    {
        return $this->icons()->get($id);
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
                ->map(fn ($familyStyle) => new Icon(
                    id: "{$familyStyle['family']}-{$familyStyle['style']}-{$icon['id']}",
                    label: "{$icon['label']} {$this->familyStyleForLabel($familyStyle)}",
                    style: "{$familyStyle['family']}-{$familyStyle['style']}",
                    class: $this->iconClass($icon['id'], $familyStyle['family'], $familyStyle['style']),
                ))
                ->keyBy('id');
        });
    }

    protected function iconClass(string $id, string $family, string $style): string
    {
        return match (true) {
            ($family === 'classic') => "fa-{$style} fa-{$id}",
            ($family === 'duotone') => "fa-duotone fa-{$style} fa-{$id}",
            ($family === 'kit') => "fa-kit fa-{$id}",
            ($family === 'kit-duotone') => "fa-kit-duotone fa-{$id}",
            default => "fa-{$family} fa-{$style} fa-{$id}",
        };
    }

    protected function familyStyleForLabel(array $familyStyle): string
    {
        return str("({$familyStyle['family']} {$familyStyle['style']})")
            ->replace('-', ' ')
            ->title();
    }
}
