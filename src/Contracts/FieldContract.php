<?php

namespace Bryceandy\Press\Contracts;

abstract class FieldContract
{
    /**
     * An abstraction for all field classes when processing their data values
     *
     * @param string $fieldType
     * @param string $fieldValue
     * @param array $data
     *
     * @return array
     */
    public static function process($fieldType, $fieldValue, $data)
    {
        return [
            $fieldType => $fieldValue,
        ];
    }
}
