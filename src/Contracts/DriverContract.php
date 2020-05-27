<?php

namespace Bryceandy\Press\Contracts;

abstract class DriverContract
{
    /**
     * Config property locates the file path, url or database name
     *
     * @var array
     */
    protected array $config;

    /**
     * The property that will return all posts
     *
     * @var array
     */
    protected array $posts = [];

    /**
     * DriverContract constructor.
     */
    public function __construct()
    {
        $this->setConfig();

        $this->validateSource();
    }

    protected function setConfig()
    {
        $this->config = config('press' . config('press.driver'));
    }

    /**
     * Validates the driver chosen
     *
     * @return bool
     */
    protected function validateSource()
    {
        return true;
    }
}