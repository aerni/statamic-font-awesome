<?php

namespace Aerni\FontAwesome\FontAwesome;

use Aerni\FontAwesome\Contracts\FontAwesome;
use Aerni\FontAwesome\Data\Icons;
use Aerni\FontAwesome\Data\Kit;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class KitFontAwesome extends AbstractFontAwesome implements FontAwesome
{
    protected string $apiEndpoint = 'https://api.fontawesome.com';

    protected ?Icons $cachedIcons = null;

    public function __construct(protected string $apiToken, protected string $kitToken)
    {
        //
    }

    public function iconCacheKey(): string
    {
        return $this->kitToken;
    }

    public function icons(): Icons
    {
        if ($this->cachedIcons) {
            return $this->cachedIcons;
        }

        $cached = $this->readIconCache($this->kitToken);

        if ($cached !== null) {
            return $this->cachedIcons = $this->iconsFromArray($cached);
        }

        $iconsData = Http::post($this->apiEndpoint, ['query' => $this->iconsQuery()])
            ->collect('data.release.icons')
            ->merge($this->customIcons())
            ->toArray();

        $this->cachedIcons = $this->collectIcons($iconsData);
        unset($iconsData);
        $this->writeIconCache($this->kitToken, $this->cachedIcons);

        return $this->cachedIcons;
    }

    protected function customIcons(): Collection
    {
        /* Mirror the same object structure that the API returns for regular icons. */
        return collect($this->kit()->customIcons)
            ->map(fn (array $icon) => [
                'familyStylesByLicense' => [
                    'other' => [
                        [
                            'family' => count($icon['pathData']) === 2 ? 'kit-duotone' : 'kit', // According to https://docs.fontawesome.com/apis/graphql/objects#familystyle
                            'style' => 'custom',
                        ],
                    ],
                ],
                'id' => $icon['name'],
                'label' => str($icon['name'])->replace('-', ' ')->title(),
            ]);
    }

    public function script(): string
    {
        return $this->kit()->url;
    }

    protected function kit(): Kit
    {
        $kitData = $this->readKitCache($this->kitToken);

        if ($kitData === null) {
            $kitData = Http::withToken($this->authToken())
                ->post($this->apiEndpoint, ['query' => $this->kitQuery()])
                ->json('data.me.kit');

            $this->writeKitCache($this->kitToken, $kitData);
        }

        return new Kit(
            id: $kitData['token'],
            url: "https://kit.fontawesome.com/{$kitData['token']}.js",
            license: $kitData['licenseSelected'],
            version: $kitData['version'],
            customIcons: $kitData['iconUploads'],
        );
    }

    protected function authToken(): string
    {
        if ($token = Cache::get('font_awesome::kit::token')) {
            return $token;
        }

        $response = Http::withToken($this->apiToken)
            ->post("{$this->apiEndpoint}/token")
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
                        iconUploads {
                            name
                            pathData
                        }
                    }
                }
            }';
    }
}
