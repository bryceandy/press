<?php

namespace Bryceandy\Press;

use Parsedown;

class MarkdownParser
{
    /**
     * Creates a markdown parser
     *
     * @param String $string
     * @return string
     */
    public static function parse(String $string)
    {
        $parsedown = new Parsedown();

        return $parsedown->text($string);
    }
}