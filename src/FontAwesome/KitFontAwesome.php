<?php

namespace Aerni\FontAwesome\FontAwesome;

use Aerni\FontAwesome\Contracts\FontAwesome;
use Aerni\FontAwesome\Data\Icon;
use Aerni\FontAwesome\Data\Icons;
use Aerni\FontAwesome\Data\Kit;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class KitFontAwesome extends AbstractFontAwesome implements FontAwesome
{
    protected string $apiEndpoint = 'https://api.fontawesome.com';

    public function __construct(protected string $apiToken, protected string $kitToken)
    {
        //
    }

    public function icons(): Icons
    {
        return Cache::rememberForever('font_awesome::kit::icons', function () {
            $icons = Http::post($this->apiEndpoint, ['query' => $this->iconsQuery()])
                ->json('data.release.icons');

            return $this->collectIcons($icons)->merge($this->collectCustomIcons());
        });
    }

    protected function collectCustomIcons(): Icons
    {
        return Icons::make($this->kit()->customIcons)
            ->map(fn (array $icon) => new Icon(
                id: "custom-{$icon['name']}",
                label: str($icon['name'])->replace('-', ' ')->title()->append(' Custom'),
                style: 'custom',
                class: "fak fa-{$icon['name']}",
            ))
            ->sortBy('id');
    }

    protected function kit(): Kit
    {
        return Cache::rememberForever("font_awesome::kit::{$this->kitToken}", function () {
            $kit = Http::withToken($this->authToken())
                ->post($this->apiEndpoint, ['query' => $this->kitQuery()])
                ->json('data.me.kit');

            return new Kit(
                id: $kit['token'],
                url: "{$this->apiEndpoint}/{$kit['token']}.js",
                license: $kit['licenseSelected'],
                version: $kit['version'],
                customIcons: $kit['iconUploads'],
            );
        });
    }

    public function script(): string
    {
        return $this->kit()->url;
    }

    protected function authToken(): string
    {
        if ($token = Cache::get('font_awesome::kit::token')) {
            return $token;
        }

        $response = Http::withToken($this->apiToken)
            ->post('https://api.fontawesome.com/token')
            ->collect();

        Cache::put('font_awesome::kit::token', $response->get('access_token'), $response->get('expires_in'));

        return $response->get('access_token');
    }

    protected function iconsQuery(): string
    {
        return
            'query {
                release (version:'.'"'.$this->kit()->version.'"'.') {
                    icons {
                        label
                        id
                        familyStylesByLicense {
                            '.$this->kit()->license.' {
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
}
