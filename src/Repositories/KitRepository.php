<?php

namespace Aerni\FontAwesome\Repositories;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class KitRepository extends Repository
{
    public function __construct(protected string $apiToken, protected string $kitToken)
    {
        //
    }

    public function kit(string $token = null): Collection
    {
        if ($token) {
            $this->kitToken = $token;
        }

        return Cache::rememberForever("font_awesome::kit::{$this->kitToken}", function () {
            $response = Http::withToken($this->authToken())
                ->post('https://api.fontawesome.com', [
                    'query' => $this->kitQuery(),
                ])->json()['data']['me']['kit'];

            return collect([
                'id' => $response['token'],
                'url' => "https://kit.fontawesome.com/{$response['token']}.js",
                'license' => $response['licenseSelected'],
                'version' => $response['version'],
                'customIcons' => $response['iconUploads'],
            ]);
        });
    }

    public function icons(): Collection
    {
        return Cache::rememberForever('font_awesome::icons', function () {
            $response = Http::post('https://api.fontawesome.com', [
                'query' => $this->iconsQuery(),
            ])->json()['data']['release']['icons'];

            $icons = collect($response)->flatMap(function ($icon) {
                // The styles available for the license type of the kit.
                $familyStyles = $icon['familyStylesByLicense'][$this->kit()->get('license')];

                return collect($familyStyles)->map(fn ($familyStyle) => [
                    'style' => "{$familyStyle['family']}-{$familyStyle['style']}",
                    'id' => "{$familyStyle['family']}-{$familyStyle['style']}-{$icon['id']}",
                    'label' => "{$icon['label']}".' ('.Str::title("{$familyStyle['family']} {$familyStyle['style']}").')',
                    'class' => $this->iconClass($icon['id'], $familyStyle['style'], $familyStyle['family']),
                ])->toArray();
            })->groupBy('style');

            if ($this->customIcons()->isNotEmpty()) {
                $icons->put('custom', $this->customIcons());
            }

            return $icons->sortKeys();
        });
    }

    protected function customIcons(): Collection
    {
        return collect($this->kit()->get('customIcons'))->map(function ($icon) {
            return [
                'style' => 'custom',
                'id' => "custom-{$icon['name']}",
                'label' => Str::of($icon['name'])->replace('-', ' ')->title().' (Custom)',
                'class' => "fak fa-{$icon['name']}",
            ];
        })->sortBy('id');
    }

    protected function authToken(): string
    {
        if ($token = Cache::get('font_awesome::token')) {
            return $token;
        }

        $response = Http::withToken($this->apiToken)
            ->post('https://api.fontawesome.com/token')
            ->collect();

        Cache::put('font_awesome::token', $response->get('access_token'), $response->get('expires_in'));

        return $response->get('access_token');
    }

    protected function iconsQuery(): string
    {
        return
            'query {
                release (version:'.'"'.$this->kit()->get('version').'"'.') {
                    icons {
                        label
                        id
                        familyStylesByLicense {
                            '.$this->kit()->get('license').' {
                                family
                                style
                            }
                        }
                    }
                }
            }';
    }

    protected function kitQuery(): string
    {
        return
            'query {
                me {
                    kit (token:'.'"'.$this->kitToken.'"'.') {
                        token
                        licenseSelected
                        version
                        iconUploads {'.'name'.'}
                    }
                }
            }';
    }

    public function script(): string
    {
        return $this->kit()->get('url');
    }

    protected function isVersion5(): bool
    {
        return Str::startsWith($this->kit()->get('version'), '5');
    }
}
