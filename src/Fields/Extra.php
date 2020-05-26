<?php

namespace Bryceandy\Press\Fields;

class Extra
{
    public static function process($field, $value)
    {
        return [
            'extra' => json_encode([
                $field => $value,
            ]),
        ];
    }
}