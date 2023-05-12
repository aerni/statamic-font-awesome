<?php

namespace Aerni\FontAwesome;

use Facades\Aerni\FontAwesome\FontAwesome;
use Statamic\Fields\Fieldtype;
use Illuminate\Support\Str;

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
                    return [$style => __(Str::of($style)->replace('-', ' ')->title()->toString())];
                }),
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
