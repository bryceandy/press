<?php

namespace Bryceandy\Press;

class Press
{
    /**
     * Checks whether the config file is already published
     *
     * @return bool
     */
    public static function configNotPublished()
    {
        return is_null(config('press'));
    }
}