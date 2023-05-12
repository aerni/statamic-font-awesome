<?php

namespace Aerni\FontAwesome;

use Facades\Aerni\FontAwesome\FontAwesome;
use Statamic\Fields\Value;
use Statamic\Tags\Tags;

class FontAwesomeTags extends Tags
{
    protected static $handle = 'font_awesome';

    public function wildcard($icon): ?string
    {
        return ($icon = $this->context->get($icon))
            ? $this->output($icon)
            : null;
    }

    public function kit(): string
    {
        $kitUrl = FontAwesome::kit($this->params->get('token'))->get('url');

        return "<script defer src='$kitUrl' crossorigin='anonymous'></script>";
    }

    protected function output(Value $icon): string
    {
        $class = trim("{$icon->value()} {$this->params->get('class')}");

        return "<i class='$class' aria-hidden='true'></i>";
    }
}
