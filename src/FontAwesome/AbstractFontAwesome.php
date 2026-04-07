<?php

namespace Aerni\FontAwesome\FontAwesome;

use Aerni\FontAwesome\Contracts\FontAwesome;
use Aerni\FontAwesome\Data\Icon;
use Aerni\FontAwesome\Data\Icons;
use Illuminate\Support\Collection;

abstract class AbstractFontAwesome implements FontAwesome
{
    abstract public function icons(): Icons;

    abstract public function iconCacheKey(): string;

    public function icon(string $id): ?Icon
    {
        return $this->icons()->get($id);
    }

    public function styles(): Collection
    {
        $cached = $this->readStylesCache();

        if ($cached !== null) {
            return collect($cached);
        }

        $styles = $this->icons()->styles();
        $this->writeStylesCache($styles->all());

        return $styles;
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

    public function iconsCachePath(): ?string
    {
        $key = $this->iconCacheKey();
        $path = storage_path("framework/cache/font-awesome/{$key}.json");

        return file_exists($path) ? $path : null;
    }

    protected function readStylesCache(): ?array
    {
        $path = storage_path("framework/cache/font-awesome/styles-{$this->iconCacheKey()}.json");

        if (! file_exists($path)) {
            return null;
        }

        try {
            $data = file_get_contents($path);

            if ($data === false) {
                return null;
            }

            $decoded = json_decode($data, true);

            return is_array($decoded) ? $decoded : null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    protected function writeStylesCache(array $styles): void
    {
        $dir = storage_path('framework/cache/font-awesome');

        if (! is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $path = "{$dir}/styles-{$this->iconCacheKey()}.json";
        file_put_contents($path, json_encode($styles, JSON_THROW_ON_ERROR));
    }

    protected function iconsFromArray(array $data): Icons
    {
        return Icons::make($data)->map(fn (array $icon) => new Icon(
            id: $icon['id'],
            label: $icon['label'],
            style: $icon['style'],
            class: $icon['class'],
        ))->keyBy('id');
    }

    protected function readIconCache(string $key): ?array
    {
        $path = storage_path("framework/cache/font-awesome/{$key}.json");

        if (! file_exists($path)) {
            return null;
        }

        try {
            $data = file_get_contents($path);

            if ($data === false) {
                return null;
            }

            $decoded = json_decode($data, true);

            return is_array($decoded) ? $decoded : null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    protected function writeIconCache(string $key, Icons $icons): void
    {
        $dir = storage_path('framework/cache/font-awesome');

        if (! is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $path = "{$dir}/{$key}.json";
        $handle = fopen($path, 'w');

        if ($handle === false) {
            throw new \RuntimeException("Unable to write cache file: {$path}");
        }

        fwrite($handle, "[\n");
        $first = true;

        foreach ($icons as $icon) {
            if (! $first) {
                fwrite($handle, ",\n");
            }
            $first = false;

            $json = json_encode([
                'id' => $icon->id,
                'label' => $icon->label,
                'style' => $icon->style,
                'class' => $icon->class,
            ], JSON_THROW_ON_ERROR);

            fwrite($handle, '    '.$json);
        }

        fwrite($handle, "\n]");
        fclose($handle);

        // Also write styles cache alongside
        $this->writeStylesCache($icons->styles()->all());
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

    protected function readKitCache(string $key): ?array
    {
        $path = storage_path("framework/cache/font-awesome/kit-{$key}.json");

        if (! file_exists($path)) {
            return null;
        }

        try {
            $data = file_get_contents($path);

            if ($data === false) {
                return null;
            }

            $decoded = json_decode($data, true);

            if (! is_array($decoded)) {
                return null;
            }

            return $decoded;
        } catch (\Throwable $e) {
            return null;
        }
    }

    protected function writeKitCache(string $key, array $data): void
    {
        $dir = storage_path('framework/cache/font-awesome');

        if (! is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }

        $path = "{$dir}/kit-{$key}.json";

        file_put_contents($path, json_encode($data, JSON_THROW_ON_ERROR));
    }
}
