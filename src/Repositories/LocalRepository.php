<?php

namespace Aerni\FontAwesome\Repositories;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class LocalRepository extends Repository
{
    public function __construct(protected Filesystem $store)
    {
        //
    }

    public function icons(): Collection
    {
        return Cache::rememberForever('font_awesome::icons', function () {
            return collect($this->store->json('/metadata/icon-families.json'))->flatMap(function ($icon, $id) {
                return collect($icon['familyStylesByLicense'])
                    ->flatten(1)
                    ->unique()
                    ->map(fn ($familyStyle) => [
                        'style' => "{$familyStyle['family']}-{$familyStyle['style']}",
                        'id' => "{$familyStyle['family']}-{$familyStyle['style']}-{$id}",
                        'label' => "{$icon['label']}".' ('.Str::title("{$familyStyle['family']} {$familyStyle['style']}").')',
                        'class' => $this->iconClass($id, $familyStyle['style'], $familyStyle['family']),
                    ])->toArray();
            })->groupBy('style')->sortKeys();
        });
    }

    public function css(): string
    {
        return $this->store->url('css/all.css');
    }
}
