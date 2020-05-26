<?php

namespace Bryceandy\Press;

use Parsedown;

class MarkdownParser
{
    /**
     * Creates a text parser
     *
     * @param string $string
     *
     * @return string
     */
    public static function parse(string $string)
    {
        return Parsedown::instance()->text($string);
    }
}