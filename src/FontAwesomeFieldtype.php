<?php

namespace Aerni\FontAwesome;

use Facades\Aerni\FontAwesome\FontAwesome;
use Illuminate\Support\Str;
use Statamic\Fields\Fieldtype;

class FontAwesomeFieldtype extends Fieldtype
{
    protected static $handle = 'font_awesome';
    protected $categories = ['media'];
    protected $icon = 'icon_picker';

    protected function configFieldItems(): array
    {
        return [
            [
                'display' => __('Selection'),
                'fields' => [
                    'styles' => [
                        'display' => __('Styles'),
                        'instructions' => 'Only show icons of the selected styles. Leave empty to show all icons.',
                        'type' => 'select',
                        'multiple' => 'true',
                        'options' => FontAwesome::styles()->mapWithKeys(function ($style) {
                            return [$style => __(Str::of($style)->replace('-', ' ')->title()->toString())];
                        }),
                    ],
                ],
            ],
        ];
    }

    public function preload(): array
    {
        return [
            'styles' => $this->config('styles') ?? FontAwesome::styles(),
        ];
    }

    public function preProcess($data): ?array
    {
        return $data ? FontAwesome::icon($data) : null;
    }

    public function process($data): ?string
    {
        return $data['class'] ?? $data;
    }
}
