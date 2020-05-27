<?php

namespace Bryceandy\Press;

use Illuminate\Config\Repository;

class Press
{
    /**
     * Checks whether the config file is already published
     *
     * @return bool
     */
    public function configNotPublished()
    {
        return is_null(config('press'));
    }

    /**
     * Select a driver according to the driver chosen
     *
     * @return mixed
     */
    public function driver()
    {
        $driver = ucfirst(config('press.driver'));

        $class = 'Bryceandy\Press\Drivers\\' . $driver . 'Driver';

        return new $class;
    }

    /**
     * Fetches the path prefix configuration option
     *
     * @return Repository|mixed
     */
    public function path()
    {
        return config('press.path', 'press');
    }
}
