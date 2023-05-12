<?php

namespace Aerni\FontAwesome;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FontAwesome
{
    protected string $apiToken;
    protected string $kitToken;

    public function __construct()
    {
        $this->apiToken = config('font-awesome.api_token') ?? '';
        $this->kitToken = config('font-awesome.kit_token') ?? '';

        $this->validateConfig();
    }

    public function all(): Collection
    {
        return $this->icons()->flatten(1)->sortBy('label')->values();
    }

    public function icon(string $icon): ?array
    {
        return $this->all()->firstWhere('class', $icon);
    }

    public function styles(): Collection
    {
        return $this->icons()->keys();
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
                'uploaded_icons' => $response['iconUploads'],
            ]);
        });
    }

    protected function icons(): Collection
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

            if ($this->uploadedIcons()->isNotEmpty()) {
                $icons->put('uploaded', $this->uploadedIcons());
            }

            return $icons->sortKeys();
        });
    }

    protected function uploadedIcons(): Collection
    {
        return collect($this->kit()->get('uploaded_icons'))->map(function ($icon) {
            return [
                'style' => 'uploaded',
                'id' => "uploaded-{$icon['name']}",
                'label' => Str::title($icon['name']).' (uploaded)',
                'class' => "fak fa-{$icon['name']}",
            ];
        })->sortBy('id');
    }

    protected function iconClass(string $icon, string $style, string $family): string
    {
        if ($this->isVersion5()) {
            return match (true) {
                ($family === 'duotone') => 'fa'.substr($family, 0, 1)." fa-{$icon}",
                default => 'fa'.substr($style, 0, 1)." fa-{$icon}",
            };
        }

        return match (true) {
            ($family === 'duotone') => "fa-{$family} fa-{$icon}",
            ($family === 'classic') => "fa-{$style} fa-{$icon}",
            default => "fa-{$family} fa-{$style} fa-{$icon}",
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

    protected function validateConfig(): void
    {
        if (empty($this->apiToken)) {
            throw new \Exception('Please add your Font Awesome API Token to your .env file.');
        }

        if (empty($this->kitToken)) {
            throw new \Exception('Please add your Font Awesome Kit Token to your .env file.');
        }
    }

    protected function isVersion5(): bool
    {
        return Str::startsWith($this->kit()->get('version'), '5');
    }
}
