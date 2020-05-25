<?php

namespace Bryceandy\Press;

use Parsedown;

class MarkdownParser
{
    /**
     * Creates a text parser
     *
     * @param String $string
     * @return string
     */
    public static function parse(String $string)
    {
        return Parsedown::instance()->text($string);
    }
}