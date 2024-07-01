<?php

namespace Aerni\FontAwesome\Tags;

use Aerni\FontAwesome\Facades\FontAwesome;
use Statamic\Fields\Value;
use Statamic\Tags\Tags;

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

        $kitUrl = FontAwesome::script();

        return "<script defer src='{$kitUrl}' crossorigin='anonymous'></script>";
    }

    protected function output(Value $icon): string
    {
        $class = trim("{$icon->value()} {$this->params->get('class')}");

        return "<i class='$class' aria-hidden='true'></i>";
    }
}
