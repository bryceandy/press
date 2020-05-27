<?php

namespace Bryceandy\Press\Contracts;

abstract class DriverContract
{
    /**
     * The property that will return all posts
     *
     * @var array
     */
    protected array $posts = [];
}