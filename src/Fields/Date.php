<?php

namespace Bryceandy\Press\Fields;

use Bryceandy\Press\Contracts\FieldContract;
use Carbon\Carbon;

class Date extends FieldContract
{
    public static function process($field, $value, $data)
    {
        return [
            $field => Carbon::parse($value),
        ];
    }
}
