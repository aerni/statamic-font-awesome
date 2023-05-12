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
                        'display' => __('font-awesome::fieldtype.config.styles.display'),
                        'instructions' => __('font-awesome::fieldtype.config.styles.instructions'),
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
            'script' => FontAwesome::kit()->get('url'),
        ];
    }
}
