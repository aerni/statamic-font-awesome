<?php

namespace Aerni\FontAwesome\Tags;

use Statamic\Tags\Tags;
use Statamic\Fields\Value;
use Aerni\FontAwesome\Facades\FontAwesome;

class FontAwesomeTags extends Tags
{
    protected static $handle = 'font_awesome';
    protected static $aliases = ['fa'];

    public function wildcard($icon): ?string
    {
        return ($icon = $this->context->get($icon))
            ? $this->output($icon)
            : null;
    }

    public function kit(): string
    {
        if (FontAwesome::isUsingLocalDriver()) {
            throw new \Exception('The kit tag is not available when using the local driver.');
        }

        $kitUrl = FontAwesome::kit($this->params->get('token'))->url;

        return "<script defer src='$kitUrl' crossorigin='anonymous'></script>";
    }

    protected function output(Value $icon): string
    {
        $class = trim("{$icon->value()} {$this->params->get('class')}");

        return "<i class='$class' aria-hidden='true'></i>";
    }
}
