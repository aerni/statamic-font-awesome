<?php

namespace Aerni\FontAwesome\FontAwesome;

use Illuminate\Support\Str;
use Aerni\FontAwesome\Data\Icon;
use Aerni\FontAwesome\Data\Icons;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Aerni\FontAwesome\Contracts\FontAwesomeDriver;

class KitFontAwesome implements FontAwesomeDriver
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

    public function icons(): Icons
    {
        return Cache::rememberForever('font_awesome::icons', function () {
            $icons = Http::post('https://api.fontawesome.com', [
                'query' => $this->iconsQuery(),
            ])->json()['data']['release']['icons'];

            return Icons::make($icons)
                ->flatMap(function (array $icon) {
                    $familyStyles = collect($icon['familyStylesByLicense'])->flatten(1)->unique();

                    return $familyStyles->map(fn ($familyStyle) => new Icon(
                        id: "{$familyStyle['family']}-{$familyStyle['style']}-{$icon['id']}",
                        label: "{$icon['label']}".' ('.Str::title("{$familyStyle['family']} {$familyStyle['style']}").')',
                        style: "{$familyStyle['family']}-{$familyStyle['style']}",
                        class: $this->iconClass($icon['id'], $familyStyle['style'], $familyStyle['family']),
                    ));
                })
                ->merge($this->customIcons());
        });
    }

    protected function customIcons(): Icons
    {
        return Icons::make($this->kit()->get('customIcons'))
            ->map(fn (array $icon) => new Icon(
                id: "custom-{$icon['name']}",
                label: Str::of($icon['name'])->replace('-', ' ')->title().' (Custom)',
                style: 'custom',
                class: "fak fa-{$icon['name']}",
            ))
            ->sortBy('id');
    }

    public function script(): string
    {
        return $this->kit()->get('url');
    }

    protected function iconClass(string $id, string $style, string $family): string
    {
        return match (true) {
            ($family === 'duotone') => "fa-{$family} fa-{$id}",
            ($family === 'classic') => "fa-{$style} fa-{$id}",
            default => "fa-{$family} fa-{$style} fa-{$id}",
        };
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
}
