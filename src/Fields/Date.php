<?php

namespace Bryceandy\Press\Fields;

use Carbon\Carbon;

class Date
{
    public static function process($field, $value, $data)
    {
        return [
            $field => Carbon::parse($value),
        ];
    }
}