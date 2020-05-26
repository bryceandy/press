<?php

namespace Bryceandy\Press\Fields;

class Extra
{
    public static function process($field, $value, $data)
    {
        $extra = isset($data['extra']) ? (array)json_decode($data['extra']) : [];

        return [
            // Merge previous saved data
            'extra' => json_encode(array_merge($extra, [
                $field => $value,
            ])),
        ];
    }
}