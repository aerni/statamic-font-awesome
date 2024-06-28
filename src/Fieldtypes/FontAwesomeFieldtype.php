<?php

namespace Aerni\FontAwesome\Fieldtypes;

use Aerni\FontAwesome\Facades\FontAwesome;
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
                            return [$style => __(str($style)->title()->replace('-', ' ')->toString())];
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
            'script' => ! FontAwesome::isUsingLocalDriver() ? FontAwesome::script() : null,
            'css' => FontAwesome::isUsingLocalDriver() ? FontAwesome::css() : null,
        ];
    }
}
