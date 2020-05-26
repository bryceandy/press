<?php

namespace Bryceandy\Press\Fields;

use Bryceandy\Press\MarkdownParser;

class Body
{
    public static function process($field, $value)
    {
        return [
            $field => MarkdownParser::parse($value),
        ];
    }
}