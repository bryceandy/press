<?php

namespace Bryceandy\Press\Fields;

use Bryceandy\Press\Contracts\FieldContract;
use Bryceandy\Press\MarkdownParser;

class Body extends FieldContract
{
    public static function process($field, $value, $data)
    {
        return [
            $field => MarkdownParser::parse($value),
        ];
    }
}