<?php

namespace Aerni\FontAwesome;

use Statamic\Fields\Fieldtype;
use Facades\Aerni\FontAwesome\FontAwesome;

class FontAwesomeFieldtype extends Fieldtype
{
    protected static $handle = 'font_awesome';

    protected $icon = 'select';

    protected function configFieldItems(): array
    {
        return [
            'styles' => [
                'display' => 'Styles',
                'instructions' => 'Only show icons of the selected styles. Leave empty to show all icons.',
                'type' => 'select',
                'multiple' => 'true',
                'options' => FontAwesome::styles()->mapWithKeys(function ($style) {
                    return [$style => __(ucfirst($style))];
                }),
            ],
        ];
    }

    public function preload(): array
    {
        $icons = $this->config('styles')
            ? FontAwesome::get($this->config('styles'))
            : FontAwesome::all();

        return [
            'icons' => $icons,
            'license' => FontAwesome::kit()->get('license'),
            'version' => FontAwesome::kit()->get('version'),
        ];
    }

    public function preProcess($data): ?array
    {
        return $this->preload()['icons']->first(function ($icon) use ($data) {
            return $icon['class'] === $data;
        });
    }

    public function process($data): ?string
    {
        return $data['class'] ?? $data;
    }
}
